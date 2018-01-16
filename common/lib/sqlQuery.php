<?php

namespace common\lib;
use yii\db;
use yii;
use yii\db\Command;
use yii\db\Query;
use common\lib\Page;
use common\models\Model;
use common\models\BaseModel;
use common\lib\Table;
use yii\Helper\ArrayHelper;


/**
 * SQL操作类
 */
class sqlQuery extends BaseModel{
	/**
	 * [selectData 查询数据公共方法]
	 * @Author:xiaoming
	 * @DateTime        2017-05-31T09:43:22+0800
	 * @param           string                   $table    [description]
	 * @param           string                   $where    [description]
	 * @param           integer                  $page     [description]
	 * @param           integer                  $pageSize [description]
	 * @return          [type]                             [description]
	 */
	public static function selectData($table='',$param = []){
        $pageSize   = !isset($param['pageSize']) || $param['pageSize'] == '' ? Yii::$app->params['default_page_size'] : $param['pageSize'];
        $page = !isset($param['page']) || $param['page'] == '' ? 1 : $param['page'];
        $offset     = ($page - 1) * $pageSize;
        $table_name = Yii::$app->params['tablePrefix'].$table;
		$sql  = (new Query())->from($table_name.' AS t')->where(['t.is_delete'=>2]);
        if(isset($param['start_time']) && isset($param['end_time'])){
            if($param['start_time'] != '' && $param['end_time'] != ''){
                $start_time = strtotime(date('Y-m-d',strtotime($param['start_time']) - 86400).' 23:59:59');
                $end_time = strtotime(date('Y-m-d',strtotime($param['end_time']) + 86400).' 00:00:00');
                $sql->andFilterWhere(['between', 'created_at', $start_time, $end_time]);
            }
        }
        if(isset($param['keywords']) && $param['keywords'] != ''){
            $sql->andFilterWhere(['or', 
                ['like', 'title', $param['keyworlds']], 
                ['like', 'create_by', $param['keyworlds']],
                ['like', 'keywords', $param['keyworlds']]
            ]);
        }
		if(isset($param['status']) && $param['status'] != '-1'){
			$sql->andWhere(['=', 'status', $param['status']]);
		}
        if(isset($param['catId']) && $param['catId'] != ''){
            $sql->andWhere(['=', 'category_id', $param['catId']]);
        }
		$list = $sql->orderBy('created_at DESC')
		                    ->limit($pageSize)
                            ->offset($offset)
							->all();
        foreach ($list as $key => $value) {
            $list[$key]['created_at'] = date('Y-m-d H:i:s',$value['created_at']);
            $list[$key]['update_at'] = date('Y-m-d H:i:s',$value['update_at']);
        }
        $data['list'] = $list;
        //p($sql->createCommand()->getRawSql());
        $data['count'] = $sql->count();
        return $data;
	}
	//组装数据插入sql
    public static function assembleSql($data = [],$modelid = ''){
        if(empty($data) || $modelid == ''){
            return false;
        }
        $data['created_at']    = time();
        $data['update_at']     = time();
        $data['publish_time']  = $data['publish_time'] != '' ? strtotime($data['publish_time']) :'';
        $data['create_by']     = Yii::$app->user->identity->username;
        $model_info = (new Model())->getModelInfo($modelid);
        if($model_info === false){
            BaseModel::E('模型数据异常');
        }
        $table_name = Yii::$app->params['tablePrefix'].$model_info->e_name;
       //p(Yii::$app->db->createCommand()->insert($table_name, $data)->getRawSql());
        //判断字段属于主表还是副表
        $basic = $table_data = [];
        foreach ($data as $k => $v){
            if(Table::checkColumn($model_info->e_name,$k)){
                $basic[$k] = $v;
            }else{
                $table_data[$k] = $v;
            }
        }

        //插入主表数据
        if(!empty($basic)){
            $rs = Yii::$app->db->createCommand()->insert($table_name, $basic)->execute();
            if(!$rs){
                return false;
            }
        }
        //插入副表数据
        if(!empty($table_data)){

            $table_data['id'] = Yii::$app->db->getLastInsertID();
            $rs = Yii::$app->db->createCommand()->insert($table_name.Table::TABLE_DATA_PREFIX, $table_data)->execute();
            if(!$rs){
                return false;
            }
        }
        return true;
    }
    /**
     * [getContent 查询数据]
     * @author:xiaoming
     * @date:2018-01-02T15:50:45+0800
     * @param                         string $table [description]
     * @return                        [type]        [description]
     */
    public function selectContentData($table='',$id='',$field=[]){
        if($table =='' || $id ==''){
            return false;
        }
        $TableName = (new Table())->checkTable($table);
        if(!$TableName){
            return false;
        }
        $sql = (new Query())->from($TableName.' AS c')->where(['c.id'=>$id]);
        $sql->join('LEFT JOIN',$TableName.Table::TABLE_DATA_PREFIX. ' AS d','c.id = d.id');
        
        if(!empty($field)){
            foreach ($field as $key => $value) {
                $sql->addSelect($value['e_name']);
            }
            $sql->addSelect('c.category_id,
                c.status,
                c.publish_time,
                c.allow_comment,
                c.show_template,
                d.content'
            );
        }else{
            $sql->select('c.*,d.content');
        }
        $rs = $sql->one();
        return $rs;
    }
    //组装数据更新sql
    public static function updateAssembleSql($data = [],$modelid = '',$id = ''){
        if(empty($data) || $modelid == ''||$id == ''){
            return false;
        }
        $data['update_at']     = time();
        $data['publish_time']  = $data['publish_time'] != '' ? strtotime($data['publish_time']) :'';
        $data['create_by']     = Yii::$app->user->identity->username;
        $model_info = (new Model())->getModelInfo($modelid);
        if($model_info === false){
            BaseModel::E('模型数据异常');
        }
        $table_name = Yii::$app->params['tablePrefix'].$model_info->e_name;
        //判断字段属于主表还是副表
        $basic = $table_data = [];
        foreach ($data as $k => $v){
            if(Table::checkColumn($model_info->e_name,$k)){
                $basic[$k] = $v;
            }else{
                $table_data[$k] = $v;
            }
        }
        //p(Yii::$app->db->createCommand()->update($table_name, $basic, 'id = '.$id)->getRawSql());
        //插入主表数据
        if(!empty($basic)){
            $rs = Yii::$app->db->createCommand()->update(
                $table_name, 
                $basic, 
                'id = '.$id)->execute();
            if(!$rs){
                return false;
            }
        }
        //插入副表数据
        if(!empty($table_data)){
          $rs = Yii::$app->db->createCommand()->update($table_name.Table::TABLE_DATA_PREFIX, $table_data, 'id = '.$id)->execute();
            if(!$rs){
                return false;
            }
        }
        return true;
    }
    /**
     * [delContent 删除数据]
     * @author:xiaoming
     * @date:2018-01-04T08:41:23+0800
     * @param                         string $table [description]
     * @param                         string $id    [description]
     * @return                        [type]        [description]
     */
    public function delContent($table='',$id=[]){
        if($table == ''|| empty($id)){
            return false;
        }
        $table_name = Yii::$app->params['tablePrefix'].$table;
        $rs = Yii::$app->db->createCommand()->delete($table_name, 'id in ('.$id.')')->execute();
        $rs1 = Yii::$app->db->createCommand()->delete($table_name.Table::TABLE_DATA_PREFIX, 'id in ('.$id.')')->execute();
        if(!$rs && $rs1){
            return false;
        }
        return true;
    }

}

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
		$pageSize = $param['pageSize'] == '' ? Yii::$app->params['default_page_size'] : $param['pageSize'];
		$offset   = ($param['page'] - 1) * $pageSize;
		$table_name = Yii::$app->params['tablePrefix'].$table;

		$sql  = (new Query())->from($table_name.' AS t')->where(['t.is_delete'=>2]);
		if($param['start_time'] != '' && $param['end_time'] != ''){
			$sql->andwhere(['between', 'created_at', $param['start_time'], $param['end_time']]);
		}
		$sql->andFilterWhere(['or', ['like', 'title', $param['keyworlds']], ['like', 'create_by', $param['keyworlds']],['like', 'keywords', $param['keyworlds']]]);
		if($param['status'] != '-1'){
			$sql->andWhere(['=', 'status', $param['status']]);
		}
        if(isset($param['catId']) && $param['catId'] != ''){
            $sql->andWhere(['=', 'category_id', $param['catId']]);
        }
		$data['list'] = $sql->orderBy('created_at DESC')
		                    ->limit($pageSize)
                            ->offset($offset)
							->all();
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
        $data['publish_time']  = strtotime($data['publish_time']);
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
            $rs = Yii::$app->db->createCommand()->insert($table_name.Table::table_data_Prefix, $table_data)->execute();
            if(!$rs){
                return false;
            }
        }
        return true;
    }

}

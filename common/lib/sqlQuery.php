<?php

namespace common\lib;
use yii\db;
use yii;
use yii\db\Command;
use yii\db\Query;
use common\lib\Page;

/**
 * SQL操作类
 */
class sqlQuery{
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
	public function selectData($table='',$param = []){
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
		//p($sql->createCommand()->getRawSql());
		$data['list'] = $sql->orderBy('created_at DESC')
		                    ->limit($pageSize)
                            ->offset($offset)
							->all();
        $data['count'] = $sql->count();
        return $data;
	}

}

<?php 
use common\models\Category;
use common\lib\sqlQuery;
use common\lib\Page;
function smarty_block_contentList($args, $con, &$smarty){ 
	$catid = Yii::$app->request->get('catId','');
	$page  = Yii::$app->request->get('page',0);
	$param = [];
	if($catid == ''){
	 $data['list'] = [];
	}
	$category_model = (new Category())->getCategoryModel($catid);
	if(!$category_model){
	 $data['list'] = [];
	}
	$param['catId'] = $catid;
	if(isset($args['num']) && $args['num'] != '' && is_numeric($args['num'])){
		$param['pageSize'] = $args['num'];
	}
	$table_name = $category_model['table_name'];
	$data = (new sqlQuery())->selectData($table_name,$param);

	$smarty->assign("list",$data['list']); 
	$smarty->assign("page",$data['page_show']); 
	return $con;
}    
?> 


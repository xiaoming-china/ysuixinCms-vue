<?php  
use common\models\Category;
function smarty_block_test($args, $con, &$smarty){ 
	// $str = [
	// 	[
	// 		'id'=>1,
	// 		'name'=>'name1'
	// 	],
	// 	[
	// 		'id'=>2,
	// 		'name'=>'name2'
	// 	]
	// ]; 
	$str = (new Category())->getAllCategory();
	$smarty->assign("list",$str); 
	return $con;
}    
?> 


<?php  
use common\models\Category;
function smarty_block_nav($args, $con, &$smarty){ 
    $category_list = (new Category())->getAllCategory();
    $rs = (new Category())->manyArray($category_list);
	$smarty->assign("list",$rs); 
	return $con;
}    
?> 


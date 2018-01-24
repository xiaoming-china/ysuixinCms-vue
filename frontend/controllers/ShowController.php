<?php
namespace frontend\controllers;

use frontend\controllers\FrontendBaseController;
use yii;
use common\models\Category;
use common\lib\sqlQuery;

class ShowController extends FrontendBaseController{
    /**
     * [actionIndex 内容展示页]
     * @author:xiaoming
     * @date:2018-01-15T15:44:14+0800
     * @return                        [type] [description]
     */
    public function actionIndex(){
        $catid = $this->get('catId','');
        $id    = $this->get('id','');

        if($catid == '' || $id ==''){
            return $this->error('参数异常');
        }
        $category_info = (new Category())->getCategoryInfo($catid);
        $rs = (new sqlQuery())->selectContentData($category_info['table_name'],$id);
        //p($rs);
       return $this->render($this->config['theme'].'Show/show',[
        'data'=>$rs
       ]);
    }



}
?>
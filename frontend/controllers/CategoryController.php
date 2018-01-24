<?php
namespace frontend\controllers;

use frontend\controllers\FrontendBaseController;
use yii;
use common\models\Category;
use common\lib\sqlQuery;



class CategoryController extends FrontendBaseController{
    /**
     * [actionIndex 栏目列表]
     * @author:xiaoming
     * @date:2018-01-15T15:44:14+0800
     * @return                        [type] [description]
     */
    public function actionList(){
        $catid = Yii::$app->request->get('catId','');
        $rs = (new Category())->getCategoryInfo($catid);
        $s = $this->CreateSeo(
            $rs['catname'], 
            $rs['setting']['category_keywords'], 
            $rs['setting']['category_desc']
        );
       return $this->render($this->config['theme'].'/Category/Category',$s);
    }



}
?>
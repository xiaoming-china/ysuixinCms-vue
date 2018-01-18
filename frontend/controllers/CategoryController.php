<?php
namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii;
use common\models\Category;
use common\lib\sqlQuery;



class CategoryController extends BaseController{
    /**
     * [actionIndex 栏目列表]
     * @author:xiaoming
     * @date:2018-01-15T15:44:14+0800
     * @return                        [type] [description]
     */
    public function actionList(){
        $catid = Yii::$app->request->get('catid','');
        $param   = [
            'catId'    => $catid,
            'page'     => 0,
            'pageSize' => 20,
           ];
        $s = $this->CreateSeo(
            $this->config['sitename'], 
            $this->config['siteinfo'], 
            $this->config['sitekeywords']
        );
       return $this->render($this->config['theme'].'/Category/Category',$s);
    }
    public function actionTest(){
         
        
        return $this->render($this->config['theme'].'/Category/test');
    }



}
?>
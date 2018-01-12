<?php
namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii;

class IndexController extends BaseController{

    public function actionIndex (){
        //p(Yii::$app->viewPath);
        //p($this->config['theme']);
        // $this->renderFile($this->config['theme'].'Index/index.php');
        //p(Yii::getAlias('@app'));//render('@app/views/site/about.php')，
        $this->render('/Default1/Page/Index/index.php');
    }
}
?>
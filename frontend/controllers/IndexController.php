<?php
namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii;

class IndexController extends BaseController{

    public function actionIndex (){
        
       return $this->render($this->config['theme'].'/Index/index');
    }
}
?>
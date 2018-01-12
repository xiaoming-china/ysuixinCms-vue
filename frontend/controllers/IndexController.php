<?php
namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii;

class IndexController extends BaseController{

    public function actionIndex (){
        //p($this->config['theme']);
        // $this->renderFile($this->config['theme'].'Index/index.php');
        $this->renderFile('template/Default1/Page/Index/index.php');
    }
}
?>
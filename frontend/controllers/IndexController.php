<?php
namespace frontend\controllers;

use frontend\controllers\FrontendBaseController;
use yii;

class IndexController extends FrontendBaseController{

    /**
     * [actionIndex 前台首页]
     * @author:xiaoming
     * @date:2018-01-15T15:44:14+0800
     * @return                        [type] [description]
     */
    public function actionIndex(){
        $s = $this->CreateSeo(
            $this->config['sitename'], 
            $this->config['siteinfo'], 
            $this->config['sitekeywords']
        );
        return $this->render($this->config['theme'].'/Index/index',$s);
    }
}
?>
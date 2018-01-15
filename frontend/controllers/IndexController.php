<?php
namespace frontend\controllers;

use frontend\controllers\BaseController;
use yii;

class IndexController extends BaseController{

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
        if($this->isPost()){
            return $this->ajaxSuccess('获取成功','',$s);
        }else{
            return $this->render($this->config['theme'].'/Index/index',$s);
        }
    }
}
?>
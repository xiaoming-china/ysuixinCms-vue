<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Config;


class BaseController extends Controller{
    public $config;

    public function init(){
        //加载配置信息
        $this->config = Config::getAllConfig();
        $this->config['theme'] = Template.$this->config['theme'].'/'.'Page/';
    }



}
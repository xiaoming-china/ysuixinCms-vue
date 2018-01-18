<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Config;
use common\controllers\BaseController;

class FrontendBaseController extends BaseController{

    
    public $layout=false;
    public $config;

    public function init(){
        //加载配置信息
        $this->config = Config::getAllConfig();
        $this->config['theme'] = '/'.$this->config['theme'].'/PageList/';
    }
    /**
     * [CreateSeo 生成SEO]
     * @author:xiaoming
     * @date:2018-01-15T15:37:13+0800
     * @param                         string $title       [description]
     * @param                         string $description [description]
     * @param                         string $keyword     [description]
     */
    protected function CreateSeo($title = '', $description = '', $keyword = '') {
		$s['title']       = $title;
		$s['description'] = $description;
		$s['keywords']    = $keyword;
		return $s;
    }



}
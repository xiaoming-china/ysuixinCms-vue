<?php
/**
 * Admin后台基类控制器
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\controllers\BaseController;


class AdminBaseController extends BaseController{
	public $layout = 'main-admin';
    public $uId;

    public function init(){
        parent::init();
        $this->uId = getUserInfo('id');
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-12-04
     * @name:description 主要判断是否登录
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            [type]      $action [description]
     * @return           [type]              [description]
     */
    public function beforeAction($action){
        $isComList = in_array($action->id, ['login','logout']);
        if (!Yii::$app->user->getId() && !$isComList) {
            return $this->redirect(['/public/login']);
            exit;
        }
        return parent::beforeAction($action);
    }


}
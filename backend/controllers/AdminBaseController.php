<?php
/**
 * Admin后台基类控制器
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Menu;
use common\lib\DataHandle;


class AdminBaseController extends Controller{

    const STATUS_CODE_SUCC = 1;
    const STATUS_CODE_FAIL = 0;

	public $layout = 'main-admin';
    public $menu_list = '';
    public $uId;
    public function init() {
        parent::init();
        $this->enableCsrfValidation = false;
        $this->uId = Yii::$app->user->getId();
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
        }
        return parent::beforeAction($action);
    }
    protected function formatResponse($status, $message = '', $url = '', $data = []){
        return ['status' => $status, 'message' => $message, 'url' => $url, 'data' => $data];
    }
    protected function setAjaxResponse(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
    protected function ajaxSuccess($message = '', $url = '', $data = []){
        $this->setAjaxResponse();
        return $this->formatResponse(self::STATUS_CODE_SUCC, $message, $url, $data);
    }
    protected function ajaxFail($message = '', $url = '', $data = []){
        $this->setAjaxResponse();
        return $this->formatResponse(self::STATUS_CODE_FAIL, $message, $url, $data);
    }
    protected function isAjax(){
        return Yii::$app->request->getIsAjax();
    }
    protected function isPost(){
        return Yii::$app->request->getIsPost();
    }
    //统一获取post参数的方法
    protected function post($key, $default = "") {
        return Yii::$app->request->post($key, $default);
    }
    //统一获取get参数的方法
    protected function get($key, $default = "") {
        return Yii::$app->request->get($key, $default);
    }
    //获取配置参数
    protected function getParams($params_name = ''){
       return $params_name == '' ? '' : Yii::$app->params[$params_name];
    }
    //打印sql
    protected function printSql($sql = ''){
       p($sql == '' ? '' : $sql->createCommand()->getRawSql());
    }
    //输出错误信息，如果为ajax提交，则输出json格式
    protected function error($info = '操作失败',$second = 3){
        if($this->isAjax()){
          return $this->ajaxFail($info);
        }else{
          return $this->dispatchJump('error',$info,$second);
        }
    }
    //输出成功信息
    protected function success($info = '操作成功',$second = 3){
        return $this->dispatchJump('success',$info,$second);
    }
    //请求不是ajax，跳转函数
    protected function dispatchJump($type='success',$info,$second){
        if($type == 'success'){
            return $this->render('/success',[
                'message'=>$info,
                'jumpUrl'=>Yii::$app->request->getReferrer(),
                'waitSecond'=>$second
            ]);
        }else{
            return $this->render('/error',[
                'message'=>$info,
                'jumpUrl'=>Yii::$app->request->getReferrer(),
                'waitSecond'=>$second
            ]);
        }
    }

}
<?php
/**
 * 基类
 */
namespace common\controllers;

use Yii;
use yii\web\Controller;


class BaseController extends Controller{
    const STATUS_CODE_SUCC = 1;
    const STATUS_CODE_FAIL = 0;
    public $uId;
    public function init() {
        parent::init();
        $this->enableCsrfValidation = false;
        $this->uId = Yii::$app->user->getId();
    }
    /**
     * [formatResponse 返回格式组装]
     * @author:xiaoming
     * @date:2018-01-18T16:37:13+0800
     * @param                         [type] $status  [description]
     * @param                         string $message [description]
     * @param                         string $url     [description]
     * @param                         [type] $data    [description]
     * @return                        [type]          [description]
     */
    protected function formatResponse($status, $message = '', $url = '', $data = []){
        return ['status' => $status, 'message' => $message, 'url' => $url, 'data' => $data];
    }
    /**
     * [setAjaxResponse 设置返回格式为json]
     * @author:xiaoming
     * @date:2018-01-18T16:37:32+0800
     */
    protected function setAjaxResponse(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
    /**
     * [ajaxSuccess 成功后的返回]
     * @author:xiaoming
     * @date:2018-01-18T16:37:50+0800
     * @param                         string $message [description]
     * @param                         string $url     [description]
     * @param                         [type] $data    [description]
     * @return                        [type]          [description]
     */
    protected function ajaxSuccess($message = '', $url = '', $data = []){
        $this->setAjaxResponse();
        return $this->formatResponse(self::STATUS_CODE_SUCC, $message, $url, $data);
    }
    /**
     * [ajaxFail 失败后的返回]
     * @author:xiaoming
     * @date:2018-01-18T16:38:01+0800
     * @param                         string $message [description]
     * @param                         string $url     [description]
     * @param                         [type] $data    [description]
     * @return                        [type]          [description]
     */
    protected function ajaxFail($message = '', $url = '', $data = []){
        $this->setAjaxResponse();
        return $this->formatResponse(self::STATUS_CODE_FAIL, $message, $url, $data);
    }
    /**
     * [isAjax 判断是否是ajax提交]
     * @author:xiaoming
     * @date:2018-01-18T16:38:14+0800
     * @return                        boolean [description]
     */
    protected function isAjax(){
        return Yii::$app->request->getIsAjax();
    }
    /** [isPost 判断是否是post提交]
     * @author:xiaoming
     * @date:2018-01-18T16:38:14+0800
     * @return                        boolean [description]
     */
    protected function isPost(){
        return Yii::$app->request->getIsPost();
    }
    /**
     * [post 获取post参数]
     * @author:xiaoming
     * @date:2018-01-18T16:39:15+0800
     * @param                         [type] $key     [description]
     * @param                         string $default [description]
     * @return                        [type]          [description]
     */
    protected function post($key, $default = "") {
        return Yii::$app->request->post($key, $default);
    }
    /**
     * [get 获取get参数]
     * @author:xiaoming
     * @date:2018-01-18T16:39:32+0800
     * @param                         [type] $key     [description]
     * @param                         string $default [description]
     * @return                        [type]          [description]
     */
    protected function get($key, $default = "") {
        return Yii::$app->request->get($key, $default);
    }
    /**
     * [getParams 获取配置参数]
     * @author:xiaoming
     * @date:2018-01-18T16:39:43+0800
     * @param                         string $params_name [description]
     * @return                        [type]              [description]
     */
    protected function getParams($params_name = ''){
       return $params_name == '' ? '' : Yii::$app->params[$params_name];
    }
    /**
     * [printSql 打印sql]
     * @author:xiaoming
     * @date:2018-01-18T16:39:54+0800
     * @param                         string $sql [description]
     * @return                        [type]      [description]
     */
    protected function printSql($sql = ''){
       p($sql == '' ? '' : $sql->createCommand()->getRawSql());
    }
    /**
     * [error 输出错误信息，如果为ajax提交，则输出json格式]
     * @author:xiaoming
     * @date:2018-01-18T16:40:04+0800
     * @param                         string  $info   [description]
     * @param                         integer $second [description]
     * @return                        [type]          [description]
     */
    protected function error($info = '操作失败',$second = 3){
        if($this->isAjax()){
          return $this->ajaxFail($info);
        }else{
          return $this->dispatchJump('error',$info,$second);
        }
    }
     /**
     * [error 输出成功信息，如果为ajax提交，则输出json格式]
     * @author:xiaoming
     * @date:2018-01-18T16:40:04+0800
     * @param                         string  $info   [description]
     * @param                         integer $second [description]
     * @return                        [type]          [description]
     */
    protected function success($info = '操作成功',$second = 3){
        return $this->dispatchJump('success',$info,$second);
    }
    /**
     * [dispatchJump 成功 or 失败跳转]
     * @author:xiaoming
     * @date:2018-01-18T16:40:27+0800
     * @param                         string $type   [description]
     * @param                         [type] $info   [description]
     * @param                         [type] $second [description]
     * @return                        [type]         [description]
     */
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
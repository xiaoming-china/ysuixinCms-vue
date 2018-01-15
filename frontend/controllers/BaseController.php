<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Config;


class BaseController extends Controller{
    const STATUS_CODE_SUCC = 1;
    const STATUS_CODE_FAIL = 0;
    
    public $layout=false;
    public $config;

    public function init(){
        $this->enableCsrfValidation = false;
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
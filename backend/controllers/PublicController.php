<?php
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\LoginLog;
use yii\helpers\Url;

/**
 * name:后台公共方法类，包括登录、退出等
 */
class PublicController extends AdminBaseController{
    public function init(){
       $this->enableCsrfValidation = false;
       $this->layout = false;
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin(){
        if (isPost()) {
            $d['username'] = Yii::$app->request->post('username');
            $d['password'] = Yii::$app->request->post('password');
            $model = new LoginForm();
            if ($model->load($d,'') && $model->login()) {
                 $url  = Url::toRoute('/index/index');
                 $log = LoginLog::addLog($d['username'],'登录成功');//写入登录日志
                 if($log){
                    return $this->ajaxSuccess('登录成功',$url);
                 }
                 LoginLog::addLog($d['username'],'登录失败');
                 return $this->ajaxFail('登录失败');
            }else{
                $info = '登录失败。'.current($model->getErrors())[0];
                LoginLog::addLog($d['username'],$info);
                return $this->ajaxFail('登录失败,账号或密码错误');
            }
        }else{
            return $this->render('login');
        } 
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->render('login');
    }


}

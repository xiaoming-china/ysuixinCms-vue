<?php
/**
 * Admin后台首页控制器
 */
namespace backend\controllers;


use Yii;
use backend\controllers\AdminBaseController;
use common\models\LoginLog;
use backend\models\SystemInfo;


class IndexController extends AdminBaseController{

    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:后台主页
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionIndex(){
        $this->layout = 'main-admin';
        return $this->render('index');
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:显示系统信息--主页//p(Yii::$app->params['systemInfo']);
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionMain(){
        $this->layout = false;
        //登录日志列表
        $login_list = LoginLog::find()->limit(10)->asArray()->orderBy('created_at DESC')->all();
        foreach ($login_list as $key => $value) {
            $login_list[$key]['created_at'] = date('Y-m-d H:i:s',$value['created_at']);
        }
        $d['login_list'] = $login_list;
        $d['developer_info'] = Yii::$app->params['developerInfo'];//开发者信息

        return $this->ajaxSuccess('获取成功','',$d);
    }



}
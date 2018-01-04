<?php
/**
 * 个人信息
 */
namespace backend\controllers;


use Yii;
use backend\controllers\AdminBaseController;
use common\models\User;
use common\models\ChangeUserInfo;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class PersonInfoController extends AdminBaseController{
	public $layout = 'main-admin';
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:个人信息
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionPersonInfo(){
        if(isPost()){
            $r = Yii::$app->request;
            $d = [
                // 'username' => $r->post('user_name',''),
                'email'    => $r->post('user_email',''),
                'desc'     => $r->post('desc',''),
                'updated_at'=> time()
            ];
            $userModel = (new User())->findOne($this->uId);
            if(is_null($userModel)){
                fail('未查找到用户信息');
            }
            $model = new ChangeUserInfo();
            $model->setScenario('change_info');

            if($model->load($d,'') && $model->validate()){
                if($model->changeInfo($userModel)){
                   return $this->ajaxSuccess('修改成功');
                }
            }else{
                return $this->ajaxFail('修改失败.'.current($model->getErrors())[0]);
            }
        }else{
            return $this->render('person-info');
        }
        
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:description  修改密码
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionChangePassword(){
        if(isPost()){
            $r = Yii::$app->request;
            $d = [
                'old_pass'       => $r->post('old_pass'),
                'new_pass'       => $r->post('new_pass'),
                'reply_new_pass' => $r->post('reply_new_pass'),
                'updated_at'     => time()
            ];

            $userModel = (new User())->findOne($this->uId);
            if(is_null($userModel)){
                return $this->ajaxFail('未查找到用户信息');
            }

            $model = new ChangeUserInfo();
            $model->setScenario('change_pass');
            $model->user_model = $userModel;

            if($model->load($d,'') && $model->validate()){
                if($model->changePass($userModel)){
                   return $this->ajaxSuccess('修改成功');
                }
            }else{
                return $this->ajaxFail('修改失败.'.current($model->getErrors())[0]);
            }
        }else{
            return $this->render('change-password');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-22
     * @name:description 获取用户信息
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionGetUserInfo(){
        $userInfo = (new User())->find()->select('id,username,email,desc')->where(['id'=>$this->uId])->one();
        if(is_null($userInfo)){
            return $this->ajaxFail('未查找到用户信息.');
        }
        return $this->ajaxSuccess('获取成功','',$userInfo);
    }
}
<?php
namespace common\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ChangeUserInfo extends Model{
    public $username;
    public $email;
    public $desc;

    public $old_pass;
    public $new_pass;
    public $reply_new_pass;

    public $updated_at;

    public $user_model;

    public function scenarios(){
        $s = parent::scenarios();
        $s['change_info'] = ['username', 'email', 'desc','updated_at'];
        $s['change_pass'] = ['old_pass', 'new_pass', 'reply_new_pass','updated_at'];
        return $s;
    }
    public function rules(){
        return [
            ['username', 'trim'],
            // ['username','required','on'=>['change_info']],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在','on'=>['change_info']],
            ['email', 'email','message'=>'邮箱格式不正确','on'=>['change_info']],
            ['desc', 'string', 'max' => 30,'on'=>['change_info']],
            [['old_pass','new_pass','reply_new_pass'],'required','on'=>['change_pass']],
            ['new_pass', 'string', 'max' => 15,'on'=>['change_pass']],
            ['reply_new_pass', 'compare', 'compareAttribute' => 'new_pass', 'operator' => '===', 'message' => '新密码和重复密码值不匹配','on'=>['change_pass']],
            ['old_pass','validateParams','on'=>['change_pass']],
        ];
    }
    /**
     * 旧密码验证
     */
    public function validateParams($attribute,$params){
        if (!$this->hasErrors()) {
            $userModel = $this->user_model;
            if (!$userModel->validatePassword($this->old_pass)) {
                $this->addError($attribute, "旧密码错误");
            }
        }
    }
    public function attributeLabels(){
        return [
            'username'       => '用户名',
            'email'          => '邮箱',
            'auth_key'       => '密码验证key',
            'password_hash'  => '密码验证hash值',
            'status'         => '状态',
            'desc'           => '描述',
            'old_pass'       =>'旧密码',
            'new_pass'       =>'新密码',
            'reply_new_pass' =>'重复新密码'
        ];
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-11
     * @name:description 修改后台用户信息
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function changeInfo($model){
        if (!$this->validate()) {
            return false;
        }
        // $model->username = $this->username;
        $model->email = $this->email;
        $model->desc = $this->desc;
        $model->updated_at = time();
        
        return $model->save() ? $model : false;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-11
     * @name:description 修改密码
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function changePass($model){
        $model->setPassword($this->new_pass);
        $model->removePasswordResetToken();

        return $model->save(false);
    }


}

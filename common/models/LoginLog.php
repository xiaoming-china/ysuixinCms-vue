<?php

namespace common\models;

use Yii;
use \wsl\ip2location\Ip2Location;
use common\models\BaseModel;
/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property integer $status
 * @property string $ip
 * @property string $desc
 * @property integer $created_at
 */
class LoginLog extends \yii\db\ActiveRecord{
    
    const LOGON_STATUS = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%login_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['ip'], 'string', 'max' => 30],
            [['desc','area'], 'string', 'max' => 50],
            [['created_at'], 'integer']
        ];
    }

    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-10
     * @name:description 添加日志信息
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            [type]      $user_id [description]
     * @param            [type]      $type    [description]
     * @param            [type]      $ip      [description]
     * @param            [type]      $desc    [description]
     */
    public function addLog($username,$desc){
        $model = new LoginLog();
        $ip   = Yii::$app->request->userIP;
        $area = (new Ip2Location())->getLocation($ip)->toArray();
        $d['username']   = $username;
        $d['ip']         = $ip;
        $d['area']       = $area['country'].' '.$area['area'];
        $d['desc']       = $desc;
        $d['created_at'] = time();
        if (!$model->hasErrors()) {
             if($model->load($d,'') && $model->save()){
               return true;
            }
        }
        return false;
    }
}

<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


class BaseModel extends ActiveRecord{
    
  public function behaviors(){
      return [
          [
              'class' => TimestampBehavior::className(),
              'createdAtAttribute' => 'created_at',
              'updatedAtAttribute' => 'updated_at',
              'value' => time(),
          ],
      ];
  }
    /**
     * [setErrorInfo 错误信息]
     * @author:xiaoming
     * @date:2017-12-29T17:45:45+0800
     */
    static function E($message = ''){
        $d['status']  = 0;
        $d['message'] = $message;
        $d['url']     = '';
        $d['data']    = '';
        echo json_encode($d);
        exit;
    }




}

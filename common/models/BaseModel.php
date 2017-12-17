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




}

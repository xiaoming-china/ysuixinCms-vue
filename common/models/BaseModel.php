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
    /**
     * [selectDate 格式化搜索时间参数]
     * @author:xiaoming
     * @date:2018-01-09T17:18:05+0800
     * @param                         string $start_time [description]
     * @param                         string $end_time   [description]
     * @return                        [type]             [description]
     */
    public static function selectDate($start_time='',$end_time=''){
      if($start_time != '' && $end_time != ''){
        $d['start_time'] = strtotime(date('Y-m-d',strtotime($start_time) - 86400).' 23:59:59');
        $d['end_time']   = strtotime(date('Y-m-d',strtotime($end_time) + 86400).' 00:00:00');
      }else{
        $d['start_time'] = '';
        $d['end_time']   = '';
      }
      return $d;
    }




}

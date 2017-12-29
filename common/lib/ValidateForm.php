<?php
/**
 * 生成前端js验证模型
 */
namespace common\lib;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\BaseModel;
use common\models\Field;

class ValidateForm extends BaseModel{
    const DELETE_STATUS_TRUE  = 1;//已删除状态
    const DELETE_STATUS_FALSE = 2;//未删除状态

    const OPEN_STATUS  = 1;//开启状态
    const CLOSE_STATUS = 2;//禁用状态

    const IS_STYLE = 1;//是系统字段
    const NO_STYLE = 2;//否系统字段

    const IS_HIDE = 1;//是否隐藏，隐藏
    const NO_HIDE = 2;//是否隐藏，不隐藏

    const NO_NULL = 1;//不能为空
    const IS_NULL = 2;//能为空
    /**
     * [EchoValidateJs 验证发布内容的数据合法性]
     * @author:xiaoming
     * @date:2017-12-26T09:59:11+0800
     * @param                         [type] $dat [description]
     */
    public static function ValidateForm($model_field = [],$data=[]){
        if(empty($model_field) || empty($data)){
            return false;
        }
        foreach ($model_field as $key => $value) {
            foreach ($data as $k => $v) {
                if(($value['e_name'] === $k)){
                    if($value['not_null'] == Field::NO_NULL){
                       self::ValidateNotNull($value,$v);
                    }
                }
            }
        }
        return true;
    }
    /**
     * [ValidateNotNull 验证非空判断]
     * @author:xiaoming
     * @date:2017-12-29T15:57:28+0800
     */
    static function ValidateNotNull($value = '',$v = ''){
        if($value == ''){
            self::E('数据非空验证代码异常');
        }
        $info = '';
        if($value['not_null_info'] != ''){
            $info = $value['not_null_info'];
        }else{
            $info = $value['name'].'不能为空';
        }
        if($v == ''){
            self::E($info);
        }
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

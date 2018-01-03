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
            $seetings = unserialize($value['seetings']);
            foreach ($data as $k => $v) {
                if(($value['e_name'] === $k)){
                    //非空验证
                    if($value['not_null'] == Field::NO_NULL){
                       self::ValidateNotNull($value,$v);
                    }
                    //字符长度验证
                    if(in_array($value['type'],Field::TEXT)){
                        self::ValidateLength($value,$v);
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
            self::E('数据非空验证数据异常');
        }
        $info = '';
        if($value['not_null_info'] != ''){
            $info = $value['not_null_info'];
        }else{
            $info = $value['name'].'不能为空';
        }
        if($v == '' && $info != ''){
            BaseModel::E($info);
        }
    }
    /**
     * [ValidateNotNull 验证字符长度]
     * @author:xiaoming
     * @date:2017-12-29T15:57:28+0800
     */
    static function ValidateLength($value = '',$v = ''){
        if($value == ''){
            self::E('字符长度验证数据异常');
        }
        $seetings = unserialize($value['seetings']);
        //字符长度验证
        if($seetings['min_length'] == 0 && $seetings['max_length'] == 0){
            return true;
        }
        $info = '';
        if(mb_strlen($v) > $seetings['max_length']){
            $info =  $value['name'].'最多'.$seetings['max_length'].'字符';
        }
        if(mb_strlen($v) < $seetings['min_length']){
            $info =  $value['name'].'最少'.$seetings['min_length'].'字符';
        }
        if($info != ''){
            BaseModel::E($info);
        }

    }

    /**
     * @Author:          xiaoming
     * @DateTime:        2017/12/31 11:22
     * @name:           将前端传送的数据重新组装，再进行合法性验证
     * @param array $model_field
     * @param array $data
     * @return array
     */
    public static function content_data($model_field = [],$data=[]){
        foreach ($model_field as $k => $v){
            $seetings = unserialize($v['seetings']);
             if(in_array($v['type'], Field::IMG)){
                if(!empty($data[$v['e_name']])){
                    if($seetings['many_select'] == 'false'){
                        $data[$v['e_name']] = $data[$v['e_name']][0];
                    }else{
                        $data[$v['e_name']] = serialize($data[$v['e_name']]);
                    }
                }else{
                    $data[$v['e_name']] = '';
                }
             }
        }
        return $data;
    }



}

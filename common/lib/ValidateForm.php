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
     * [EchoValidateJs 生成前端验证JS]
     * @author:xiaoming
     * @date:2017-12-26T09:59:11+0800
     * @param                         [type] $dat [description]
     */
    public function EchoValidateJs($data = []){
        if(empty($data)){
            return false;
        }
        // user_name: [
        //     { required: true, message: '账号不能为空', trigger:'blur'}
        // ],
        $d = [];
        foreach ($data as $key => $value) {
            if($value['not_null'] == self::NO_NULL){
                $t['title'] = [
                    [
                        'type'=> 'number',
                        'required'=> true,
                        'message' =>'不能为空',
                        'trigger' =>'blur',
                    ],
                    [
                        'type'=> 'number',
                        'required'=> true,
                        'message' =>'不能为空',
                        'trigger' =>'blur',
                    ]
                ];
                // if($value['not_null_info'] == ''){
                //     $t[$value['e_name']]['message'] = $value['name'].'不能为空';
                // }else{
                //     $t[$value['e_name']]['message'] = $value['not_null_info'];
                // }
                // $t[$value['e_name']]['trigger'] = 'blur';
                $d[] = $t; 
            }
        }
        return $d;

    }



}

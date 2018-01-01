<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\BaseModel;

class Field extends BaseModel{
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

    const CHECKED_TRUE  = 1;
    const CHECKED_FALSE = 2;

    const SELECT_TYPE = ['radio','checkbox','select'];//有选项值的类型
    const DATE = ['date','time','dateAndTime'];
    const IMG  = ['pic_upload'];
    const TEXT = ['text','textarea'];



    public static function tableName(){
        return '{{%model_field}}';
    }

    public function scenarios(){
        $s = parent::scenarios();
        $s['add_filed']     = ['model_id','name','e_name','not_null_info','error_info','type','created_at','updated_at','not_null','name_desc','is_hide','seetings'
        ];
        $s['edit_filed']     = ['name','e_name','not_null_info','error_info','type','created_at','updated_at','not_null','name_desc','is_hide','seetings'
        ];
        return $s;
    }
    public function rules(){
        return [
            [['model_id','name', 'e_name','seetings'], 'required','message'=>"{attribute}不能为空",'on'=>['add_filed','edit_filed']],
            [['is_hide', 'not_null'], 'integer','on'=>['add_filed','edit_filed']],
            [['name', 'e_name'], 'string', 'max' => 10,'on'=>['add_filed','edit_filed']],
            [['e_name'],'match','pattern'=>'/^[a-zA-Z\s]+$/','message'=>'字段标识只能为英文','skipOnEmpty' => false, 'skipOnError' => false,'on'=>['add_filed','edit_filed']], 
            [['name_desc'], 'string', 'max' => 30,'on'=>['add_filed','edit_filed']],
            [['not_null_info', 'error_info'], 'string', 'max' => 15,'on'=>['add_filed','edit_filed']],
            // ['select_value','validateParams','skipOnEmpty' => false, 'skipOnError' => false,'on'=>['add_filed','edit_filed']],
        ];
    }
     /**
     * 各数组参数验证
     */
    public function validateParams($attribute,$params){
        if(($this->type == 2 || $this->type == 3) && $this->select_value == ''){
            $this->addError($attribute, "选项值不能为空");
        }
    }

    public function attributeLabels(){
        return [
            'id' => 'ID',
            'model_id' => '模型ID',
            'name' => '字段名称',
            'e_name' => '字段标识',
            'type' => '字段类型',
            'format' => '字段格式',
            'select_value' => '选项值',
            'not_null' => '是否必填',
            'max_length' => '最大值',
            'min_length' => '最小值',
            'regular' => '正则验证',
            'not_null_info' => '必填时提示信息',
            'error_info' => '错误提示信息',
            'status' => '状态',
            'is_deleted' => '是否删除',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'name_desc'=>'字段填写描述',
            'is_hide'=>'是否隐藏'
        ];
    }
    public function getModelField($modelid = ''){
        if($modelid == ''){
            return false;
        }
        $model_field = $this->find()->where([
            'model_id'=>$modelid,
            'status'=>Field::OPEN_STATUS,
            'is_delete'=>Field::DELETE_STATUS_FALSE,
            'is_hide'=>Field::NO_HIDE
        ])->asArray()->orderBy('sort ASC')->all();
        return $model_field;
    }
    /**
     * [EchoModelField 生成前端字段，输出到前端]
     * @author:xiaoming
     * @date:2017-12-26T10:02:53+0800
     * @param                         [type] $data [description]
     */
    public static function EchoModelField($data = []){
        if(empty($data)){
            return false;
        }
        $d = [];
        foreach ($data as $key => $value) {
           $t = [];
           $t['name']          = $value['name'];
           $t['e_name']        = $value['e_name'];
           $t['name_desc']     = $value['name_desc'];
           $t['type']          = $value['type'];
           $t['not_null']      = $value['not_null'];
           $t['not_null_info'] = $value['not_null_info'];
           $t['value']         = '';
           $seetings      = unserialize($value['seetings']);
           $t['seetings'] = $seetings;
           if(in_array($value['type'], self::SELECT_TYPE)){
             $t['seetings']['default_value'] = self::selectValue($seetings)['select'];
             $t['value'] = self::selectValue($seetings)['checked'][0];
           }
           if(in_array($value['type'], self::DATE)){
             $t['seetings']['default_value'] = self::seetingsDate($seetings);
             $t['value'] = self::seetingsDate($seetings);
           }
           if(in_array($value['type'], self::IMG)){
            $t['value'] = [];
           }
           $d[] = $t;
        }
        return $d;
    }
    private static function imgValue($seetings = ''){
        if($seetings == ''){
            return '';
        }
        if($seetings['many_select'] === 'false'){
            return '';
        }else{
            return [];
        }

    }
    /**
     * [selectValue 字段选项值处理]
     * @Author:xiaoming
     * @DateTime        2017-12-17T17:55:49+0800
     * @param           string                   $seetings [description]
     * @return          [type]                             [description]
     */
    private static function selectValue($seetings = ''){
        if($seetings == ''){
            return '';
        }
        $value1 = explode("\n",$seetings['default_value']);
        // p($value1);
        $data  = $checked = [];
        foreach ($value1 as $k => $v) {
            $str = [];
            $value2         = explode('|',$v);
            $str['name']    = $value2[0];
            $str['value']   = $value2[1];
            if($value2[2] == 'true' && $seetings['many_select'] == 'false'){
                array_push($checked, $value2[1]);
            }else{
                $checked = $value2[1];
            }
            $data[] = $str;
        }
        $d['select']  = $data;
        $d['checked'] = $checked;
        return $d;
    }
    /**
     * [seetingsDate 字段日期处理]
     * @Author:xiaoming
     * @DateTime        2017-12-17T17:56:15+0800
     * @param           string                   $seetings [description]
     * @return          [type]                             [description]
     */
    private static function seetingsDate($seetings = ''){
        if($seetings == ''){
            return '';
        }
        if($seetings['type'] === 'date'){
            if($seetings['default_value'] == '1'){
               $value = date('Y-m-d');
           }else{
                $value = '';
           } 
        }elseif($seetings['type'] === 'time'){
            if($seetings['default_value'] == '1'){
               $value = date('H:i:s');
           }else{
                $value = '';
           } 
        }elseif($seetings['type'] === 'dateAndTime'){
            if($seetings['default_value'] == '2'){
               $value = date('Y-m-d H:i:s');
           }else{
                $value = '';
           } 
        }
        return $value;
    }

}

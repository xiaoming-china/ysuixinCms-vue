<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
/**
 * This is the model class for table "{{%model}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $status
 * @property integer $is_delete
 * @property integer $created_at
 * @property integer $updated_at
 */
class Model extends BaseModel{

    const DELETE_STATUS_TRUE  = 1;//已删除状态
    const DELETE_STATUS_FALSE = 2;//未删除状态

    const OPEN_STATUS  = 1;//开启状态
    const CLOSE_STATUS = 2;//禁用状态


    public static function tableName(){
        return '{{%model}}';
    }
    public function scenarios(){
        $s = parent::scenarios();
        $s['add_model']     = ['name','e_name','status','desc','created_at','updated_at'];
        $s['edit_model']    = ['name','e_name','status','desc','created_at','updated_at'];
        $s['update_model']  = ['name','status','desc','created_at','updated_at'];
        $s['change_status'] = ['id','status'];
        return $s;
    }

    public function rules(){
        return [
            [['name','e_name'], 'required','message'=>'{attribute}不能为空','on'=>['add_model','update_model']],
            [['name','e_name'], 'string', 'max' => 10,'on'=>['add_model','update_model']],
            [['id'], 'required','on'=>['change_status','delete_model']],
            ['status', 'in', 'range' => [1, 2],'on'=>['change_status','add_model','update_model']],
        ];
    }
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => '模型名称',
            'desc' => '模型描述',
            'status' => '模型状态',
            'created_at' => '模型创建时间',
            'updated_at' => '模型更新时间',
        ];
    }
    public function getModelInfo($model_id = ''){
        if($model_id == ''){
            return false;
        }
        $rs = $this->findOne($model_id);
        if($rs === null){
            return false;
        }
        return $rs;
    }
}

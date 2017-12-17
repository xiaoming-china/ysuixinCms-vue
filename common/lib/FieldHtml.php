<?php
/**
 * name:form处理类
 * user:xiaoming
 * time:2017/6/2 
 */
namespace common\lib;
use yii\helpers\Html;
use common\widgets\UploadOneWidget;
use common\widgets\UploadManyWidget;
use common\widgets\EditorWidget;
use common\models\BaseModel;


class FieldHtml extends BaseModel{
    // 1文本框
    // 2单选框
    // 3多选框
    // 4多文件上传
    // 5单文件上传
    // 6富文本编辑器
    // $arr=explode("\n",$configParams['default_value']);
    // print_r($arr);
    // echo count($arr).'<br />';//回车数
    const NOT_NULL = 1;//不能为空
    const IS_NULL  = 2;//可以为空


    public function fieldHtml($field = []){
        if (empty($field)) {
            return '';
        }
        switch ($field['type']) {
            case 1:
              return self::textHtml($field);
            break;
            case 2:
              return self::textareaHtml($field);
            break;
            case 3:
              return self::radioHtml($field);
            break;
            case 4:
              return self::checkboxHtml($field);
            break;
            case 6:
              return self::uploadOneHtml($field);
            break;
            case 7:
              return self::editorHtml($field);
            break;
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description 文本框html生成
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function textHtml($field = []){
        $str = '<input type="text" style="width:400px;padding: 6px 4px;" class="input" name="'.$field['e_name'].'">';
        return $str;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description 多文本框文本框html生成
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function textareaHtml($field = []){
        $str = '<textarea style="height:100px;width:405px;" name="'.$field['e_name'].'"></textarea>';
        return $str;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description 单选框html生成
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function radioHtml($field = []){
        $value = $field['select_value'];
        if($value == ''){
            return '';
        }
        $value1 = explode(';',$field['select_value']);
        $str = '';
        foreach ($value1 as $k => $v) {
            $value2 = explode('|',$v);
            $checked = $value2[2] == 'true' ? 'checked':'';
            $str .= '<input type="radio" value="'.$value2[1].'" name="'.$field['e_name'].'"'.$checked.'>&nbsp'.$value2[0];
        }
        return $str;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description 多选框html生成
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function checkboxHtml($field = []){
        //男|0;女|1
        $value = $field['select_value'];
        if($value == ''){
            return '';
        }
        $value1 = explode(';',$field['select_value']);
        $str = '';
        foreach ($value1 as $k => $v) {
            $value2 = explode('|',$v);
            $checked = $value2[2] == 'true' ? 'checked':'';
            $str .= '<input type="checkbox" value="'.$value2[1].'" name="'.$field['e_name'].'"'.$checked.'>'.$value2[0].'&nbsp&nbsp&nbsp';
        }
        return $str;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description单文件上传html
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function uploadOneHtml($field = []){
      return UploadOneWidget::widget(['id'=>$field['id'],'inputName'=>$field['e_name'],'defaultValue'=>'/public/admin/img/product3.png']);  
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-17
     * @name:description单文件上传html
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            array       $field [description]
     * @return           [type]             [description]
     */
    public function editorHtml($field = []){
      return EditorWidget::widget(['id'=>$field['id'],'inputName'=>$field['e_name'],'defaultValue'=>'']);  
    }


    




    



}



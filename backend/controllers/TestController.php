<?php

namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Category;
use common\models\Model;
use yii\db\Connection;
use yii\helpers\Url;
use common\lib\PinYin;
use common\lib\Tree;


class TestController extends AdminBaseController{
    public function actionSerialize($type){
        if($type == 'title'){
            $s['watermark']     = '';
            $s['many_select']   = '';
            $s['default_value'] = '';
            $s['type']          = 'text';
            $s['min_length']    = 1;  
            $s['max_length']    = 30;              
            $s['width']         = '';
            $s['height']        = '';
            $s['allow_format']  = '';  
        }
        if($type == 'keywords'){
            $s['watermark']     = '';
            $s['many_select']   = '';
            $s['default_value'] = '';
            $s['type']          = 'text';
            $s['min_length']    = 0;  
            $s['max_length']    = 300;            
            $s['width']         = '';
            $s['height']        = '';
            $s['allow_format']  = '';  
        }
        if($type == 'thumb'){
            $s['watermark']     = 'false';
            $s['many_select']   = 'false';
            $s['default_value'] = '';
            $s['type']          = 'text';
            $s['min_length']    = 0;  
            $s['max_length']    = 300;            
            $s['width']         = 140;
            $s['height']        = 140;
            $s['allow_format']  = 'gif|jpg|jpeg|png|bmp';  
        }
        if($type == 'desc'){
            $s['watermark']     = '';
            $s['many_select']   = '';
            $s['default_value'] = '';
            $s['type']          = 'textarea';
            $s['min_length']    = 0;  
            $s['max_length']    = 300;            
            $s['width']         = '';
            $s['height']        = '';
            $s['allow_format']  = ''; 
        }
        if($type == 'content'){
            $s['watermark']     = '';
            $s['many_select']   = '';
            $s['default_value'] = '';
            $s['type']          = 'editor';
            $s['min_length']    = 0;  
            $s['max_length']    = 0;            
            $s['width']         = '';
            $s['height']        = '';
            $s['allow_format']  = ''; 
        }
      
        echo serialize($s);
    }


    public function actionUeditor(){
        $this->layout = false;
        return $this->render('/test/ueditor');
    }







}
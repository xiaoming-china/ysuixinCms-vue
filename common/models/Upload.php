<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class Upload extends Model{

    public $file;
    public $upload_type;//img图片；file文件
    public $allow_img_type;//允许上传图片类型
    public $max_size;//允许上传最大值
    public $save_path;//上传路径
    public $allow_file_type;//允许上传文件类型
    public $php_url;

    public function init() {
        $this->allow_img_type   = ['gif','jpg','jpeg','png','bmp'];
        $this->max_size         = 1000000;
        $this->save_path        = 'uploads/img'.date('Ymd');
        $this->allow_file_type  = ['gif','jpg','jpeg','png','bmp'];
        parent::init();
    }
    /**
    * [checkType 检测文件类型]
    * @Author:xiaoming
    * @DateTime        2017-04-19T13:58:44+0800
    * @param           [type]                   $ext [description]
    * @return          [type]                        [description]
    */
   public function checkType($ext){
        //这里貌似不需要转换大小写。。。。
        //print_r($this->allow_img_type);exit;
        
        if($this->upload_type == 'img'){
          $r = in_array($ext,$this->allow_img_type);
        }else if($this->upload_type == 'file'){
          $r = in_array($ext,$this->allow_file_type);
        }else{
          return false;
        }
        if ($r === false) {
            return false;
        }
        return true;
   }
   /**
    * [checkSize 检测文件大小]
    * @Author:xiaoming
    * @DateTime        2017-04-19T14:32:28+0800
    * @param           [type]                   $allow_size [description]
    * @param           [type]                   $size       [description]
    * @return          [type]                               [description]
    */
   public function checkSize($size){
      if($size > $this->max_size) {
        return false;
      }
      return true;
   }
   /**
    * [createDir 文件上传存放的目录]
    * @Author:xiaoming
    * @DateTime        2017-04-19T14:52:47+0800
    * @param           [type]                   $dir [description]
    * @return          [type]                        [description]
    */
   public function createDir($dir){
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, true)){
               return false;
            }else{
              return true;
            }
        }else{
          return true;
        }
        return false;
   }
}


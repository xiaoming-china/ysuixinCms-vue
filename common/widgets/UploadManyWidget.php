<?php 
   namespace common\widgets;
   use common\models\Upload;
   use yii\base\Widget;
class UploadManyWidget extends Widget {
   
      public $id;//编号
      public $inputName;//文本框名称
      public $value;//已上传图片列表
      
      public function init() { 
         parent::init();
      }
      public function run() {
         return $this->render('imgMany.php',[
            'id'=>$this->id,
            'inputName'=>$this->inputName,
            'value'=>$this->value
         ]);
      }


} 
?>
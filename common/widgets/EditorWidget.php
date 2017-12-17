<?php 
   namespace common\widgets;
   use common\models\Upload;
   use yii\base\Widget;
   use yii;
class EditorWidget extends Widget {

      public $id;//编号
      public $inputName;//文本框名称
      public $defaultValue;//默认值
      
      public function init() { 
         parent::init();
      }
      public function run() {
         return $this->render('editor.php',[
          'id' => $this->id,
          'inputName' => $this->inputName,
          'defaultValue' => $this->defaultValue
         ]);
      }
} 
?>
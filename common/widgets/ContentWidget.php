<?php 
/**
 * 内容widget；包括导航、栏目、内容列表
 */
namespace common\widgets;

use yii;
use yii\base\Widget;
use common\models\Category;

class ContentWidget extends Widget {
    public $type; //['nav','content','category']
    public $result; 

    public function init() { 
       parent::init();
       if($this->type === null){
          $this->result = '1111';
       }else{
        $this->result = [];
       }
       ob_start();
    }  
    public function run() { 
      $content = ob_get_clean();
       return "<h1>$this->result</h1>"; 
    } 
} 
?>
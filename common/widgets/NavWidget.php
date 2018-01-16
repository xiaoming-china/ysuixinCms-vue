<?php 
/**
 * 导航widget；
 */
namespace common\widgets;

use yii;
use yii\base\Widget;
use common\models\Category;

class NavWidget extends Widget {
    public $template;
    public $result; 

    public function init() { 
       parent::init();
       if($this->template === null){
          $this->result = '';
       }else{
        $category_list = (new Category())->getAllCategory();
        $rs = (new Category())->manyArray($category_list);
        $this->result = $rs;
       }
    }  
    public function run() { 
      return $this->render('nav',['data'=>$this->result]);
    } 
} 
?>
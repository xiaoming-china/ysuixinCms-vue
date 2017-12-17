<?php 
   namespace common\widgets;

   use yii;
   use yii\base\Widget;
   use common\models\Menu;
class AdminMenuWidget extends Widget {

      public $type;//编号
      
      public function init() { 
        $this->type = 0;
         parent::init();
      }
      public function run() {

        $model = new Menu();
        $sql = $model->find();
        $sql->andWhere(['parent_id'=>$this->type]);
        $sql->orderBy('sort ASC');

        $menu_list = $sql->asArray()->all();
        //print_r($menu_list);exit;


        //return $menu_list;
      }
} 
?>
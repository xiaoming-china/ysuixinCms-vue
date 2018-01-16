<?php 
/**
 * 内容widget；
 */
namespace common\widgets;

use yii;
use yii\base\Widget;
use common\models\Category;
use common\lib\sqlQuery;
use yii\helpers\ArrayHelper;

class ContentWidget extends Widget {
    public $template;
    public $result   = '';
    public $page     = 0; 
    public $pageSize = 20; 


    public function init() { 
       parent::init();
       $catid = !isset($_GET['catid']) || $_GET['catid'] == '' ? '' : $_GET['catid'] ;
       if($catid == ''){
        exit('栏目ID不能为空');
       }
       $param   = [
        'catId'    => $catid,
        'page'     => $this->page,
        'pageSize' => $this->pageSize,
       ];
       $category_model = (new Category())->getCategoryModel($catid);
       $table_name = $category_model['table_name'];
       $this->result = (new sqlQuery())->selectData($table_name,$param);
    }  
    public function run() {
      $str = '';
      $d = [];
      foreach ($this->result['list'] as $key => $value) {
        foreach ($value as $k => $v) {
          $t = strpos($this->template,"{".$k."}");
          if($t){
            $d["{".$k."}"] = $value[$k];
          }
        }
        $str .= strtr($this->template,$d);
      }
      return $str;
    }
} 
?>
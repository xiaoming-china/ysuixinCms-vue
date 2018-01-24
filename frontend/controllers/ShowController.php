<?php
namespace frontend\controllers;

use frontend\controllers\FrontendBaseController;
use yii;
use common\models\Category;
use common\models\Page;
use common\lib\sqlQuery;

class ShowController extends FrontendBaseController{
    /**
     * [actionIndex 内容展示页]
     * @author:xiaoming
     * @date:2018-01-15T15:44:14+0800
     * @return                        [type] [description]
     */
    public function actionIndex(){
        $catid = $this->get('catId','');
        if($catid == ''){
            return $this->error('参数异常');
        }
        $category_info = (new Category())->getCategoryInfo($catid);
        if($category_info['type'] == Category::STSTEM_CATEGORY){
            $id    = $this->get('id','');
            if($id ==''){
                return $this->error('参数异常');
            }
            $rs = (new sqlQuery())->selectContentData($category_info['table_name'],$id);
            return $this->render($this->config['theme'].'Show/show',[
             'data'=>$rs
            ]);
        }else{
            $rs =  (new Page())->getPageInfo($catid);
            $rs['keywords'] = $category_info['setting']['category_keywords'];
            $rs['desc']     = $category_info['setting']['category_desc'];
            return $this->render($this->config['theme'].'Page/page',[
             'data'=>$rs
            ]);
        }
    }
}
?>
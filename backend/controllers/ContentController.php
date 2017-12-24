<?php
/**
 * 发布内容控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Category;
use common\lib\Tree;
use common\lib\sqlQuery;
use common\models\Field;
use common\models\Model;
use yii\db\Command;
use yii\helpers\Url;

class ContentController extends AdminBaseController{
    public $layout = false;
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-15
     * @name:description 栏目内容列表,如果栏目id为空，则查询全部的内容列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionList(){
        if($this->isAjax()){
           $catid = $this->get('catId','');
           $page  = $this->get('page',0);
           $param = $this->get('param',[]);
           if($catid == ''){
            return $this->ajaxFail('栏目ID不能为空');
           }
           $category_model = (new Category())->getCategoryModel($catid);
           if(!$category_model){
            return $this->ajaxFail('数据获取失败');
           }
           $table_name = $category_model['table_name'];
           $data = (new sqlQuery())->selectData($table_name,$param);
           return $this->ajaxSuccess('获取成功','',$data);
        }else{
           return $this->render('/content/content-list');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:发布控制器
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionAddContent(){
        $this->layout = false;
        if($this->isPost()){
            $post    = Yii::$app->request->post();
            p($post);
            $post['category_id'] = $catid;
            $model_field = (new Field())->getModelField($modelid);
            //验证数据库字段的合法性
            $validate = $this->validateField($model_field,$post);
            if($validate['status']){
                $rs = (new sqlQuery())->assembleSql($post,$modelid);
                if($rs){
                    return $this->ajaxSuccess('发布成功',Url::to(['publish/'.$category_info['url']]));
                }else{
                    return $this->ajaxFail('发布失败，未知错误');
                }
            }else{
                return $this->ajaxFail($validate['message']);
            }
        }else{
            return $this->render('/content/add-content');
        }
    }
    public function validateField($field = [],$data=[]){
        foreach ($field as $key => $value) {
            foreach ($data as $k => $v) {
                if(($value['e_name'] === $k) && $value['not_null'] == Field::NO_NULL){
                    if($v == ''){
                        $d['status']  = false;
                        $d['message'] = $value['name'].'不能为空';
                        return $d;
                    }
                }
            }
        }
        $d['status'] = true;
        $d['message'] = '';
        return $d;
    }

        /**
     * [actionGetModelField 获取模型的所有字段，用于生成前端form]
     * @Author:xiaoming
     * @DateTime        2017-12-16T17:28:08+0800
     * @return          [type]                   [description]
     */
    public function actionGetModelField(){
        $modelid = Yii::$app->request->get('modelid','');
        if($modelid == ''){
          return $this->ajaxFail('模型ID不能为空');
        }
        //获取当前栏目所属模型的所有字段
        $model_field = (new Field())->getModelField($modelid);
        //获取当前栏目所属模型的所有栏目
        $category_list = (new Category())->getCategoryList($modelid);
        if(!$model_field || !$category_list){
            return $this->ajaxFail('添加内容数据获取失败');
        }
        $all_category = (new Category())->manyArray($category_list, 0);
        $d['model_field']  = $model_field;
        $d['all_category'] = $all_category;
         return $this->ajaxSuccess('获取成功','',$d);
    }



}
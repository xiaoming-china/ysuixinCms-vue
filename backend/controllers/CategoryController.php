<?php
/**
 * 栏目控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Category;
use common\models\Model;
use yii\db\Connection;
use yii\helpers\Url;
use common\lib\PinYin;
use common\lib\Tree;


class CategoryController extends AdminBaseController{
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-13
     * @name:栏目列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionCategoryList(){
        if($this->isPost()){
            $category_list = (new \yii\db\Query())
            ->select('c.*,m.name AS model_name')
            ->from(Category::tableName().'AS c')
            ->leftJoin(Model::tableName().' AS m','m.id = c.modelid')
            ->where(['c.is_delete'=>Category::DELETE_STATUS_FALSE])
            ->all();
            $allcategory = (new Tree())->navigation($category_list,0,0,'parentid','catid');
            return $this->ajaxSuccess('获取成功','',$allcategory);
        }else{
            return $this->render('/category/category-list');
        }
    }
    /**
     * [actionGetCategoryList 根据模型ID获取栏目列表]
     * @author:xiaoming
     * @date:2017-12-15T15:21:36+0800
     * @return                        [type] [description]
     */
    public function actionGetCategoryList(){
        $m_id = $this->get('modelId','');
        if($m_id == ''){
          return $this->ajaxFail('参数异常,模型ID不能为空');
        }
        $category_list = (new Category())->getCategoryList($m_id);
        if($category_list === false){
            return $this->ajaxFail('栏目列表获取失败');
        }
        $all_category = (new Category())->HtmlManyArray($category_list,$pid = 0);
        return $this->ajaxSuccess('获取成功','',$all_category);
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 添加栏目
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionAddCategory(){
        if($this->isPost()){
            $transaction = Yii::$app->db->beginTransaction();
            $model = new Category();
            $model->setScenario('add_category');
            $post     = Yii::$app->request->post();
            $parentid = $post['parentid'];
            $post['letter']  = (new PinYin())->getAllPY($post['catname']);//拼音转换
            $post['setting'] = serialize($post['setting']);

            try {  
                if($model->load($post,'') && $model->validate()){
                    $model_rs = $model->save(false);
                    if($parentid != 0){
                        $parentInfo = (new Category())->findOne($parentid);
                        if(is_null($parentInfo)){
                            $transaction->rollBack();
                            return $this->ajaxFail('添加失败,未查找到父级信息');
                        }else{
                            $parentInfo->child = Category::IS_HAVE_CHILD;
                            $parent_rs = $parentInfo->save(false);
                            if(!$parent_rs){
                                $transaction->rollBack();
                                return $this->ajaxFail('添加失败,未知错误');
                            }
                        }
                    }
                    if(!$model_rs){
                        $transaction->rollBack();
                        return $this->ajaxFail('添加失败,未知错误');
                    }
                    $transaction->commit();
                    return $this->ajaxSuccess('添加成功',Url::to(['/category/category-list']));
                }else{
                    return $this->ajaxFail('添加失败.'.current($model->getErrors())[0]);
                }
            }catch (Exception $e) {
               $transaction->rollBack();
               return $this->ajaxFail('添加失败,代码异常');
            }
        }else{
            return $this->render('/category/add-category');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 编辑栏目
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionEditCategory(){
        if($this->isPost()){
            $id = $this->post('catid','');
            $post   = Yii::$app->request->post();
            if($id == ''){
              return $this->ajaxFail('参数异常,栏目ID不能为空');
            }
            $parentid = $this->post('parentid');
            $model = (new Category())->findOne($id);
            if(is_null($model)){
                return $this->ajaxFail('编辑失败，未找到栏目信息');
            }
            $model->setScenario('edit_category');
            $post = Yii::$app->request->post();
            $post['letter'] = (new PinYin())->getAllPY($post['catname']);//拼音转换 
            $post['setting'] = serialize($post['setting']);
            $transaction = Yii::$app->db->beginTransaction();
            try {  
                if($model->load($post,'') && $model->validate()){
                    $model_rs = $model->save();
                    if($parentid != 0){
                        $parentInfo = (new Category())->findOne($parentid);
                        if(is_null($parentInfo)){
                            $transaction->rollBack();
                            return $this->ajaxFail('添加失败,未查找到父级信息');
                        }else{
                            $parentInfo->child = Category::IS_HAVE_CHILD;
                            $parent_rs = $parentInfo->save(false);
                            if(!$parent_rs){
                                $transaction->rollBack();
                                return $this->ajaxFail('添加失败,未知错误');
                            }
                        }
                    }
                    if(!$model_rs){
                        $transaction->rollBack();
                        return $this->ajaxFail('编辑失败,未知错误');
                    }
                    $transaction->commit();
                    return $this->ajaxSuccess('编辑成功',Url::to(['/category/category-list']));
                }else{
                    return $this->ajaxFail('编辑失败.'.current($model->getErrors())[0]);
                }
            }catch (Exception $e) {
               $transaction->rollBack();
               return $this->ajaxFail('编辑失败,未知错误');
            }
        }else{
            return $this->render('/category/edit-category');
        }
    }

    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 删除栏目
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionDelCategory(){
        if($this->isPost()){
            $id        = $this->post('id','');
            if($id == ''){
                return $this->error('栏目ID不能为空');
            }
            $model = (new Category())->findOne($id);
            if(is_null($model)){
                return $this->ajaxFail('未找到相关数据');
            }
            //所有栏目
            $all_category =(new Category())->find()->asArray()->all();
            //当前栏目的所有子级
            $all_child = (new Tree())->getMenuTree($all_category, $id, 0,'parentid','catid');
            array_push($all_child,$id);//将当前的栏目追加到子级数组
            $find_all_category = (new Category())->find()
                        ->where(['and',
                            ['catid'=>$all_child]
                        ])->all();
            $r = true;
            foreach ($find_all_category as $all_model) {
                if($all_model->delete()){
                    $r = true;
                }else{
                    $r = false;
                    break;
                }
            }
            if($r === false){
                return $this->ajaxFail('删除失败,未知错误');
            }else{
                return $this->ajaxSuccess('删除成功');
            }
        }
    }
    /**
     * [actionGetCategoryInfo 获取栏目信息]
     * @Author:xiaoming
     * @DateTime        2017-12-15T21:55:48+0800
     * @return          [type]                   [description]
     */
    public function actionGetCategoryInfo($catId = ''){
        if($catId == ''){
           return $this->ajaxFail('栏目信息获取失败');
        }
        $rs = (new \yii\db\Query())
        ->select('
            c.catid,c.type,c.modelid,
            parentid,catname,image,url,ismenu,
            c.setting')
        ->from(Category::tableName().'AS c')
        ->where(['c.catid'=>$catId])
        ->one();
        $rs['setting'] = unserialize($rs['setting']);
        return $this->ajaxSuccess('获取成功','',$rs);
    }





}
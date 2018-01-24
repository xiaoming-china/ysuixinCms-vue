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
use common\lib\ValidateForm;
use common\models\Field;
use common\models\Model;
use common\models\Page;
use common\lib\Mar;
use yii\db\Command;
use yii\helpers\Url;

class ContentController extends AdminBaseController{
    const NOW_PUBLISH    = 1;//立即发布
    const TIMING_PUBLISH = 2;//定时发布
    const DRAFTS         = 3;//草稿箱
    const AUDITOR        = 4;//等待审核
    /**
     * [actionIndex 内容列表首页]
     * @author:xiaoming
     * @date:2018-01-09T17:49:13+0800
     * @return                        [type] [description]
     */
    public function actionIndex(){
        if($this->isPost()){
            $allcategory   = (new Category())->getAllCategory();
            $category_list = (new Category())->manyArray($allcategory);
            return $this->ajaxSuccess('获取成功','',$category_list);
        }else{
            return $this->render('/content/index');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-15
     * @name:description 栏目内容列表,如果栏目id为空，则查询全部的内容列表
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
        $r = Yii::$app->request;
        try {
            if($this->isPost()){
                $transaction = Yii::$app->db->beginTransaction();
                $data = json_decode($r->post('data'),true);
                $category_id = $data['category_id'];
                $modelid     = $data['modelId'];
                if($modelid == ''){
                    return $this->ajaxFail('参数异常');
                }
                if(empty($category_id)){
                    return $this->ajaxFail('请选择发布栏目');
                }
                $model_field = (new Field())->getModelField($modelid);
                //验证数据库字段的合法性
                $data['category_id'] = $category_id;
                unset($data['modelId'],$data['catId']);
                $content_data = (new ValidateForm())->content_data($model_field,$data);
                $validate = (new ValidateForm())->ValidateForm($model_field,$content_data);
                if($validate){
                    //多栏目发布
                    $fail = 0;
                    $update_data = [];
                    foreach ($category_id as $k => $v){
                        $content_data['category_id'] = $v;
                        $rs = (new sqlQuery())->assembleSql($content_data,$modelid);
                        if(!$rs){
                            $fail++;
                            break;
                        }
                    }
                    if($fail > 0){
                      $transaction->rollBack();
                      return $this->ajaxFail('发布失败，未知错误');
                    }
                    $transaction->commit();
                    return $this->ajaxSuccess('发布成功',Url::to(['/content/list','catid'=>$category_id,'modelid'=>$modelid]));
                }
            }else{
                $catId = $r->get('catid','');
                if($catId == ''){
                    $this->error('栏目ID不能为空');
                }
                $categoryInfo = (new Category())->getCategoryInfo($catId);
                if(!$catId == ''){
                    $this->error('栏目信息查找失败');
                }
                if($categoryInfo['type'] == Category::STSTEM_CATEGORY){
                    return $this->render('/content/add-content');
                }else{
                    return $this->render('/content/add-page');
                } 
            }
        }catch (Exception $e) {
            return $this->ajaxFail('代码异常');
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
    public function actionEditContent(){
        $this->layout = false;
        $r = Yii::$app->request;
        try {
            if($this->isPost()){
                $transaction = Yii::$app->db->beginTransaction();
                $data = json_decode($r->post('data'),true);
                $id = $data['id'];
                $modelid = $data['modelId'];
                $catid   = $data['catId'];
                if($modelid == ''){
                    return $this->ajaxFail('参数异常');
                }
                $model_field = (new Field())->getModelField($modelid);
                //验证数据库字段的合法性
                unset($data['modelId'],$data['catId']);
                $content_data = (new ValidateForm())->content_data($model_field,$data);
                $validate     = (new ValidateForm())->ValidateForm($model_field,$content_data);
                if($validate){
                    $rs = (new sqlQuery())->updateAssembleSql($content_data,$modelid,$id);
                    if(!$rs){
                      $transaction->rollBack();
                      return $this->ajaxFail('编辑失败，未知错误');
                    }
                    $transaction->commit();
                    return $this->ajaxSuccess('编辑成功',Url::to(['/content/list','catid'=>$catid,'modelid'=>$modelid]));
                }
            }else{
              return $this->render('/content/edit-content');
            }
        }catch (Exception $e) {
            return $this->ajaxFail('代码异常');
        }
    }
    /**
     * [actionAddPage 添加单页内容]
     * @author:xiaoming
     * @date:2018-01-02T10:27:33+0800
     * @return                        [type] [description]
     */
    public function actionAddPage(){
        try {
            if($this->isPost()){
                $r = Yii::$app->request;
                $d['category_id'] = $r->post('catId');
                $d['model_id']    = $r->post('modelId');
                $d['title']       = $r->post('title');
                $d['content']     = $r->post('content');
                $d['created_at']  = time();
                $d['updated_at']  = time();
                $d['create_by']   = Yii::$app->user->identity->username;
                $model = new Page();
                $info = (new Page())->findOne(['category_id'=>$r->post('catId')]);
                if(is_null($info)){
                    $model = new Page();
                }else{
                    $model = $info;
                }
                if($model->load($d,'') && $model->validate()){
                    if($model->save()){
                      return $this->ajaxSuccess('发布成功',Url::to(['/content/list','catid'=>$d['category_id'],'modelid'=>$d['model_id']]));
                    }
                    return $this->ajaxFail('添加失败.未知错误.');
                }else{
                    return $this->ajaxFail('添加失败.'.current($model->getErrors())[0]);
                }

            }
        }catch (Exception $e) {
            return $this->ajaxFail('代码异常');
        }
    }
    /**
     * [actionGetContentField 编辑内容时格式的组装，不能用新增时的格式]
     * @author:xiaoming
     * @date:2018-01-03T14:25:59+0800
     * @return                        [type] [description]
     */
    public function actionGetContentField(){
        $modelId = Yii::$app->request->get('modelid','');
        $catId   = $this->get('catId','');
        $id      = $this->get('id','');
        if($catId == '' || $modelId == '' || $id ==''){
             return $this->ajaxFail('数据获取失败,参数异常');
        }
        $ModelInfo = (new Model())->getModelInfo($modelId);
        if(!$ModelInfo){
            return $this->ajaxFail('模型数据获取失败');
        }
        //获取当前栏目所属模型的所有字段
        $model_data  = (new Field())->getModelField($modelId);
        $model_field = (new Field())->EchoModelField($model_data);//组装好的模型全部字段
        $rs = (new sqlQuery())->selectContentData($ModelInfo->e_name,$id,$model_data);//当前数据的字段
        $d = [];
        foreach ($model_field as $k => $v) {
            foreach ($rs as $kk => $vv) {
                $t['value']  = $vv;
                if($v['e_name'] === $kk){
                    $t = $v;
                    if(is_array($v['value'])){
                        array_push($t['value'] ,$vv);
                    }else{
                        $t['value']  = $vv;
                    }
                    $d[] = $t;
                }
            }
        }
        $r['model_field']['list'] = $d;
        $r['model_field']['info']['status']        = $rs['status'];
        $r['model_field']['info']['publish_time']  = $rs['publish_time'];
        $r['model_field']['info']['allow_comment'] = $rs['allow_comment'];
        $r['model_field']['info']['show_template'] = $rs['show_template'];
        return $this->ajaxSuccess('获取成功','',$r);
    }
    /**
     * [actiongetPageContent 获取单页数据内容]
     * @author:xiaoming
     * @date:2018-01-02T14:16:15+0800
     * @return                        [type] [description]
     */
    public function actionGetPageContent(){
        $catId   = $this->get('catId','');
        if($catId == ''){
            return $this->ajaxFail('数据获取失败,参数异常');
        }
        $categoryInfo = (new Category())->getCategoryInfo($catId);
        if(!$categoryInfo){
            return $this->ajaxFail('栏目信息查找失败');
        }
        $rs = (new Page())->getPageInfo($catId);
        return $this->ajaxSuccess('获取成功','',$rs);
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
        $model_data = (new Field())->getModelField($modelid);
        $model_field = (new Field())->EchoModelField($model_data);
        if(!$model_field){
            return $this->ajaxFail('未找到模型字段,可能是模型的字段全部被禁用或者被删除');
        }
        //生成前端Form验证
        // $field_validate = (new ValidateForm())->EchoValidateJs($model_data);

        //获取当前栏目所属模型的所有栏目
        $category_list = (new Category())->getCategoryList($modelid,false);
        $all_category = (new Category())->manyArray($category_list, 0);
        $d['model_field']    = $model_field;
        $d['all_category']   = $all_category;
        // $d['field_validate'] = $field_validate;
        return $this->ajaxSuccess('获取成功','',$d);
    }
    /**
     * [actionDelContent 删除内容]
     * @author:xiaoming
     * @date:2018-01-03T17:13:10+0800
     * @return                        [type] [description]
     */
    public function actionDelContent(){
        try {
            if($this->isPost()){
                $transaction = Yii::$app->db->beginTransaction();
                $modelId = $this->post('modelid','');
                $id      = $this->post('id',[]);
                if($modelId == '' || empty($id)){
                    return $this->ajaxFail('数据查找失败,参数异常');
                }
                $ModelInfo = (new Model())->getModelInfo($modelId);
                if(!$ModelInfo){
                    return $this->ajaxFail('模型数据查找失败');
                }
                $rs = (new sqlQuery())->delContent($ModelInfo->e_name,implode(',', $id));//当前数据的字段
                if(!$rs){
                    $transaction->rollBack();
                    return $this->ajaxFail('删除失败，未知错误');
                }
                $transaction->commit();
                return $this->ajaxSuccess('删除成功');
            }
        }catch (Exception $e) {
            return $this->ajaxFail('代码异常');
        }
    }



}
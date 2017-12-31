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
use yii\db\Command;
use yii\helpers\Url;

class ContentController extends AdminBaseController{
    public $layout = false;
    /**
     * @Author:          xiaominggit
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
        try {
            if($this->isPost()){
                $transaction = Yii::$app->db->beginTransaction();
                $r = Yii::$app->request;
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
                return $this->render('/content/add-content');
            }
        }catch (Exception $e) {
            return $this->ajaxFail('代码异常');
        }
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
        //生成前端Form验证
        // $field_validate = (new ValidateForm())->EchoValidateJs($model_data);

        //获取当前栏目所属模型的所有栏目
        $category_list = (new Category())->getCategoryList($modelid);
        if(!$model_field || !$category_list){
            return $this->ajaxFail('未找到相关模型信息');
        }
        $all_category = (new Category())->manyArray($category_list, 0);
        $d['model_field']    = $model_field;
        $d['all_category']   = $all_category;
        // $d['field_validate'] = $field_validate;
        return $this->ajaxSuccess('获取成功','',$d);
    }



}
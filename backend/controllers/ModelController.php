<?php
/**
 * 模型控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Model;
use common\models\ModelField;
use common\lib\Page;
use common\lib\Table;
use yii\db\Connection;
use yii\helpers\Url;


class ModelController extends AdminBaseController{

    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:模型列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionModelList(){
        if($this->isAjax()){
            $page     = $this->get('page', 0);
            $pageSize = $this->get('pageSize', $this->getParams('default_page_size'));
            $offset   = ($page - 1) * $pageSize;

            $sql        = (new Model())->find();
            $sql->andFilterWhere(['or',
                ['like','name',$this->get('keyworlds')],
                ['like','desc',$this->get('keyworlds')],
                ['like','e_name',$this->get('keyworlds')]
            ]);
            if($this->get('status') != '-1'){
                $sql->andFilterWhere(['=','status',$this->get('status')]);
            }

            $d['count'] = $sql->count();
            $d['list'] =  $sql->orderBy('created_at DESC')
                              ->limit($pageSize)
                              ->offset($offset)
                              ->asArray()
                              ->all();

            return $this->ajaxSuccess('获取成功','',$d);
        }else{
            return $this->render('/model/model-list');
        }
    }
    /**
     * [actionGetModelList 根据模型ID获取栏目列表]
     * @author:xiaoming
     * @date:2017-12-15T15:21:36+0800
     * @return                        [type] [description]
     */
    public function actionGetModelList(){
        $sql = (new Model())->find();
        $sql->andFilterWhere(['or',
            ['like','name',$this->get('keyworlds')],
            ['like','desc',$this->get('keyworlds')],
            ['like','e_name',$this->get('keyworlds')]
        ]);
        if($this->get('status') != '-1'){
            $sql->andFilterWhere(['=','status',$this->get('status')]);
        }
        $d =  $sql->orderBy('created_at DESC')->asArray()->all();

        return $this->ajaxSuccess('获取成功','',$d);
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 添加模型
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionAddModel(){
        $d = [
          'name'   => $this->post('name',''),
          'e_name' => $this->post('e_name',''),
          'desc'   => $this->post('desc',''),
          'status' => $this->post('status',1),
        ];
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model = new Model();
            $table = new Table();
            $model->setScenario('add_model');
            //检测模型表是否已存在
            $tabe_name = $d['e_name'];
            $checkTable = $table->checkTable($tabe_name);
            if($checkTable){
              return $this->ajaxFail('添加失败,'.$tabe_name.'数据表已存在,请更换别名');
            }
            if($model->load($d,'') && $model->validate()){
                if(!$model->save()){
                    $transaction->rollBack();
                    return $this->ajaxFail('添加失败,未知错误');
                }
                //创建表
                $creat_table = $table->addTable($tabe_name,Table::BASIC_TABLE);
                if(!$creat_table){
                    $transaction->rollBack();
                    return $this->ajaxFail($tabe_name.'表创建失败');
                }
                //添加基本数据
                $insert_field = $table->addBasicField($model->id);
                if(!$insert_field){
                    $table->dropTable($tabe_name);
                    $transaction->rollBack();
                    return $this->ajaxFail($tabe_name.'基本数据插入失败');
                }
                $transaction->commit();
                return $this->ajaxSuccess('添加成功');
            }else{
                return $this->ajaxFail('添加失败.'.current($model->getErrors())[0]);
            }
        }catch (Exception $e) {
           $transaction->rollBack();
           return $this->ajaxFail('添加失败,代码异常');
        }
    }
        /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 编辑模型
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionEditModel(){
        $id = $this->post('modelId','');
        if($id == ''){
          return $this->ajaxFail('参数异常,modelID不能为空');
        }
        $table = new Table(); 
        $model = (new Model())->findOne($id);
        if(is_null($model)){
            return $this->ajaxFail('数据异常,未找到相关数据');
        }
        $model->setScenario('edit_model');
        $d = [
          'name'   => $this->post('name',''),
          'e_name' => $this->post('e_name',''),
          'desc'   => $this->post('desc',''),
          'status' => $this->post('status',1),
        ];
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $old_tabe_name = $model->e_name;//旧表名
            $new_tabe_name = $d['e_name'];//新表名
            if($model->load($d,'') && $model->validate()){
                $re_table_name = $re_table_name1 = true;
                //当旧表名和新表名不相等的时候才修改
                if($old_tabe_name != $new_tabe_name){
                    $checkTable = $table->checkTable($new_tabe_name);
                    if($checkTable){
                      return $this->ajaxFail('编辑失败,'.$new_tabe_name.'数据表已存在,请更换别名');
                    }
                     //修改主表和副表表名
                    $re_table_name  = $table->tableRename($old_tabe_name,$new_tabe_name);
                    $re_table_name1 = $table->tableRename($old_tabe_name.Table::TABLE_DATA_PREFIX,$new_tabe_name.Table::TABLE_DATA_PREFIX);
                }
               
                $rs = $model->save();//保存model数据
                if($rs && $re_table_name && $re_table_name1){
                    $transaction->commit();
                    return $this->ajaxSuccess('编辑成功');
                }
                $transaction->rollBack();
                return $this->ajaxFail('编辑失败,未知错误');
            }else{
                return $this->ajaxFail('编辑失败.'.current($model->getErrors())[0]);
            }
        }catch (Exception $e) {
           $transaction->rollBack();
           return $this->ajaxFail('编辑失败,代码异常');
        }

    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 更改模型状态
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionChangeModelStatus(){
        if($this->isPost()){
            $d['id']     = $this->post('id','');
            $d['status'] = $this->post('status','');

            $model = (new Model())->findOne($d['id']);
            if(is_null($model)){
                return $this->ajaxFail('未找到相关数据');
            }
            $model->setScenario('change_status');
            if($model->load($d,'') && $model->validate()){
                $model->status     = $d['status'];
                $model->updated_at = time();
                if($model->save()){
                   return $this->ajaxSuccess('操作成功');
                }else{
                    return $this->ajaxFail('操作失败,未知错误');
                }
            }else{
                return $this->ajaxFail('操作失败.'.current($model->getErrors())[0]);
            }
        }
    }
        /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 删除模型
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionDelModel(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if($this->isPost()){
                $id        = $this->post('id','');
                if($id == ''){
                    return $this->ajaxFail('参数异常,modelID不能为空');
                }
                $model = (new Model())->findOne($id);
                if(is_null($model)){
                    return $this->ajaxFail('未找到相关数据');
                }
                $rs = $model->delete();//删除模型
                $del_table  = (new table())->dropTable($model->e_name);//删除主表
                if($rs && $del_table){
                    $transaction->commit();
                    return $this->ajaxSuccess('删除成功');
                }
                $transaction->rollBack();
                return $this->ajaxFail('删除失败,未知错误');
            }
        }catch (Exception $e) {
           $transaction->rollBack();
           return $this->ajaxFail('删除失败,未知错误');
        }
    }
}
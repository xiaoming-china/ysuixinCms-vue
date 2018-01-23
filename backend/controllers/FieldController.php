<?php
/**
 * 站点配置控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Field;
use common\models\Model;
use yii\helpers\Url;
use common\lib\File;
use common\lib\Table;
use yii\web\ServerErrorHttpException;


class FieldController extends AdminBaseController{
    public $fieldConfigPath;
    public function init() {
        parent::init();
        $this->fieldConfigPath = dirname(__DIR__).'/field/';
    }

    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:字段列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionFieldList(){
        if($this->isAjax()){
            $model_id = $this->get('modelId','');
            if($model_id == ''){
                return $this->ajaxFail('模型ID不能为空');
            }
            $sql  = (new Field())->find()->where(['model_id'=>$model_id]);
            $sql->andWhere(['=','is_hide',Field::NO_HIDE]);
            $sql->andFilterWhere(['or',
                ['like','name',$this->get('keyworlds')],
                ['like','e_name',$this->get('keyworlds')],
                ['like','name_desc',$this->get('keyworlds')],
            ]);
            if($this->get('status') != '-1'){
                $sql->andFilterWhere(['=','status',$this->get('status')]);
            }
            $d['list'] =  $sql->orderBy('is_style ASC,sort ASC,created_at DESC')
                              ->asArray()
                              ->all();
            return $this->ajaxSuccess('获取成功','',$d);
        }else{
           return $this->render('/model/field-list');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:添加字段
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionAddField(){
        try {
            $transaction = Yii::$app->db->beginTransaction();
            if($this->isPost()){
                $model = new Field();
                $table = new Table();
                $model->setScenario('add_filed');
                $modelId      = $this->post('modelId','');
                $fieldInfo    = $this->post('fieldInfo',[]);
                $configParams = $this->post('configParams',[]);
                if($modelId == '' || empty($fieldInfo) || empty($configParams)){
                    return $this->ajaxFail('参数异常');
                }
                $modelInfo    = (new Model())->findOne($modelId);
                if(is_null($modelInfo)){
                    return $this->ajaxFail('未找到相关模型数据');
                }
                if($table::checkColumn($modelInfo->e_name,$fieldInfo['e_name'])){
                    return $this->ajaxFail('该列已存在,请更换别名');
                }
                $d = [
                    'model_id'      =>$modelId,
                    'name'          =>$fieldInfo['name'],
                    'e_name'        =>$fieldInfo['e_name'],
                    'name_desc'     =>$fieldInfo['name_desc'],
                    'type'          =>$fieldInfo['type'],
                    'not_null'      =>$fieldInfo['not_null'],
                    'not_null_info' =>$fieldInfo['not_null_info'],
                    'error_info'    =>$fieldInfo['error_info'],
                    'is_hide'       =>$fieldInfo['is_hide'],
                    'regular'       =>$fieldInfo['regular'],
                    'sort'          =>6,
                    'seetings'      =>serialize($configParams),
                ];
                if($model->load($d,'') && $model->validate()){
                    $addColumn = $table->columnAdd($modelInfo->e_name, $fieldInfo['e_name'], $fieldInfo['type']);
                    if($model->save() && $addColumn){
                        $transaction->commit();
                       return $this->ajaxSuccess('添加成功',Url::to(['/field/field-list','modelId'=>$modelId]));
                    }else{
                        $transaction->rollBack();
                        return $this->ajaxFail('添加失败,未知错误');
                    }
                }else{
                    $transaction->rollBack();
                    return $this->ajaxFail('添加失败.'.current($model->getErrors())[0]);
                }
            }else{
                return $this->render('/model/add-field');
            }
        }catch (Exception $e) {
           $transaction->rollBack();
           return $this->error($e->getMessage());
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-12-11
     * @name:description 编辑字段
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
    */
    public function actionEditField(){
        try {
            $transaction = Yii::$app->db->beginTransaction();
            if($this->isPost()){
                $modelId      = $this->post('modelId','');
                $fieldId      = $this->post('fieldId','');
                $fieldInfo    = $this->post('fieldInfo',[]);
                $configParams = $this->post('configParams',[]);
                if($modelId == '' || $fieldId =='' || empty($fieldInfo) || empty($configParams)){
                    return $this->ajaxFail('参数异常');
                }
                $modelInfo = (new Model())->findOne($modelId);
                if(is_null($modelInfo)){
                    return $this->ajaxFail('未找到相关模型数据');
                }
                $model = (new Field())->findOne($fieldId);
                if(is_null($model)){
                    return $this->ajaxFail('未找到相关字段数据');
                }
                $model->setScenario('edit_filed');
                $d = [
                    'model_id'      =>$modelId,
                    'name'          =>$fieldInfo['name'],
                    'e_name'        =>$fieldInfo['e_name'],
                    'name_desc'     =>$fieldInfo['name_desc'],
                    'type'          =>$fieldInfo['type'],
                    'not_null'      =>$fieldInfo['not_null'],
                    'not_null_info' =>$fieldInfo['not_null_info'],
                    'error_info'    =>$fieldInfo['error_info'],
                    'is_hide'       =>$fieldInfo['is_hide'],
                    'regular'       =>$fieldInfo['regular'],
                    'seetings'      =>serialize($configParams),
                ];
                $old_column_name = $model->e_name;
                if($model->load($d,'') && $model->validate()){
                    if($old_column_name != $fieldInfo['e_name']){
                        $renameColumn = (new Table())->reColumnName($modelInfo->e_name, $old_column_name, $fieldInfo['e_name'],$fieldInfo['type']);
                    }else{
                        $renameColumn = true;
                    }
                    if($model->save() && $renameColumn){
                        $transaction->commit();
                       return $this->ajaxSuccess('编辑成功',Url::to(['/field/field-list','modelId'=>$modelId]));
                    }else{
                        $transaction->rollBack();
                        return $this->ajaxFail('编辑失败,未知错误');
                    }
                }else{
                    $transaction->rollBack();
                    return $this->ajaxFail('编辑失败.'.current($model->getErrors())[0]);
                }
            }else{
                return $this->render('/model/edit-field');
            }
        }catch (Exception $e) {
           $transaction->rollBack();
           return $this->error($e->getMessage());
        }
    }
    /**
     * [actiomGetFieldInfo 获取字段信息]
     * @author:xiaoming
     * @date:2017-12-11T10:32:04+0800
     * @return                        [type] [description]
     */
    public function actionGetFieldInfo(){
        $fieldId = $this->get('fieldId','');
        if($fieldId == ''){
           return $this->error('参数异常,字段ID不能为空');
        }
        $fieldInfo = (new Field())->find()->where(['id'=>$fieldId])->asArray()->one();
        if(empty($fieldInfo)){
            return $this->ajaxFail('未找到相关字段数据');
        }
        $fieldInfo['seetings'] = unserialize($fieldInfo['seetings']);
        return $this->ajaxSuccess('获取成功','',$fieldInfo);
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 更改字段状态
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionChangeFieldStatus(){
        try {
            $transaction = Yii::$app->db->beginTransaction();
            if($this->isPost()) {
                $id = $this->post('id', '');
                if(empty($id)){
                  return $this->ajaxFail('参数异常,请选择字段');
                }
                $status = $this->post('status', '');
                $model = (new Field())->find()->where(['id' => $id])->all();
                $fail = 0;
                foreach ($model as $m) {
                    if ($m->is_style != Field::IS_STYLE) {
                        $m->status = $status;
                        $rs = $m->update(false);
                        if (!$rs) {
                            $fail++;
                        }
                    }
                }
                if ($fail > 0) {
                    $transaction->rollBack();
                    return $this->ajaxFail('操作失败,未知错误');
                }
                $transaction->commit();
                return $this->ajaxSuccess('操作成功');
            }
        }catch (Exception $e) {
            $transaction->rollBack();
            return $this->error($e->getMessage());
        }
    }
        /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 删除字段
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionDelField(){
        try {
            $transaction = Yii::$app->db->beginTransaction();
            if($this->isPost()) {
                $id = $this->post('id', '');
                if(empty($id)){
                  return $this->ajaxFail('参数异常,请选择字段');
                }
                $model = (new Field())->find()->where(['id' => $id])->all();
                $fail = 0;
                foreach ($model as $m) {
                    if ($m->is_style != Field::IS_STYLE) {
                        $rs = $m->delete();
                        if (!$rs) {
                            $fail++;
                        }
                    }
                }
                if ($fail > 0) {
                    $transaction->rollBack();
                    return $this->ajaxFail('操作失败,未知错误');
                }
                $transaction->commit();
                return $this->ajaxSuccess('操作成功');
            }
        }catch (Exception $e) {
            $transaction->rollBack();
            return $this->error($e->getMessage());
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-08
     * @name:description 字段排序
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionFieldSort(){
        try {
            $transaction = Yii::$app->db->beginTransaction();
            if($this->isPost()) {
                $data = $this->post('data',[]);
                $fail = 0;
                foreach ($data as $k => $v){
                    $model = (new Field())->findOne($v['id']);
                    if(!is_null($model)){
                        $model->sort = $v['sort'];
                        $rs = $model->save(false);
                         if (!$rs) {
                            $fail++;
                        }
                    }
                }
                if ($fail > 0) {
                    $transaction->rollBack();
                    return $this->ajaxFail('操作失败,未知错误');
                }
                $transaction->commit();
                return $this->ajaxSuccess('操作成功');
            }
        }catch (Exception $e) {
            $transaction->rollBack();
            return $this->error($e->getMessage());
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-29
     * @name:description 获取添加字段配置信息
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionGetFieldConfig(){
        $type = $this->get('type','');
        if($type == ''){
          return $this->ajaxFail('找不到此类型的配置');
        }
        $config_path = $this->fieldConfigPath.$type.'/config.php';
        $html_path   = $this->fieldConfigPath.$type.'/html.php';

        if(!is_file($config_path) || !is_file($html_path)){
          return $this->ajaxFail('找不到此类型的配置');
        }
        ob_start();
        include $config_path;
        include $html_path;
        $data_setting = ob_get_contents();
        ob_end_clean();
        $d['config_params'] = $seeting;
        $d['config_html'] = $data_setting;
        return $this->ajaxSuccess('获取成功','',$d);
    }



}
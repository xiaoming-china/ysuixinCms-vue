<?php
namespace frontend\controllers;
use common\models\Upload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii;
class TestController extends Controller{

    public function init(){
        $this->enableCsrfValidation = false;
    }

    public function actions(){
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }
    /**
     * [actionUpload 文件上传]
     * @Author:xiaoming
     * @DateTime        2017-04-19T13:43:16+0800
     * @return          [type]                   [description]
     */
    public function actionTestUpload (){
        $this->layout = false;
        return $this->render('/site/test-upload');
   }
}
?>
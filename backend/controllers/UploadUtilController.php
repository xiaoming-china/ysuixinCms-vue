<?php
/**
 * Created by PhpStorm.
 * User: hacklog
 * Date: 5/19/17
 * Time: 3:58 PM
 */

namespace backend\controllers;

use backend\controllers\AdminBaseController;

class UploadUtilController extends AdminBaseController{
    public function actions(){
        return [
            'upload' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'deleteRoute' => 'upload-delete',
                'disableCsrf' => true,
                'allowChangeFilestorage' => true,
            ],
            'upload-delete' => [
                'class' => 'trntv\filekit\actions\DeleteAction',
                'disableCsrf' => true,
            ],
            'upload-imperavi' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'fileparam' => 'file',
                'responseUrlParam'=> 'filelink',
                'multiple' => false,
                'disableCsrf' => true,
            ]
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'upload') {
            $fileStorageParam = \Yii::$app->request->get($action->fileStorageParam);
            if (empty($fileStorageParam)) {
                $_GET[$action->fileStorageParam] = 'fileStorage';
                return parent::beforeAction($action);
            }
            //@TODO 增加过滤判断 防止调用不存在的storage报错
            // if(!in_array($fileStorageParam, ['xxxx', 'oooo','ddddd'])) {
            //     return false;
            // }
        }
        return parent::beforeAction($action);
    }
}
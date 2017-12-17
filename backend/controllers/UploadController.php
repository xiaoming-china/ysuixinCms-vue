<?php
namespace backend\controllers;
use common\models\Upload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii;
class UploadController extends Controller{
    public function init(){
        $this->enableCsrfValidation = false;
    }
    /**
     * [actionUpload 文件上传]
     * @Author:xiaoming
     * @DateTime        2017-04-19T13:43:16+0800
     * @return          [type]                   [description]
     */
    public function actionUpload (){
        $model = new Upload();
        $parameter = Yii::$app->request->get('parameter'); //配置参数
        if (Yii::$app->request->isPost) {
            $model->upload_type = 'img';
            //echo $model->max_size;exit;
            // $model->load(,'');
            $model->file = UploadedFile::getInstanceByName('imgFile');
            //检测上传类型
            // if(!$model->checkType($model->file->extension)){
            //     self::failUpload(1,'上传后缀不允许,只允许'.$parameter['ext']);
            // }
            // //检测上传大小
            // if(!$model->checkSize($model->file->size)){
            //     self::failUpload(1,'只允许大小为'.$parameter['max_size'].'的文件');
            // }
            //上传文件保存目录
            $save_path = '../uploads/'.date('Ymd');
            if(!$model->createDir($save_path)){
                self::failUpload(1,$parameter['save_path'].'目录创建失败');
            }

            $fileName = $model->file->baseName . "." . $model->file->extension;
            $dir = $save_path."/". $fileName;
            //print_r(Yii::$app->request->hostInfo.'/'.$dir);exit;
            if($model->file->saveAs($dir)){
                $d['error'] = 0;
                $d['url']   = Yii::$app->request->hostInfo.'/'.$dir;
            }else{
                $d['error']   = 1;
                $d['message'] = $model->file->getHasError();
            }
            echo json_encode($d);
        }
   }
   /**
    * [failUpload 上传返回错误数据]
    * @Author:xiaoming
    * @DateTime        2017-04-19T14:11:44+0800
    * @return          [type]                   [description]
    */
   private static function failUpload($error = 1,$message=""){
        $d['error'] = $error;
        $d['message'] = $message;
        echo json_encode($d);
        exit;
   }
    /**
    * [failUpload 上传成功错误数据]
    * @Author:xiaoming
    * @DateTime        2017-04-19T14:11:44+0800
    * @return          [type]                   [description]
    */
   private static function successUpload($error = 0,$url=""){
        $d['error'] = $error;
        $d['url']   = $url;
        echo json_encode($d);
        exit;
   }
   /**
    * [actionDelPic 删除图片]
    * @Author:xiaoming
    * @DateTime        2017-04-19T16:09:07+0800
    * @return          [type]                   [description]
    */
   public function actionDelPic(){
        $imgUrl = getcwd().'/'.Yii::$app->request->post('imgUrl');
        if(unlink($imgUrl)){
           self::successUpload();
        }else{
            self::failUpload(1,'删除失败');
        }
   }
}
?>
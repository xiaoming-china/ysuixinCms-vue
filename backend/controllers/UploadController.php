<?php
namespace backend\controllers;
use common\lib\Upload;
use common\lib\Image;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii;
use backend\controllers\AdminBaseController;
class UploadController extends AdminBaseController{
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
        $upload = new Upload();
        $upload->maxSize = 1024*1024;
        $upload->exts = ['jpg','jpeg','png','gif'];
        $files = $_FILES['File'];

        if($info = $upload->uploadOne($_FILES['File'])){
            $rs['name']      = $info['savename'];
            $rs['base_url']  = Yii::$app->request->getHostInfo();
            $rs['path']      = $upload->rootPath.$info['savepath'];
            // $img = new Image();
            // $path = $upload->rootPath.$info['savepath'];
            // //缩略图
            // $img->open($path.$info['savename']);
            // $img->thumb($img->width()/2, $img->height()/2);

            
            // !$img->save($path.'thumb_'.$info['savename']) && return_msg('缩略图生成失败!');

            // if($config['is_watermark']==1){

            //     //水印图
            //     if(is_file(substr($config['watermark_image'],1))){
            //         $img->open($path.$info['savename']);
            //         $img->water(substr($config['watermark_image'],1),$config['watermark_position']);
            //         !$img->save($path.$info['savename']) && return_msg('添加水印失败!');
            //     }
            // }
            return $this->ajaxSuccess('上传成功','',$rs);
            
        }else{
            return $this->ajaxFail($upload->getError());
        }
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
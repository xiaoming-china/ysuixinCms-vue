<?php
/**
 * 评论管理控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\LoginLog;
use backend\models\SystemInfo;


class CommentController extends AdminBaseController{
    public $layout = false;
    public $uId;

    public function init(){
        parent::init();
        $this->uId = getUserInfo('id');
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:评论列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionCommentList(){
        return $this->render('/comment/comment-list');
    }




}
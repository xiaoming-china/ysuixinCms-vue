<?php
/**
 * 评论管理控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Comment;
use common\models\Category;


class CommentController extends AdminBaseController{
    public $layout = 'main-admin';
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
        if($this->isAjax()){
            $page     = $this->get('page', 0);
            $pageSize = $this->get('pageSize', $this->getParams('default_page_size'));
            $offset   = ($page - 1) * $pageSize;
            $sql = (new \yii\db\Query())
            ->select('c.*,cc.catname,cc.catid')
            ->from(Comment::tableName().'AS c')
            ->leftJoin(Category::tableName().' AS cc','cc.catid = c.category_id');
            $sql->andFilterWhere(['or',
                ['like','c.commen_user',$this->get('keyworlds')],
                ['like','c.comment_content',$this->get('keyworlds')],
                ['like','c.re_content',$this->get('keyworlds')]
            ]);
            $sql->andWhere(['parent_id'=>0]);
            $d['count'] = $sql->groupBy('content_id')->count();
            $d['list'] =  $sql->orderBy('comment_at DESC')
                              ->limit($pageSize)
                              ->offset($offset)
                              ->groupBy('content_id')
                              ->all();

            return $this->ajaxSuccess('获取成功','',$d);

        }else{
            return $this->render('/comment/comment-list');
        }
    }
    /**
     * [actionGetCommentDetail 获取每一篇内容的评论]
     * @author:xiaoming
     * @date:2018-01-08T19:25:13+0800
     * @return                        [type] [description]
     */
    public function actionGetCommentDetail($id = ''){
        if($id == ''){
            return $this->ajaxFail('评论获取失败，参数异常');
        }
        $rs = (new Comment())->find()->where(['content_id'=>$id])->all();
        $list = self::manyArray($rs);
        return $this->ajaxSuccess('获取成功','',$list);

    }
    public static function manyArray($cate,$pid = 0){
        $arr = [];
        foreach ($cate as $key => $value) {
            $v = [];
            if($value['parent_id'] == $pid){
                $v[]    = $value;
                $v['children'] = self::manyArray($cate,$value['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }




}
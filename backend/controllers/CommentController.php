<?php
/**
 * 评论管理控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Comment;
use common\models\Category;
use common\models\BaseModel;


class CommentController extends AdminBaseController{

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
            $page      = $this->get('page', 0);
            $pageSize  = $this->get('pageSize', $this->getParams('default_page_size'));
            $startTime = $this->get('start_time', '');
            $endTime   = $this->get('end_time', '');
            $offset    = ($page - 1) * $pageSize;
            $sql = (new \yii\db\Query())
            ->select('c.*,cc.catname,cc.catid')
            ->from(Comment::tableName().'AS c')
            ->leftJoin(Category::tableName().' AS cc','cc.catid = c.category_id');
            $sql->andFilterWhere(['or',
                ['like','c.comment_user',$this->get('keyworlds')],
                ['like','c.comment_content',$this->get('keyworlds')]
            ]);
            if($startTime != '' && $endTime != ''){
                $time = BaseModel::selectDate($startTime,$endTime);
                $sql->andWhere(['between', 'c.created_at', $time['start_time'], $time['end_time']]);
            }

            $sql->andWhere(['parent_id'=>0]);
            $d['count'] = $sql->groupBy('content_id')->count();
            $d['list'] =  $sql->orderBy('created_at DESC')
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
        $rs = (new Comment())->find()->where(['content_id'=>$id])->orderBy('created_at DESC')->asArray()->all();
        $list = self::manyArray($rs);
        return $this->ajaxSuccess('获取成功','',$list);
    }
    /**
     * [actionReComment 评论回复]
     * @author:xiaoming
     * @date:2018-01-09T16:01:23+0800
     * @return                        [type] [description]
     */
    public function actionReComment(){
        $id      = $this->post('id','');
        $re_user = $this->post('re_user','');           
        $content = $this->post('content','');
        if($id == '' || $re_user == ''|| $content == ''  ){
           return $this->ajaxFail('回复失败，参数异常');
        }  
        $model = (new Comment())->findOne($id);
        if(is_null($model)){
            return $this->ajaxFail('数据获取异常');
        }
        $newModel = new Comment();
        $newModel->category_id     = $model->category_id;
        $newModel->content_id      = $model->content_id;
        $newModel->content_title   = $model->content_title;
        $newModel->comment_user    = Yii::$app->user->identity->username;
        $newModel->re_user         = $re_user;
        $newModel->comment_content = $content;
        $newModel->created_at      = time();
        if($model->parent_id != ''){
            $newModel->parent_id   = $model->parent_id;
        }else{
            $newModel->parent_id   = $id;
        }
        $rs = $newModel->save(false);
        if($rs){
            return $this->ajaxSuccess('回复成功');
        }
        return $this->ajaxFail('回复失败，未知错误');
    }
    public static function manyArray($cate,$pid = 0){
        $arr = [];
        foreach ($cate as $key => $value) {
            $v = [];
            if($value['parent_id'] == $pid){
                $value['children'] = self::manyArray($cate,$value['id']);
                $arr[] = $value;
            }
        }
        return $arr;
    }




}
<?php
namespace Home\Controller;
use Think\Controller;

class BlogController extends Controller {
    public function _initialize(){
      $this->navModel     = D('HwmAdmin/Nav');
      $this->articleModel = D('HwmAdmin/Article');
      $this->commentModel = D('HwmAdmin/Comment');
    }
   //主页
   public function index(){
      $where['is_deleted'] = ['eq',0];
      $rs = navigation($this->navModel->NavList($where));
      $this->assign('data',$rs);
      $this->display();
   }
    /**
    * [detail 文章详情]
    * @return [type] [description]
    */
   public function detail(){

    $this->display();
   }
   /**
    * [articleList blog列表]
    * @Author:xiaoming
    * @DateTime        2017-03-21T19:34:47+0800
    * @return          [type]                   [description]
    */
   public function articleList(){
      $keyword     = I('GET.keyword');
      $category_id = I('GET.category_id');
      $p           = I('GET.p',1);
      $where['is_deleted'] = ['eq',0];
      $where['title']      = ['like','%'.$keyword.'%'];
      if($category_id != ''){
        $where['category_id'] = ['eq',$category_id];
      }
      //计算总页数
      $count = $this->articleModel->countArticle($where);
      $page = new \Think\Page($count,20);
      $showPage = $page->show();
      $rs['totalPages'] = $page->totalPages ? $page->totalPages:-1;
      //查询数据
      $field = 'id,title,desc,thumb,tags,add_time,view';
      $rs['list'] = $this->articleModel->ArticleList($where,$field,$p,20);
      foreach ($rs['list'] as $k => $v) {
        $rs['list'][$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
        $rs['list'][$k]['tags']     = explode(',', $v['tags']);
        $rs['list'][$k]['url']      = U('/Blog/detailed').'?id='.$v['id'];
      }
      success('数据获取成功','','success',$rs);
   }
   /**
    * [getDetail 获取文章详情]
    * @Author:xiaoming
    * @DateTime        2017-03-31T08:38:40+0800
    * @return          [type]                   [description]
    */
   public function getDetail(){
    $id = I('GET.id','',intval) OR fail('参数异常');
    $where['id'] = $id;
    $field = 'id,title,view,add_time,desc,content';
    $rs['detail'] = $this->articleModel->getDetailed($where,$field);
    $rs['detail']['add_time'] = date('Y-m-d H:i:s',$rs['detail']['add_time']);
    //获取文章评论
    $map['article_id'] = ['eq',$id];
    $rs['detail']['commentData'] = $this->commentModel->CommentList($map);
    // echo $this->articleModel->getlastsql();exit;
    success('数据获取成功','','success',$rs);
   }
   /**
    * [getComment 获取文章评论]
    * @Author:xiaoming
    * @DateTime        2017-03-31T08:46:51+0800
    * @return          [type]                   [description]
    */
   public function getComment(){
      $id       = I('GET.id','',intval) OR fail('参数异常');
      $page     = I('GET.page','1',intval);
      $pageSize = I('GET.pageSize','15',intval);
      $map['article_id'] = ['eq',$id];
      $rs['commentData'] = $this->commentModel->CommentList($map,'*',$page,$pageSize);
      // foreach ($rs['commentData'] as $k => $v) {
      //   $rs['commentData'][$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
      // }
      success('数据获取成功','','success',$rs);
   }
   /**
    * [addComment 添加文章评论]
    * @Author:xiaoming
    * @DateTime        2017-02-08T11:39:40+0800
    */
   public function addComment(){
      $d['article_id']      = I('POST.aId','','intval') OR fail('参数异常');
      // $d['user_name']       = I('POST.content');
      // $d['user_img']        = I('POST.content');
      $d['comment_content'] = replaceEmjoy(I('POST.content')) OR fail('内容不能为空');
      $d['add_time']        = time();
      $rs = M('comment')->add($d);
      $rs ? success('评论成功','','success',$d) : fail('评论失败，未知错误');
   }
   /**
    * [countView 增加文章点击数]
    * @Author:xiaoming
    * @DateTime        2017-02-11T17:57:48+0800
    * @return          [type]                   [description]
    */
   public function countView(){
      $aId = I('GET.aId','','intval');
      $map['id'] = $aId;
      $result      = D('HwmAdmin/Article')->where($map)->setInc('view');
      if(!$result){
        exit('数据错误');
      }
   }
   /**
    * [getNavList 获取文章分类]
    * @Author:xiaoming
    * @DateTime        2017-04-07T10:04:18+0800
    * @return          [type]                   [description]
    */
   public function getNavList(){
      $where['is_deleted'] = ['eq',0];
      $rs = $this->navModel->NavList($where);
      // p(navigation($rs));exit;
      success('数据获取成功','','success',navigation($rs));
   }



       


}
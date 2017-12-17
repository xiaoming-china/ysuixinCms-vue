<?php
/**
 * 发布控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Category;
use common\lib\Tree;
use common\lib\sqlQuery;

class PublishController extends AdminBaseController{
    public $layout = false;
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:后台主页
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionContentIndex(){
        //查询当前栏目的数据
        $catid = $this->get('catid','');
        $page  = $this->get('page',0);
        $where['start_time']  = $this->get('start_time','') == '' ? '' : strtotime($this->get('start_time',''));
        $where['end_time']    = $this->get('end_time','') == '' ? '' : strtotime($this->get('end_time',''));
        $where['keyworld']    = $this->get('keyworld','');
        $where['status']      = $this->get('status','');

        $category_model = (new Category())->getCategoryModel($catid);
        if(empty($category_model)){
         return $this->error('栏目模型数据获取失败');
        }
        $table_name = $category_model['table_name'];
        $data = (new sqlQuery())->selectData($table_name,$where,$page);

        $category_list = (new Category())->getAllCategory();
        $rs = self::manyArray($category_list);
        $d['name']     = '全部';
        $d['children'] = $rs;

        return $this->render('/content/content-list',[
            'category_list'=>json_encode($d),
            'data'=>$data
        ]);
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-15
     * @name:description 栏目内容列表,如果栏目id为空，则查询全部的内容列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionContentList(){
       $catid = $this->get('catid','');
       $page  = $this->get('page',0);
       if($catid == ''){
        return $this->error('栏目ID不能为空');
       }
       $category_model = (new Category())->getCategoryModel($catid);
       if(!$category_model){
        return $this->error('栏目模型数据获取失败');
       }
       $table_name = $category_model['table_name'];
       $data = (new sqlQuery())->selectData($table_name,$page);

       return $this->render('',['data'=>$data]);
       
    }
    //栏目组合多维数组
    static function manyArray($cate,$pid = 0){
        $arr = [];
        foreach ($cate as $key => $v) {
            if($v['parentid'] == $pid){
                $v['name'] = $v['catname'];
                $v['children'] = self::manyArray($cate,$v['catid']);
                $v['target']   = 'main';
                $arr[] = $v;

            }
        }
        return $arr;
    }
}
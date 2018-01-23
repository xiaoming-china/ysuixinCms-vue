<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
use common\models\Model;
use yii\db\Query;
use common\lib\Tree;

class Category extends BaseModel{

    const SHOW  = 1;//显示栏目
    const HIDE  = 2;//不显示栏目

    const DELETE_STATUS_TRUE  = 1;//已删除状态
    const DELETE_STATUS_FALSE = 2;//未删除状态

    const STSTEM_CATEGORY = 1;//内部栏目
    const PAGE_CATEGORY = 2;//单页面

    const IS_HAVE_CHILD = 1;//存在子栏目



    public static function tableName(){
        return '{{%category}}';
    }
    public function scenarios(){
        $s = parent::scenarios();
        $s['add_category']  = ['catname','modelid','parentid','image','url','ismenu','letter','type'];
        $s['edit_category'] = ['catname','catid','modelid','parentid','image','url','ismenu','letter','type'];
        return $s;
    }
    public function rules(){
        return [
            ['catid','required','on'=>['edit_category']],
            [['catname','modelid','letter'],'required','message'=>'{attribute}不能为空','on'=>['add_category','edit_category']],
            [['arrparentid'], 'string', 'max' => 255,'on'=>['add_category','edit_category']],
            [['catname'], 'string', 'max' => 10,'on'=>['add_category','edit_category']],
            [['catdir', 'letter'], 'string', 'max' => 30,'on'=>['add_category','edit_category']],
            [['image', 'parentdir', 'url'], 'string', 'max' => 100,'on'=>['add_category','edit_category']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'type' => 'Type',
            'modelid' => '所属模型',
            'domain' => 'Domain',
            'parentid' => '所属父级',
            'arrparentid' => '所有父级',
            'child' => '子级',
            'arrchildid' => '所有子级',
            'catname' => '栏目名称',
            'image' => '栏目图片',
            'parentdir' => '父级目录',
            'catdir' => '栏目目录',
            'url' => '栏目链接',
            'hits' => '点击数',
            'setting' => 'Setting',
            'listorder' => '排序',
            'ismenu' => '是否显示',
            'sethtml' => 'Sethtml',
            'letter' => '栏目拼音',
            'add_time' => 'Add Time',
            'update_time' => 'Update Time',
        ];
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-15
     * @name:description 插入数据之后更新url字段
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            [type]      $insert            [description]
     * @param            [type]      $changedAttributes [description]
     * @return           [type]                         [description]
     */
    public function afterSave($insert,$changedAttributes) {
        if($this->url == ''){
            $model = (new Category())->findOne($this->catid);
            $model->url = '/category/list?catId='.$this->catid.'&modelId='.$this->modelid;
            if($model->save(false)){
                return true;
            }
            return false;
        }
        return true;
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-15
     * @name:description 获取栏目的模型数据，如果catid为空，则查询第一张表，如果没有第一张表，则false
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function getCategoryModel($catid = ''){
         if($catid == ''){
           return false;
         }
         $rs = (new Query())
        ->select('m.name AS model_name,m.e_name AS table_name')
        ->from(Category::tableName().'AS c')
        ->leftJoin(Model::tableName().' AS m','m.id = c.modelid')
        ->where(['c.catid'=>$catid,'c.is_delete'=>Category::DELETE_STATUS_FALSE])
        ->one();
        if($rs === null){
           return false;
        }
        return $rs;
    }

    public function getCategoryInfo($catid = ''){
        if($catid == ''){
            return false;
        }
        $rs = (new Query())
        ->select('m.name AS model_name,m.e_name AS table_name,c.*')
        ->from(Category::tableName().'AS c')
        ->leftJoin(Model::tableName().' AS m','m.id = c.modelid')
        ->where(['c.catid'=>$catid,'c.is_delete'=>Category::DELETE_STATUS_FALSE])
        ->one();
        if($rs === null){
           return false;
        }
        return $rs;
    }
    public function getAllCategory(){
        return (new Category())->find()
        ->where(['is_delete'=>Category::DELETE_STATUS_FALSE])
        ->select('catid,modelid,catname,url,parentid,type,child')
        ->asArray()
        ->all();

    }
    /**
     * [actionGetCategoryList 根据模型ID获取栏目列表]
     * @author:xiaoming 
     * @date:2017-12-15T15:21:36+0800
     * is_page 是否查询单页
     * @return                        [type] [description]
     */
    public function getCategoryList($model_id = '',$is_page = true){
        if($model_id == ''){
          return false;
        }
        $model = new Category();
        $sql = $model->find()
        ->select('catid,parentid,catname,type,modelid,child,url')
        ->where(['modelid'=>$model_id,'is_delete'=>$model::DELETE_STATUS_FALSE]);
        if(!$is_page){
            $sql->andwhere(['type'=>1]);
        }
        $category_list = $sql->asArray()->all();
        return $category_list;
    }
    /**
     * [manyArray 树形tree]
     * @Author:xiaoming
     * @DateTime        2017-12-23T22:08:48+0800
     * @param           [type]                   $cate [description]
     * @param           integer                  $pid  [description]
     * @return          [type]                         [description]
     */
    public static function manyArray($cate,$pid = 0){
        $arr = [];
        foreach ($cate as $key => $value) {
            $v = [];
            if($value['parentid'] == $pid){
                $v['catid']    = $value['catid'];
                $v['type']     = $value['type'];
                $v['title']    = $value['catname'];
                $v['name']     = $value['catname'];
                $v['parentid'] = $value['parentid'];
                $v['nav_url']  = $value['url'];
                if($value['child'] == self::IS_HAVE_CHILD){
                    $v['url']  = '#';
                }else{
                    if($value['type'] == self::STSTEM_CATEGORY){
                        $v['url']  = '/admin/content/list?modelId='.$value['modelid'].'&catId='.$value['catid'];
                    }else{
                        $v['url']  = '/admin/content/add-content?modelid='.$value['modelid'].'&catid='.$value['catid'];
                    }
                }
                $v['target']   = '_self';
                $v['expand']   = true;
                $v['children'] = self::manyArray($cate,$value['catid']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
    /**
     * [navigation select形式tree]
     * @param  [type]  $data [description]
     * @param  integer $pid  [description]
     * @param  integer $lev  [description]
     * @return [type]        [description]
     */
    public static function HtmlManyArray($cate,$pid = 0,$lev = 0){
        $t = $str = '';
        if($lev != 0){
          for($i = 0;$i < $lev;$i++){
                $str = '<span style="margin-left:'.(($i*2)+2).'%;" class="icon-folder-open-alt">&nbsp;&nbsp└─&nbsp&nbsp;</span>';
           }
        }else{
          $str = '<span class="icon-folder-close-alt" style="text-align:left;">&nbsp; </span>';
        }
        $arr = [];
        foreach ($cate as $k => $v) {
          if($v['parentid'] == $pid){
            $v['html'] = $str;
            $arr[]     = $v;
            $arr = array_merge($arr,self::HtmlManyArray($cate,$v['catid'],$lev + 1));
          }
        }
        return $arr;
    }



}

<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
use common\models\Model;
use yii\db\Query;

class Category extends BaseModel{

    const SHOW  = 1;//显示栏目
    const HIDE  = 2;//不显示栏目

    const DELETE_STATUS_TRUE  = 1;//已删除状态
    const DELETE_STATUS_FALSE = 2;//未删除状态

    const STSTEM_CATEGORY = 1;//内部栏目
    const PAGE_CATEGORY = 2;//单页面



    public static function tableName(){
        return '{{%category}}';
    }
    public function scenarios(){
        $s = parent::scenarios();
        $s['add_category']  = ['catname','modelid','parentid','image','description','url','ismenu','letter','type'];
        $s['edit_category'] = ['catname','catid','modelid','parentid','image','description','url','ismenu','letter','type'];
        return $s;
    }
    public function rules(){
        return [
            ['catid','required','on'=>['edit_category']],
            [['catname','modelid','letter'],'required','message'=>'{attribute}不能为空','on'=>['add_category','edit_category']],
            [['arrparentid'], 'string', 'max' => 255,'on'=>['add_category','edit_category']],
            [['description'], 'string', 'max' => 50,'on'=>['add_category','edit_category']],
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
            'description' => '栏目描述',
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
            $model->url = 'content-index?a=list&catid='.$this->catid.'&modelid='.$this->modelid;
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
        ->select('catid,catname,url,parentid')
        ->asArray()
        ->all();

    }



}

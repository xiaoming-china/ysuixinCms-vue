<?php
/**
 * 菜单控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\Menu;
use common\lib\DataHandle;


class MenuController extends AdminBaseController{
    public $layout = false;
    public $uId;

    public function init(){
        parent::init();
        $this->uId = getUserInfo('id');
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-07
     * @name:菜单列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionMenuList(){
        $menu_list  = (new Menu())->find()->orderBy('sort ASC')->asArray()->all();
        $menu       = self::manyArray($menu_list);
        return $this->ajaxSuccess('获取成功','',$menu);
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-11-07
     * @name:description  菜单组合多维数组
     * @copyright:       [copyright]
     * @license:         [license]
     * @param            [type]      $cate [description]
     * @param            integer     $pid  [description]
     * @return           [type]            [description]
     */
    private static function manyArray($cate,$pid = 0,$level = 0){
        $arr = [];
        foreach ($cate as $key => $v) {
            if($v['parent_id'] == $pid){
                $v['child'] = self::manyArray($cate,$v['id'],$level++);
                $arr[] = $v;
            }
        }
        return $arr;
    }


}
<?php
/**
 * 站点配置控制器
 */
namespace backend\controllers;

use Yii;
use backend\controllers\AdminBaseController;
use common\models\LoginLog;
use backend\models\SystemInfo;
use common\models\Config;
use common\lib\File;




class ConfigController extends AdminBaseController{
    public $layout = 'main-admin';
    public $uId;

    public function init(){
        parent::init();
        $this->uId = getUserInfo('id');
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:模板列表
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionTemplateList(){
        if($this->isPost()){
            $data = [];
            //p(Template);
            $t = (new File())->getFiles(Template,true);
            p($t);
            return $this->ajaxSuccess('获取成功','',$data);
        }else{
            return $this->render('/template/template-list');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:基本参数设置
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionBasic(){
        return $this->render('/config/basic');
    }
     /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:附件配置
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionEnclosure(){
        return $this->render('/config/config-enclosure');
    }




}
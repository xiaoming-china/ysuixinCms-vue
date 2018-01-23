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
            $files = (new File())->getFiles(Template,true);
            if(!empty($files)){
                $t = [];
                foreach ($files as $key => $value) {
                    $d['name']   = $key;
                    if($key === Config::getOneConfig(Config::THEME_NAME)){
                        $d['used']   = 1;
                    }else{
                        $d['used']   = 0;
                    }
                    $d['icover'] = '/template/'.$key.'/'.$value[1];
                    $t[] = $d;
                }
                $template['list'] = $t;
            }else{
                $template['list'] = [];
            }
            return $this->ajaxSuccess('获取成功','',$template);
        }else{
            return $this->render('/template/template-list');
        }
    }
    /**
     * [actionChangeTemplate 更换模板]
     * @author:xiaoming
     * @date:2018-01-11T09:17:33+0800
     * @return                        [type] [description]
     */
    public function actionChangeTemplate(){
        $name = $this->post('temp_name','');
        if($name == ''){
            return $this->ajaxFail('更改失败，参数异常');
        }
        $theme_info = (new Config())->findOne(['varname'=>Config::THEME_NAME]);
        $theme_info->value = $name;
        $rs = $theme_info->save(false);
        if($rs){
            Config::getAllConfig(true);//重新生成配置缓存
            return $this->ajaxSuccess('更改成功');
        }
        return $this->ajaxFail('更改失败，未知错误');
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
        if($this->isPost()){
            $transaction = Yii::$app->db->beginTransaction();
            $data = Yii::$app->request->post();
            $fail = 0;
            foreach ($data as $key => $value) {
                $info = (new Config())->findOne(['varname'=>$key]);
                if(!is_null($info)){
                    $info->value = $value;
                    $rs = $info->save(false);
                    if(!$rs){
                        $fail++;
                    }
                }
            }
            if($fail > 0){
                $transaction->rollBack();
                return $this->ajaxFail('更改失败，未知错误');
            }
            Config::getAllConfig(true);
            $transaction->commit();
            return $this->ajaxSuccess('更改成功');
        }else{
            return $this->render('/config/basic');
        }
    }
    /**
     * @Author:          xiaoming
     * @DateTime:        2017-10-09
     * @name:获取参数设置
     * @copyright:       [copyright]
     * @license:         [license]
     * @return           [type]      [description]
     */
    public function actionGetConfig(){
        if($this->isPost()){
            $rs = Config::getAllConfig();
            return $this->ajaxSuccess('获取成功','',$rs);
        }
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
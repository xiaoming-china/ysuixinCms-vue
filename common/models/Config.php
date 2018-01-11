<?php

namespace common\models;

use Yii;
use common\models\BaseModel;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $varname
 * @property string $info
 * @property integer $groupid
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord{
    const THEME_NAME = 'theme';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupid'], 'integer'],
            [['value'], 'string'],
            [['varname'], 'string', 'max' => 20],
            [['info'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'varname' => 'Varname',
            'info' => 'Info',
            'groupid' => 'Groupid',
            'value' => 'Value',
        ];
    }
    /**
     * [getConfig 获取全部配置数据,并且生成到缓存]
     * @author:xiaoming
     * @date:2018-01-11T09:59:14+0800
     * @return                        [type] [description]
     */
    public static function getAllConfig($is_delete = false){
        $cache = Yii::$app->cache;
        if($is_delete === true){//如果是重新获取，则将当前缓存的删除
            $cache->delete('configs');
        }
        $list = $cache->get('configs');
        if ($list === false) { 
            $all_config = self::find()->asArray()->all();
            foreach ($all_config as $key => $value) {
                $d[$value['varname']] = $value['value'];
            }
            $cache->set('configs', $d, 86400 * 30);//缓存1个月
        }
        return $list;
    }
    /**
     * [getOneConfig 获取多个配置信息]
     * @author:xiaoming
     * @date:2018-01-11T10:23:51+0800
     * @param                         string $name [description]
     * @return                        [type]       [description]
     */
    public static function getOneConfig($name=''){
        if($name == ''){
            return false;
        }
        $config_list = self::getAllConfig(false);
        if(empty($config_list)){
            return false;
        }
        return $config_list[$name];
    }
}

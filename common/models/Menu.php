<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $parent_id
 * @property integer $is_top
 * @property integer $sort
 * @property integer $created_at
 */
class Menu extends BaseModel{

    const TOP_MENU    = 1;//顶级菜单
    const SECOND_MENU = 2;//二级菜单
    const THIRD_MENU  = 3;//三级菜单
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['parent_id', 'sort', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['url'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'created_at' => 'Created At',
        ];
    }
}

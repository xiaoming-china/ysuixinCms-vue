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
class Config extends BaseModel
{
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'varname' => 'Varname',
            'info' => 'Info',
            'groupid' => 'Groupid',
            'value' => 'Value',
        ];
    }
}

<?php

namespace common\models;

use Yii;
use common\models\BaseModel;

/**
 * This is the model class for table "{{%admin_manager}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $pass
 * @property string $pass_token
 * @property string $desc
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdminManager extends BaseModel  {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_manager}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pass', 'pass_token', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 30],
            [['pass', 'pass_token', 'desc'], 'string', 'max' => 50],
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
            'email' => 'Email',
            'pass' => 'Pass',
            'pass_token' => 'Pass Token',
            'desc' => 'Desc',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

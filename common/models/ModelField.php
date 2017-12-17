<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
/**
 * This is the model class for table "{{%model_field}}".
 *
 * @property string $fieldid
 * @property integer $modelid
 * @property string $field
 * @property string $name
 * @property string $tips
 * @property string $css
 * @property string $minlength
 * @property string $maxlength
 * @property string $pattern
 * @property string $errortips
 * @property string $formtype
 * @property string $setting
 * @property string $formattribute
 * @property string $unsetgroupids
 * @property string $unsetroleids
 * @property integer $isunique
 * @property string $listorder
 * @property integer $status
 * @property integer $isomnipotent
 *
 * @property Model $model
 */
class ModelField extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%model_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelid'], 'required','message'=>'模型ID不能为空'],
            [['modelid', 'minlength', 'maxlength', 'isunique', 'listorder', 'status'], 'integer'],
            [['tips'], 'string'],
            [['field', 'formtype'], 'string', 'max' => 20],
            [['name', 'css'], 'string', 'max' => 30],
            [['pattern', 'errortips', 'formattribute', 'unsetgroupids', 'unsetroleids'], 'string', 'max' => 255],
            [['modelid'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['modelid' => 'id']],
            ['setting','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fieldid' => 'Fieldid',
            'modelid' => 'Modelid',
            'field' => 'Field',
            'name' => 'Name',
            'tips' => 'Tips',
            'css' => 'Css',
            'minlength' => 'Minlength',
            'maxlength' => 'Maxlength',
            'pattern' => 'Pattern',
            'errortips' => 'Errortips',
            'formtype' => 'Formtype',
            'setting' => 'Setting',
            'formattribute' => 'Formattribute',
            'unsetgroupids' => 'Unsetgroupids',
            'unsetroleids' => 'Unsetroleids',
            'isunique' => 'Isunique',
            'listorder' => 'Listorder',
            'status' => 'Status',
            'isomnipotent' => 'Isomnipotent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasMany(Model::className(), ['id' => 'modelid']);
    }
}

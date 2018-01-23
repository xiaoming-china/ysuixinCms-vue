<?php

namespace common\models;

use Yii;


class CategoryData extends \yii\db\ActiveRecord{

    public static function tableName(){
        return '{{%category_data}}';
    }

    public function scenarios(){
        $s = parent::scenarios();
        $s['category_data']  = ['category_id','category_keywords','category_desc'];
        return $s;
    }
    public function rules()
    {
        return [
            [['category_id'], 'required','on'=>['category_data']],
            [['category_id'], 'integer','on'=>['category_data']],
            [['category_keywords'], 'string', 'max' => 100,'on'=>['category_data']],
            [['category_desc'], 'string', 'max' => 250,'on'=>['category_data']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'catid'],'on'=>['category_data']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => '栏目ID',
            'category_keywords' => '栏目关键字',
            'category_desc' => '栏目关键字',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['catid' => 'category_id']);
    }
}

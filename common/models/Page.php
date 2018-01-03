<?php

namespace common\models;

use Yii;


class Page extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['model_id', 'category_id', 'title'], 'required'],
            [['model_id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['create_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'content' => 'Content',
            'create_by' => 'Create By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    /**
     * [getPageInfo 获取单页内容]
     * @author:xiaoming
     * @date:2018-01-02T14:20:05+0800
     * @return                        [type] [description]
     */
    public static function getPageInfo($catId = ''){
        if($catId == ''){
            return false;
        }
        $rs = self::find()->where(['category_id'=>$catId])->asArray()->one();
        return $rs;
    }
}

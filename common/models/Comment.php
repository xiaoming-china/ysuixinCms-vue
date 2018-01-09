<?php

namespace common\models;

use Yii;
use common\models\BaseModel;
/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $content_id
 * @property string $commen_user
 * @property string $comment_content
 * @property string $re_content
 * @property integer $status
 * @property integer $comment_at
 * @property integer $re_at
 */
class Comment extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'content_id', 'commen_user', 'comment_content'], 'required'],
            [['category_id', 'content_id', 'status'], 'integer'],
            [['commen_user'], 'string', 'max' => 30],
            [['comment_content', 're_content'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'content_id' => 'Content ID',
            'commen_user' => 'Commen User',
            'comment_content' => 'Comment Content',
            're_content' => 'Re Content',
            'status' => 'Status',
        ];
    }
}

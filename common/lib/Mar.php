<?php

namespace common\lib;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Mar extends ActiveRecord
{
    public static $table = '';
    public $type = 2;

    /**
     * Mar constructor.
     * @param array $table
     * @param array $config
     */
    public function __construct($table, $config = [])
    {
        self::$table = $table;
        parent::__construct($config);
    }

    /**
     * @return array|string
     */
    public static function tableName()
    {
        return self::$table;
    }

//    public function rules()
//    {
//        return [
//        ];
//    }
//
//    public function attributeLabels()
//    {
//        return [
//        ];
//    }

    /**
     * @param $table
     * @return object
     * @throws InvalidConfigException
     */
    public static function findx($table)
    {
        if (self::$table != $table) {
            self::$table = $table;
        }
        return Yii::createObject(ActiveQuery::className(), [get_called_class(), ['from' => [static::tableName()]]]);
    }

    /**
     * @param array $row
     * @return static
     */
    public static function instantiate($row)
    {
        return new static(static::tableName());
    }

    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function findOnex($table, $condition)
    {
        return static::findByConditionx($table, $condition)->one();
    }

    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function findAllx($table, $condition)
    {
        return static::findByConditionx($table, $condition)->all();
    }

    /**
     * @param $table
     * @param $condition
     * @return mixed
     * @throws InvalidConfigException
     */
    protected static function findByConditionx($table, $condition)
    {
        $query = static::findx($table);

        if (!ArrayHelper::isAssociative($condition)) {
            // query by primary key
            $primaryKey = static::primaryKey();
            if (isset($primaryKey[0])) {
                $condition = [$primaryKey[0] => $condition];
            } else {
                throw new InvalidConfigException('"' . get_called_class() . '" must have a primary key.');
            }
        }

        return $query->andWhere($condition);
    }
    public function afterSave($insert,$changedAttributes) {
         if($this->type == 1 && $insert){
            $this->url = '/content/show?catId='.$this->category_id.'&id='.$this->id;
            $rs = $this->save();
            if($rs){
                return true;
            }
            return false;
         }
         return true;
    }
}
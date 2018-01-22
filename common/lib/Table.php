<?php

namespace common\lib;
use yii\db\Migration;
use yii\db\Schema;
use yii\db;
use yii;
use yii\db\Command;
use yii\db\QueryBuilder;
use common\models\BaseModel;
use common\models\Category;
/**
 * 数据库表操作类
 */
class Table extends BaseModel{
	private $libPath = ''; //当前路径
    const TABLE_DATA_PREFIX = '_data';//副表后缀
	//主表
	const BASIC_TABLE = [
			'id'          =>'pk',
			'category_id' =>'integer(11) default 0',
			'title'       =>'string(32) not null',
			'keywords'    =>'varchar(30) default ""',
			'thumb'       =>'varchar(500) default ""',
			'desc'        =>'varchar(200) default ""',
			'view'        =>'integer(11) default 0',
			'url'         =>'varchar(500) default ""',
			'status'	  =>'smallint(6) default 1',
			'sort'		  =>'smallint(6) default 1',
			'is_delete'   =>'tinyint(2) default 2',
			'create_by'   =>'varchar(20)',
			'publish_time'  =>'integer(11)',
			'allow_comment' =>'tinyint(2) default 1',
			'show_template' =>'varchar(500)',
			'created_at'    =>'integer(11)',
			'update_at' =>'integer(11)',
		];
        //副表
        const TABLE_DATA = [
            'id'          =>'integer(11) default 0',
            'content'     =>'text default ""',
        ];
		//字段类型
		const FIELDS_LIST = [
		    'text' => '单行文本',
		    'textarea' => '多行文本',
		    'select' => '下拉选择框',
		    'editor' => '富文本编辑器',
		    'radio' => '单选框',
		    'check' => '多选框',
		    'datetime' => '日期和时间选择框',
		    'downfile' => '单文件上传',
		    'downfiles' => '多文件上传',
		    'omnipotent' => '万能字段',
		];
		//字段规则
		const FIELDS_RULE = [
			'text'=>'varchar(255)',
			'textarea' => 'text',
		    'select' => 'varchar(255)',
		    'editor' => 'text',
		    'radio' => 'varchar(255)',
		    'check' => 'varchar(255)',
		    'date' => 'int(11)',
		    'pic_upload' => 'varchar(500)',
		    'downfile' => 'varchar(500)',
		    'downfiles' => 'varchar(500)',
		    'omnipotent' => 'varchar(500)',
		    
		];
		//可用默认模型字段
		const modelTablesInsert = '/data/basic_field.sql'; 
	//构造初始化数据
    public function __construct(){
         $this->libPath = dirname(__DIR__);
    }
     /**
      * [checkTablesql description]
      * @Author:xiaoming
      * @DateTime        2017-05-04T15:31:34+0800
      * @return          [type]                   [description]
      */
    public function checkTablesql(){
     	if (!is_file($this->libPath . self::modelTablesInsert)) {
            return false;
        }
        return $this->libPath . self::modelTablesInsert;
     }
	/**
	 * [checkTable 检测数据表是否存在]
	 * @Author:xiaoming
	 * @DateTime        2017-05-03T14:21:06+0800
	 * @param           [type]                   $table_name [description]
	 * @return          [type]                               [description]
	 */
	public static function checkTable($table_name) {
		$allTable = Yii::$app->db->getSchema()->getTableNames();//获取全部表名
		$Prefix   = Yii::$app->params['tablePrefix'];//获取数据库前缀
		$table_name = $Prefix.$table_name;
		
		if(!in_array($table_name, $allTable)){
			return false;
		}
		return $table_name;
    }
    /**
     * [checkColumn 检测表字段是否存在]
     * @Author:xiaoming
     * @DateTime        2017-05-03T16:19:00+0800
     * @param           [type]                   $table_name [description]
     * @param           [type]                   $column     [description]
     * @return          [type]                               [description]
     */
    public static function checkColumn($table_name,$column){
    	$table_name = Yii::$app->params['tablePrefix'].$table_name;
    	$allColumn = Yii::$app->db->getSchema()->getTableSchema($table_name,true);
        foreach ($allColumn->columns as $k => $v) {
            $s[] = $k;
        }
        return in_array($column, $s) ?  true : false;
    }
	/**
	 * [createBasicTable 创建模型基本表]
	 * @Author:xiaoming
	 * @DateTime        2017-04-26T16:02:40+0800
	 * @param           [type]$columns [表的列名称]
	 * @return          [type][description]
	 */
	public static function addTable($table_name = '',$filed){
		if($table_name == ''){
		  return false;
		}
		$table_name = Yii::$app->params['tablePrefix'].$table_name;
		//创建主表
		$r1 = Yii::$app->db->createCommand()->createTable($table_name, $filed)->execute();

		if($r1 != 0){
		  return false;
		}else{
		  //创建副表
          $r2 = Yii::$app->db->createCommand()->createTable($table_name.self::TABLE_DATA_PREFIX, self::TABLE_DATA)->execute();
          //如果副表创建失败，则删除创建的主表
          if($r2 != 0){
          	Yii::$app->db->createCommand()->dropTable($table_name)->execute();
          	return false;
          }else{
          	//如果主表和副表都创建成功,再创建副表外键
	        $f1 = Yii::$app->db->createCommand()->addForeignKey(
	        	$table_name.'_model_id',
	        	$table_name.self::TABLE_DATA_PREFIX, 
	        	'id',
	        	$table_name,
	        	'id', 
	        	'CASCADE',
	        	'CASCADE')->execute();
	        //创建主表栏目外键
	        $f2 = Yii::$app->db->createCommand()->addForeignKey(
	        	$table_name.'_content_category_id',
	        	$table_name,
	        	'category_id',
	        	Category::tableName(),
	        	'catid',
	        	'CASCADE',
	        	'CASCADE')->execute();
          }
		}
		return true;
	}
	/**
	 * [dropTable 删除表]
	 * @author:xiaoming
	 * @date:2017-12-19T11:38:59+0800
	 * @param                         string $table_name [description]
	 * @return                        [type]             [description]
	 */
	public static function dropTable($table_name = ''){
		if($table_name == ''){
		  return false;
		}
		$table = Yii::$app->params['tablePrefix'].$table_name;
		//先删除副表，再删除主表
		Yii::$app->db->createCommand()->dropTable($table.self::TABLE_DATA_PREFIX)->execute();
		Yii::$app->db->createCommand()->dropTable($table)->execute();
		return true;
	}

	
	/**
	 * [renameTable 修改表名]
	 * @Author:xiaoming
	 * @DateTime        2017-11-12T11:17:54+0800
	 * @param           [type]                   $table_name [description]
	 * @param           [type]                   $newName    [description]
	 * @return          [type]                               [description]
	 */
	public function tableRename($table_name,$newName){
		$table_name = Yii::$app->params['tablePrefix'].$table_name;
		$newName    = Yii::$app->params['tablePrefix'].$newName;
		if(!$table_name || !$newName){
		  return false;
		}

		$rs = Yii::$app->db->createCommand()->renameTable($table_name, $newName)->execute();
		
		return !$rs ? true : false;
	}
	/**
	 * [addBasicData 为模型增加基本字段]
	 * @Author:xiaoming
	 * @DateTime        2017-05-03T17:30:01+0800
	 * @param           [type]                   $table [description]
	 */
	public function addBasicField($mId = ''){
		if($mId == ''){
			return false;
		}
		$d = $this->checkTablesql();
		if(!$d){
			return false;
		}
		$modelTablesInsert = file_get_contents($d);
  		$table_name = Yii::$app->params['tablePrefix'].'model_field';
        //表名，模型id替换
        $sql = str_replace(array('@tableName@', '@modelid@', '@createdAt@', '@updatedAt@'), array($table_name,$mId,time(),time()),$modelTablesInsert);
        //p($sql);
		Yii::$app->db->createCommand($sql)->execute();
		return true;
	}
	/**
	 * [addColumn 增加列]
	 * @Author:xiaoming
	 * @DateTime        2017-05-03T15:00:09+0800
	 * @param           [type]                   $table  [description]
	 * @param           [type]                   $column [description]
	 * @param           [type]                   $type   [description]
	 */
	public function columnAdd($table='', $column='', $type=''){
		if($table == '' || $column == ''){
		  return false;
		}
		if($this->checkColumn($table,$column)){
			return false;
		}
		if($type == ''){
			$type = self::FIELDS_RULE['text'];
		}else{
			$type = self::FIELDS_RULE[$type];
		}
		$table_name = Yii::$app->params['tablePrefix'].$table;
		$rs = Yii::$app->db->createCommand()->addColumn($table_name,$column,$type)->execute();
		return $rs == 0 ? true : false;
	}
	/**
	 * [delColumn 删除列]
	 * @Author:xiaoming
	 * @DateTime        2017-05-05T11:09:50+0800
	 * @param           [type]                   $table  [description]
	 * @param           [type]                   $column [description]
	 * @return          [type]                           [description]
	 */
	public function delColumn($table='',$column=''){
		if($table == '' || $column == ''){
		  return false;
		}
		$table_name = Yii::$app->params['tablePrefix'].$table;
		if(!$this->checkColumn($table,$column)){
			return false;
		}
		$rs = Yii::$app->db->createCommand()->dropColumn($table,$column)->execute();
		return $rs == 0 ? true : false;
	}
	/**
	 * [reColumnName 列改名]
	 * @Author:xiaoming
	 * @DateTime        2017-05-05T11:09:50+0800
	 * @param           [type]                   $table  [description]
	 * @param           [type]                   $column [description]
	 * @return          [type]                           [description]
	 */
	public function reColumnName($table='', $oldName='', $newName='', $type =''){
		if($table == '' || $oldName == '' || $newName == ''){
		  return false;
		}
		$table_name = Yii::$app->params['tablePrefix'].$table;
		if($type == ''){
			$type = self::FIELDS_RULE['text'];
		}else{
			$type = self::FIELDS_RULE[$type];
		}
		$rs   = Yii::$app->db->createCommand()->renameColumn($table_name, $oldName, $newName)->execute();
		//$type = 0;
		$type = Yii::$app->db->createCommand()->alterColumn($table_name, $newName, $type)->execute();

		if($rs == 0 && $type == 0){
			return true;
		}
		return false;
	}


}

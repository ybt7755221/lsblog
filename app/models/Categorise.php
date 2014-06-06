<?php

/**
 * This is the model class for table "{{categorise}}".
 *
 * The followings are the available columns in table '{{categorise}}':
 * @property string $id
 * @property string $fid
 * @property string $cate_name
 * @property string $cate_english
 * @property string $description
 * @property string $cate_image
 * @property integer $cate_order
 * @property integer $visible
 * @property string $path
 */
class Categorise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{categorise}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fid, cate_name, cate_english, description, cate_image, path', 'required'),
			array('cate_order, visible', 'numerical', 'integerOnly'=>true),
			array('fid, path', 'length', 'max'=>20),
			array('cate_name', 'length', 'max'=>60),
			array('cate_english', 'length', 'max'=>64),
			array('cate_image', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fid, cate_name, cate_english, description, cate_image, cate_order, visible, path', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'posts' => array( self::HAS_MANY, 'Posts', 'id' )
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fid' => 'Fid',
			'cate_name' => 'Cate Name',
			'cate_english' => 'Cate English',
			'description' => 'Description',
			'cate_image' => 'Cate Image',
			'cate_order' => 'Cate Order',
			'visible' => 'Visible',
			'path' => 'Path',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('fid',$this->fid,true);
		$criteria->compare('cate_name',$this->cate_name,true);
		$criteria->compare('cate_english',$this->cate_english,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cate_image',$this->cate_image,true);
		$criteria->compare('cate_order',$this->cate_order);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categorise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
     //分类处理
    public function getFidCate($type = "")
    {
        $connection = Yii::app()->db;
        /**
         * 如需无限分类请替将此使用此sql语句
         * $sql = "SELECT `id`, `cate_name`, `path` FROM `{{categorise}}` ORDER BY `path` `cate_order`";
        */
        $sql = "SELECT `id`, `cate_name`, `path` FROM `{{categorise}}` where `fid` = 0 ORDER BY `cate_order`";
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        if ($type == "Controller")
        /**
         * 如需无限分类请替将此语句替换下面语句
         * $arr = array('0'=>'顶级分类');
        */
            return array('0'=>'顶级分类');
        else
            $arr = array();
        foreach($result as $value)
        {
            $arr[$value['id']] = $this->showPrefix(substr_count($value['path'],'-')).$value['cate_name'];
        }
        return $arr;
    }
    
    protected function showPrefix($num)
    {
        $result = '';
        if ($num == 1)
            return $result;
        else
        { 
            for($i = 1; $i < $num; $i++)
            {
                $result .= "|→→";
            }
            return $result;
        }
    }
    
    public function getVisible( $id = "" )
    {
       $state = array('1'=>'启用','2'=>'禁用');
       $result = '';
        if (empty($id))
            $result = $state;
        else
            $result = $state[$id];
        return $result;
    }
    
    /*网站顶部导航*/
    public function getItems( $id = '' )
    {
        $categorySql = 'SELECT `id`, `cate_name`, `cate_english`, `cate_image` FROM `{{categorise}}` WHERE `visible` = 1 AND `fid` = 0 ORDER BY `cate_order`, `id`';
        $command = Yii::app()->db->createCommand( $categorySql );
        $navArr = $command->queryAll();
        $num = count($navArr);
        $items = array();
        $items[0] =  array( 'label'=>'首页分类', 'url' => array( '/site/index' ) );
        if( empty( $id ) )
           $items[0]['itemOptions'] = array( 'class' => 'active' );
        if( empty( $navArr ) )
            return $items;           
        foreach($navArr AS $idx => $result){
            $nums = $idx + 1;
            $items[$nums] = array(
                'label' => $result['cate_name'],
                'url' => Yii::app()->createAbsoluteUrl( '/posts/index',array( 'id' => $result['id'] ) ),
            );
            if ( !empty( $id ) && $id == $result['id'] )
                $items[$nums]['itemOptions'] = array( 'class' => 'active' );
        }
        $items[ $num + 2 ] = array( 'label'=>'相册展示', 'url' => Yii::app()->baseUrl.'/ablum' );
        if ( !empty( $id ) && $id == -1 )
            $items[ $num + 2 ]['itemOptions'] = array( 'class' => 'active' );
     
        return $items;
    }
}

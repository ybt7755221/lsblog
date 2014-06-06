<?php

/**
 * This is the model class for table "{{site}}".
 *
 * The followings are the available columns in table '{{site}}':
 * @property string $id
 * @property string $name
 * @property string $value
 * @property integer $is_show
 * @property integer $type
 * @property string $html
 */
class Site extends CActiveRecord
{
    private $site_status = array( '0' => '禁止访问', '1' => '开放访问', '2' => '本地访问' );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{site}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, value', 'required'),
			array('is_show, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>512),
			array('value', 'length', 'max'=>1024),
			array('html', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, value, is_show, type, html', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'value' => 'Value',
			'is_show' => 'Is Show',
			'type' => 'Type',
			'html' => 'Html',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('is_show',$this->is_show);
		$criteria->compare('type',$this->type);
		$criteria->compare('html',$this->html,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Site the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getWebStatus( $id )
    {
        
        return CHtml::encode( $this->site_status[$id] );
        
    }
    
    public function getAllStatus( $id = 1 )
    {
        $resuleStr = '';
        foreach ( $this->site_status as $key => $val )
        {
            $resuleStr .= "<option value='$key' >".CHtml::encode( $val )."</option>";
        }
        return $resuleStr;
    }
}

<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property string $id
 * @property string $create_uid
 * @property string $tagname
 * @property string $description
 * @property integer $tag_order
 */
class Tags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, tagname, description', 'required'),
			array('tag_order', 'numerical', 'integerOnly'=>true),
            array('create_uid', 'length', 'max'=>20),
			array('tagname', 'length', 'max'=>60),
			array('description', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, tagname, description, tag_order', 'safe', 'on'=>'search'),
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
			'create_uid' => 'Create Uid',
			'tagname' => 'Tagname',
			'description' => 'Description',
			'tag_order' => 'Tag Order',
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
		$criteria->compare('create_uid',$this->create_uid,true);
		$criteria->compare('tagname',$this->tagname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('tag_order',$this->tag_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getTagName( $tag )
    {
        $tag = str_replace(  '，',  ',', $tag);
        $tag = trim( $tag, ',');
        $tag = trim( $tag);
        $tagArr = explode ( ',', $tag);
        $num = count( $tagArr ) < 10 ? count( $tagArr ) : 10 ;
        $idIn = '';
        foreach ($tagArr as $val){
	        	$sql = 'SELECT `id` FROM `{{tags}}` WHERE `tagname` = :tagname';
	        	$res = Yii::app()->db->createCommand( $sql )->bindValue( ':tagname', trim( $val ), PDO::PARAM_STR )->queryRow();
	        	if ( $res ) {
	        		$idIn .= $res['id'].',';
	        	}else{
	        		$idIn .= $this->createTag( trim( $val ) );
	        		$idIn .= ',';
	        	}
        }
        $idIn = trim( $idIn, ',');
        return $idIn;
    }
    
    public function showName( $tag, $type=0 )
    {
        $result = '';
        $tempArr = array();
        $tagName = '';
        $tagArr = explode ( ',', $tag);
        foreach ( $tagArr as $val )
        {
            $sql = 'SELECT `tagname` FROM `{{tags}}` WHERE `id` = :id';
            $res = Yii::app()->db->createCommand( $sql )->bindValue( ':id',$val, PDO::PARAM_INT )->queryRow();
            if ( $type == 0 )
                $tagName .= $res['tagname'].','; 
            elseif( $type == 1 )
                $tempArr[] = array( 'id' => $val, 'tagname' => $res['tagname'] );
        }
        if ( $type == 0 )
            $result = trim($tagName,',');
        elseif ( $type == 1 ) {
            $result = $tempArr;
            unset($tempArr);
        }
        return $result;
    }
    
    private function createTag( $tag )
    {
        $sql = 'INSERT INTO `{{tags}}`( `create_uid`, `tagname`, `description`, `tag_order` ) VALUES ( :uid, :tagname, :descriptions, :tag_order )';
        $dbCommand = Yii::app()->db->createCommand( $sql );
        $dbCommand->bindValue( ':uid', Yii::app()->user->id, PDO::PARAM_INT );
        $dbCommand->bindValue( ':tagname', $tag, PDO::PARAM_STR );
        $dbCommand->bindValue( ':descriptions', '暂无', PDO::PARAM_STR );
        $dbCommand->bindValue( ':tag_order', 0, PDO::PARAM_INT );
        $dbCommand->execute();
        return Yii::app()->db->getLastInsertID();
    }
}

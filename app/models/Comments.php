<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property string $id
 * @property string $post_id
 * @property string $author
 * @property string $author_webroot
 * @property string $author_email
 * @property string $author_ip
 * @property string $comment_date
 * @property string $comment_content
 * @property string $is_show
 */
class Comments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_content', 'required'),
			array('post_id', 'length', 'max'=>10),
			array('author', 'length', 'max'=>64),
			array('author_webroot, author_email', 'length', 'max'=>100),
			array('author_ip', 'length', 'max'=>15),
			array('is_show', 'length', 'max'=>5),
			array('comment_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, post_id, author, author_webroot, author_email, author_ip, comment_date, comment_content, is_show', 'safe', 'on'=>'search'),
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
             'posts' => array( self::BELONGS_TO, 'Posts', 'post_id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => 'Post',
			'author' => 'Author',
			'author_webroot' => 'Author Webroot',
			'author_email' => 'Author Email',
			'author_ip' => 'Author Ip',
			'comment_date' => 'Comment Date',
			'comment_content' => 'Comment Content',
			'is_show' => 'Is Show',
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
		$criteria->compare('post_id',$this->post_id,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('author_webroot',$this->author_webroot,true);
		$criteria->compare('author_email',$this->author_email,true);
		$criteria->compare('author_ip',$this->author_ip,true);
		$criteria->compare('comment_date',$this->comment_date,true);
		$criteria->compare('comment_content',$this->comment_content,true);
		$criteria->compare('is_show',$this->is_show,true);
        $criteria->with = 'posts';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function isShow( $id = '' )
    { 
        $arr = array('FALSE'=>'禁止审核','TRUE'=>'通过审核');
        if ( empty( $id ) )
            $resArr = $arr;
        else
            $resArr = $arr[$id];  
        return $resArr;
    }
}

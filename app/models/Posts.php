<?php

/**
 * This is the model class for table "{{posts}}".
 *
 * The followings are the available columns in table '{{posts}}':
 * @property string $id
 * @property string $author
 * @property string $title
 * @property string $content
 * @property string $excerpt
 * @property integer $status
 * @property integer $comment_status
 * @property string $post_password
 * @property string $cate_id
 * @property string $tag_id
 * @property string $comment_count
 * @property string $type
 * @property string $create_time
 */
class Posts extends CActiveRecord
{
    
    private $_status = array( '1' => '普通博文','2' => '推荐博文' );
    private $_comment_status = array('禁止评价','允许评价');
    private $_type = array('文本类博文','图片类博文','视频类博文');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{posts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, excerpt, tag_id', 'required'),
			array('status, comment_status', 'numerical', 'integerOnly'=>true),
            array('author, comment_count', 'length', 'max'=>20),
			array('post_password', 'length', 'max'=>32),
			array('title, tag_id', 'length', 'max'=>200),
			array('cate_id, create_time', 'length', 'max'=>10),
			array('type', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, author, title, content, excerpt, status, comment_status, post_password, cate_id, tag_id, comment_count, type, create_time', 'safe', 'on'=>'search'),
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
            'user' => array( self::BELONGS_TO, 'Users', 'author' ),
            'comments' => array( self::HAS_MANY, 'Comments', 'post_id' ),
            'category' => array( self::BELONGS_TO, 'Categorise', 'cate_id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author' => 'Author',
			'title' => 'Title',
			'content' => 'Content',
			'excerpt' => 'Excerpt',
			'status' => 'Status',
			'comment_status' => 'Comment Status',
			'post_password' => 'Post Password',
			'cate_id' => 'Cate',
			'tag_id' => 'Tag',
			'comment_count' => 'Comment Count',
			'type' => 'Type',
			'create_time' => 'Create Time',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('excerpt',$this->excerpt,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('comment_status',$this->comment_status);
		$criteria->compare('post_password',$this->post_password,true);
		$criteria->compare('cate_id',$this->cate_id,true);
		$criteria->compare('tag_id',$this->tag_id,true);
		$criteria->compare('comment_count',$this->comment_count,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('create_time',$this->create_time,true);
        $criteria->with = 'category';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Posts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getStatus()
    {
        return $this->_status;
    }
    
    public function getType()
    {
        return $this->_type;
    }
    
    public function getCommentStatus()
    {
        return $this->_comment_status;
    }
    public function getCommentStatusName( $id )
    {
        return $this->_comment_status[$id];
    }
    
    public function getStatusName( $id )
    {
        return $this->_status[$id];
    }
}

<?php

/**
 * This is the model class for table "{{user_field}}".
 *
 * The followings are the available columns in table '{{user_field}}':
 * @property string $uid
 * @property string $logo
 * @property integer $weight
 * @property integer $height
 * @property string $sex
 * @property string $sexual
 * @property integer $felling
 * @property string $blood
 * @property string $birthday
 * @property string $email
 * @property string $weibo
 * @property string $weixin
 * @property string $qq
 * @property string $msn
 * @property string $description
 * @property string $university
 * @property integer $is_qq
 * @property integer $is_email
 * @property integer $is_sexual
 * @property integer $is_weibo
 * @property integer $is_weixin
 * @property integer $is_msn
 * @property integer $is_birthday
 * @property integer $is_edu
 * @property string $school
 * @property integer $is_felling
 */
class UserField extends CActiveRecord
{
    private $_felling = array( '0' => '未婚','1' => '已婚','2' => '离异','3' => '丧偶');
    private $_sex = array( 'S' => '保密', 'M' => '男', 'W' => '女' );
    private $_sexual = array( 'S' => '保密', 'M' => '喜欢异性', 'W' => '只爱同性', 'D' => '男女通吃' );
    private $_blood = array( 'S' => '保密', 'A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O' );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_field}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, weixin, qq', 'required'),
			array('weight, height, felling, is_qq, is_email, is_sexual, is_weibo, is_weixin, is_msn, is_birthday, is_edu, is_felling', 'numerical', 'integerOnly'=>true),
			array('uid', 'length', 'max'=>10),
			array('logo', 'length', 'max'=>100),
			array('sex, sexual', 'length', 'max'=>1),
			array('blood', 'length', 'max'=>2),
			array('email, msn', 'length', 'max'=>128),
			array('weibo', 'length', 'max'=>255),
			array('weixin', 'length', 'max'=>300),
			array('qq', 'length', 'max'=>20),
			array('description', 'length', 'max'=>600),
			array('university, school', 'length', 'max'=>120),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, logo, weight, height, sex, sexual, felling, blood, birthday, email, weibo, weixin, qq, msn, description, university, is_qq, is_email, is_sexual, is_weibo, is_weixin, is_msn, is_birthday, is_edu, school, is_felling', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'logo' => 'Logo',
			'weight' => 'Weight',
			'height' => 'Height',
			'sex' => 'Sex',
			'sexual' => 'Sexual',
			'felling' => 'Felling',
			'blood' => 'Blood',
			'birthday' => 'Birthday',
			'email' => 'Email',
			'weibo' => 'Weibo',
			'weixin' => 'Weixin',
			'qq' => 'Qq',
			'msn' => 'Msn',
			'description' => 'Description',
			'university' => 'University',
			'is_qq' => 'Is Qq',
			'is_email' => 'Is Email',
			'is_sexual' => 'Is Sexual',
			'is_weibo' => 'Is Weibo',
			'is_weixin' => 'Is Weixin',
			'is_msn' => 'Is Msn',
			'is_birthday' => 'Is Birthday',
			'is_edu' => 'Is Edu',
			'school' => 'School',
			'is_felling' => 'Is Felling',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('height',$this->height);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('sexual',$this->sexual,true);
		$criteria->compare('felling',$this->felling);
		$criteria->compare('blood',$this->blood,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('weibo',$this->weibo,true);
		$criteria->compare('weixin',$this->weixin,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('msn',$this->msn,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('is_qq',$this->is_qq);
		$criteria->compare('is_email',$this->is_email);
		$criteria->compare('is_sexual',$this->is_sexual);
		$criteria->compare('is_weibo',$this->is_weibo);
		$criteria->compare('is_weixin',$this->is_weixin);
		$criteria->compare('is_msn',$this->is_msn);
		$criteria->compare('is_birthday',$this->is_birthday);
		$criteria->compare('is_edu',$this->is_edu);
		$criteria->compare('school',$this->school,true);
		$criteria->compare('is_felling',$this->is_felling);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /**
    *处理博主信息的信息
    */
    public function userDataOutput( $arr )
    {
        if ( !is_array( $arr ) )
        {
            Yii::app()->end( '参数错误' );
        }
        /**
        *删除不想显示的内容
        */
        if ( $arr['is_felling'] == 0 )
        {
            unset( $arr['felling'] );
        }
        else
        {
            $arr['felling'] = $this->_felling[$arr['felling']];
        }
        unset( $arr['is_felling'] );
        
        if ( $arr['is_edu'] == 0 )
        {
            unset( $arr['university'] );
            unset( $arr['school'] );
        }
        unset( $arr['is_edu'] );
        foreach( $arr as $key => $val )
        {
            if ( strstr( $key , 'is_' ) )
            {
                if ( $val == 0 )
                {
                    $KEY = substr( $key, strpos( $key, '_' )+1 );
                    unset( $arr[$KEY] );
                }
                unset( $arr[$key] );
            }
        }
        if ( isset( $arr['sexual'] ) )
        {
            $arr['sexual'] = $this->_sex[$arr['sexual']];
        }
        $arr['sex'] = $this->_sex[$arr['sex']];
        
        return $arr;
    }
    /**获取select选项*/
    public function getOption( $type )
    {
        $result = ' ';
        switch( $type )
        {
            case 'FELLING'  :   
                                $result = $this->_felling;
                                break;
            case 'SEX'      :
                                $result = $this->_sex;
                                break;
            case 'SEXUAL'   :
                                $result = $this->_sexual;
                                break;
            case 'BLOOD'    :
                                $result = $this->_blood;
                                break;
            default         :
                                break;
        }
        return $result;
    }
}

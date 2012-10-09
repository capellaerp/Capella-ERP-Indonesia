<?php

/**
 * This is the model class for table "addresscontact".
 *
 * The followings are the available columns in table 'addresscontact':
 * @property integer $addresscontactid
 * @property integer $contacttypeid
 * @property integer $addressbookid
 * @property string $addresscontactname
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Addressbook $addressbook
 * @property Contacttype $contacttype
 */
class Hospitalcontact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Addresscontact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'addresscontact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contacttypeid, addressbookid, addresscontactname', 'required'),
			array('contacttypeid, addressbookid', 'numerical', 'integerOnly'=>true),
			array('addresscontactname,mobilephone,phoneno,emailaddress', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('addresscontactid, contacttypeid, addressbookid, addresscontactname,mobilephone,phoneno,emailaddress', 'safe', 'on'=>'search'),
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
			'addressbook' => array(self::BELONGS_TO, 'Hospital', 'addressbookid'),
			'contacttype' => array(self::BELONGS_TO, 'Contacttype', 'contacttypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'addresscontactid' => 'ID',
			'contacttypeid' => 'Contact Type',
			'addressbookid' => 'FullName',
			'addresscontactname' => 'Contact ',
            'mobilephone'=>'Mobile Phone',
            'phoneno'=>'Phone',
            'emailaddress'=>'Email Address'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
    $criteria->with=array('contacttype','addressbook');
	if (isset($_GET['Hospitalcontact'])) {
$model=new Hospitalcontact('search');
$model->attributes = $_GET['Hospitalcontact'];
$criteria->condition='addressbook.ishospital=1 and t.addressbookid='.$model->addressbookid;
} else {
$criteria->condition='addressbook.ishospital=1 and t.addressbookid=0';
}
		$criteria->compare('addresscontactid',$this->addresscontactid);
		$criteria->compare('contacttype.contacttypename',$this->contacttypeid,true);
		$criteria->compare('addressbook.addressbookid',$this->addressbookid,true);
		$criteria->compare('addresscontactname',$this->addresscontactname,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}


  public function behaviors()
  {
    return array(
        // Classname => path to Class
        'ActiveRecordLogableBehavior'=>
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
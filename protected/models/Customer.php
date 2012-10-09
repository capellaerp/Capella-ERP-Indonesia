<?php

/**
 * This is the model class for table "addressbook".
 *
 * The followings are the available columns in table 'addressbook':
 * @property integer $addressbookid
 * @property string $fullname
 * @property integer $iscustomer
 * @property integer $isemployee
 * @property integer $isapplicant
 * @property integer $isvendor
 * @property integer $isinsurance
 * @property integer $isCustomer
 * @property integer $isCustomer
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 * @property Addresscontact[] $addresscontacts
 * @property Customeraccount[] $Customeraccounts
 * @property Employee[] $employees
 * @property Voucheragent[] $voucheragents
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Addressbook the static model class
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
		return 'addressbook';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, recordstatus', 'required'),
			array('iscustomer, isemployee, isapplicant, isvendor, isinsurance, isbank, ishospital, recordstatus,acchutangid', 'numerical', 'integerOnly'=>true),
			array('fullname, taxno', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('addressbookid, fullname, taxno, iscustomer, isemployee, isapplicant, isvendor, ishospital, isbank, isinsurance, recordstatus', 'safe', 'on'=>'search'),
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
			'acchutang' => array(self::BELONGS_TO, 'Account', 'acchutangid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'addressbookid' => 'ID',
			'fullname' => 'Name ',
			'iscustomer' => 'Is Customer',
			'isemployee' => 'Is Employee',
			'isapplicant' => 'Is Applicant',
			'isvendor' => 'Is Vendor',
			'isinsurance' => 'Is Insurance',
			'isCustomer' => 'Is Customer',
			'ishospital' => 'Is Hospital',
			'recordstatus' => 'Record Status',
            'taxno' => 'Tax No',
            'acchutangid'=>'Account Receivable'
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
        $criteria->with=array('acchutang');
    $criteria->condition='iscustomer=1';
		$criteria->compare('addressbookid',$this->addressbookid);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('iscustomer',$this->iscustomer);
		$criteria->compare('isemployee',$this->isemployee);
		$criteria->compare('isapplicant',$this->isapplicant);
		$criteria->compare('isvendor',$this->isvendor);
		$criteria->compare('isinsurance',$this->isinsurance);
		$criteria->compare('isbank',$this->isbank);
		$criteria->compare('ishospital',$this->ishospital);
		$criteria->compare('t.recordstatus',$this->recordstatus);
		$criteria->compare('acchutang.accountname',$this->acchutangid,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

  /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('acchutang');
    $criteria->condition='iscustomer=1 and t.recordstatus=1';
		$criteria->compare('addressbookid',$this->addressbookid);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('iscustomer',$this->iscustomer);
		$criteria->compare('isemployee',$this->isemployee);
		$criteria->compare('isapplicant',$this->isapplicant);
		$criteria->compare('isvendor',$this->isvendor);
		$criteria->compare('isinsurance',$this->isinsurance);
		$criteria->compare('isbank',$this->isbank);
		$criteria->compare('ishospital',$this->ishospital);
		$criteria->compare('acchutang.accountname',$this->acchutangid,true);

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
<?php

/**
 * This is the model class for table "soheader".
 *
 * The followings are the available columns in table 'soheader':
 * @property integer $soheaderid
 * @property integer $purchasingorgid
 * @property integer $purchasinggroupid
 * @property string $sodate
 * @property integer $addressbookid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Podetail[] $sodetails
 */
class Soheader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Soheader the static model class
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
		return 'soheader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('addressbookid, recordstatus,paymentmethodid', 'numerical', 'integerOnly'=>true),
			array('headernote,sono,sodate,postdate','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('soheaderid, sodate, addressbookid, paymentmethodid,recordstatus', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'addressbookid'),
			'paymentmethod' => array(self::BELONGS_TO, 'Paymentmethod', 'paymentmethodid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'soheaderid' => 'ID',
			'sodate' => 'SO Date',
			'addressbookid' => 'Customer',
			'headernote' => 'Header Note',
			'sono' => 'SO No',
			'postdate' => 'Post Date',
            'paymentmethodid' => 'Payment Method',
			'recordstatus' => 'Recordstatus',
		);
	}

        public function beforeSave() {
		$this->sodate = date(Yii::app()->params['datetodb'], strtotime($this->sodate));
		$this->postdate = date(Yii::app()->params['datetodb'], strtotime($this->sodate));
    return parent::beforeSave();
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
		 $criteria->with=array('customer','paymentmethod');
		$criteria->compare('soheaderid',$this->soheaderid);
		$criteria->compare('paymentmethod.paymentmethodname',$this->paymentmethodid,true);
		$criteria->compare('sodate',$this->sodate,true);
		$criteria->compare('customer.fullname',$this->addressbookid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}


    public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='t.recordstatus>1';
		 $criteria->with=array('customer','paymentmethod');
		$criteria->compare('soheaderid',$this->soheaderid);
		$criteria->compare('paymentmethod.paymentmethodname',$this->paymentmethodid,true);
		$criteria->compare('sodate',$this->sodate,true);
		$criteria->compare('customer.fullname',$this->addressbookid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}

	public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listso') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		 $criteria->with=array('customer','paymentmethod');
		$criteria->compare('soheaderid',$this->soheaderid);
		$criteria->compare('paymentmethod.paymentmethodname',$this->paymentmethodid,true);
		$criteria->compare('sodate',$this->sodate,true);
		$criteria->compare('customer.fullname',$this->addressbookid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function searchwfqtystatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listso') and upper(e.username)=upper('".Yii::app()->user->name."') and
t.soheaderid in (select dad.soheaderid
from sodetail dad
where qty > giqty))";
		 $criteria->with=array('customer','paymentmethod');
		$criteria->compare('soheaderid',$this->soheaderid);
		$criteria->compare('paymentmethod.paymentmethodname',$this->paymentmethodid,true);
		$criteria->compare('sodate',$this->sodate,true);
		$criteria->compare('customer.fullname',$this->addressbookid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
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
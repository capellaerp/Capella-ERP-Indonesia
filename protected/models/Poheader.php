<?php

/**
 * This is the model class for table "poheader".
 *
 * The followings are the available columns in table 'poheader':
 * @property integer $poheaderid
 * @property integer $purchasingorgid
 * @property integer $purchasinggroupid
 * @property string $docdate
 * @property integer $addressbookid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Podetail[] $podetails
 */
class Poheader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Poheader the static model class
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
		return 'poheader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchasinggroupid, addressbookid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('pono','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('poheaderid, pono,purchasingorgid, purchasinggroupid, docdate, addressbookid, recordstatus', 'safe', 'on'=>'search'),
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
			'purchasinggroup' => array(self::BELONGS_TO, 'Purchasinggroup', 'purchasinggroupid'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'addressbookid'),
			'paymentmethod' => array(self::BELONGS_TO, 'Paymentmethod', 'paymentmethodid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'poheaderid' => 'ID',
			'purchasingorgid' => 'Purchasing Org',
			'purchasinggroupid' => 'Purchasing Group',
			'docdate' => 'Doc Date',
			'addressbookid' => 'Supplier',
			'headernote' => 'Header Note',
			'pono' => 'PO No',
			'postdate' => 'Post Date',
            'paymentmethodid' => 'Payment Method',
			'recordstatus' => 'Recordstatus',
		);
	}

        public function beforeSave() {
		$this->docdate = date(Yii::app()->params['datetodb'], strtotime($this->docdate));
		$this->postdate = date(Yii::app()->params['datetodb'], strtotime($this->docdate));
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
		 $criteria->with=array('purchasinggroup','supplier');
		$criteria->compare('poheaderid',$this->poheaderid);
		$criteria->compare('pono',$this->pono,true);
		$criteria->compare('purchasinggroup.purchasinggroupid',$this->purchasinggroupid,true);
		$criteria->compare('docdate',$this->docdate,true);
		$criteria->compare('supplier.fullname',$this->addressbookid,true);
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
		 $criteria->with=array('purchasinggroup','supplier');
		$criteria->condition='t.recordstatus>1';
		$criteria->compare('pono',$this->pono,true);
		$criteria->compare('poheaderid',$this->poheaderid);
		$criteria->compare('purchasinggroup.purchasinggroupcode',$this->purchasinggroupid,true);
		$criteria->compare('docdate',$this->docdate,true);
		$criteria->compare('addressbook.fullname',$this->addressbookid,true);
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
		 $criteria->with=array('purchasinggroup','supplier');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listpo') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('poheaderid',$this->poheaderid);
		$criteria->compare('pono',$this->pono,true);
		$criteria->compare('purchasinggroup.purchasinggroupcode',$this->purchasinggroupid,true);
		$criteria->compare('docdate',$this->docdate,true);
		$criteria->compare('supplier.fullname',$this->addressbookid,true);
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
		 $criteria->with=array('purchasinggroup','supplier');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listpo') and upper(e.username)=upper('".Yii::app()->user->name."'))
and t.poheaderid in (
select zz.poheaderid
from podetail zz
where zz.qtyres < zz.poqty
)
";
		$criteria->compare('poheaderid',$this->poheaderid);
		$criteria->compare('pono',$this->pono,true);
		$criteria->compare('purchasinggroup.purchasinggroupcode',$this->purchasinggroupid,true);
		$criteria->compare('docdate',$this->docdate,true);
		$criteria->compare('supplier.fullname',$this->addressbookid,true);
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
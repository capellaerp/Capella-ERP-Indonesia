<?php

/**
 * This is the model class for table "cashbank".
 *
 * The followings are the available columns in table 'cashbank':
 * @property string $cashbankid
 * @property string $cashbankno
 * @property string $cashbanktypeid
 * @property integer $accountid
 * @property string $amount
 * @property integer $currencyid
 * @property string $currencyrate
 * @property string $transdate
 * @property string $description
 * @property integer $recordstatus
 * @property string $invoiceid
 * @property string $invoiceapid
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Currency $currency
 * @property Cashbankacc[] $cashbankaccs
 */
class Cashbank extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cashbank the static model class
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
		return 'cashbank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('accountid, currencyid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('cashbankno', 'length', 'max'=>50),
			array('cashbanktypeid, invoiceid', 'length', 'max'=>10),
			array('amount, currencyrate', 'length', 'max'=>30),
			array('transdate, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cashbankid, cashbankno, cashbanktypeid, accountid, amount, currencyid, currencyrate, transdate, description, recordstatus, invoiceid', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'accountid'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoiceid'),
			'cashbankaccs' => array(self::HAS_MANY, 'Cashbankacc', 'cashbankid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cashbankid' => 'ID',
			'cashbankno' => 'Cash Bank No',
			'cashbanktypeid' => 'Cash Bank Type',
			'accountid' => 'Account',
			'amount' => 'Amount',
			'currencyid' => 'Currency',
			'currencyrate' => 'Currency Rate',
			'transdate' => 'Trans Date',
			'description' => 'Description',
			'recordstatus' => 'Record Status',
			'invoiceid' => 'Invoice'
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

		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('cashbankno',$this->cashbankno,true);
		$criteria->compare('cashbanktypeid',$this->cashbanktypeid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('transdate',$this->transdate,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchwfinstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.cashbanktypeid = 1 and t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listcashbankin') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('cashbankno',$this->cashbankno,true);
		$criteria->compare('cashbanktypeid',$this->cashbanktypeid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('transdate',$this->transdate,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function searchinstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.cashbanktypeid = 1";
		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('cashbankno',$this->cashbankno,true);
		$criteria->compare('cashbanktypeid',$this->cashbanktypeid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('transdate',$this->transdate,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function searchwfoutstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.cashbanktypeid = 2 and t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listcashbankout') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('cashbankno',$this->cashbankno,true);
		$criteria->compare('cashbanktypeid',$this->cashbanktypeid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('transdate',$this->transdate,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function searchoutstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition="t.cashbanktypeid = 2";
		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('cashbankno',$this->cashbankno,true);
		$criteria->compare('cashbanktypeid',$this->cashbanktypeid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('transdate',$this->transdate,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
        $this->transdate = date(Yii::app()->params['datetodb'], strtotime($this->transdate));
    return parent::beforeSave();
}
	
	public function behaviors()
  {
    return array(
        // Classname => path to Class
        'ActiveRecordLogableBehavior'=>
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
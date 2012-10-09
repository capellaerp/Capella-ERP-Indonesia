<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $accountid
 * @property string $accountname
 * @property string $parentaccountid
 * @property integer $recordstatus
 */
class Account extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Account the static model class
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
		return 'account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('accountname, accountcode', 'required'),
			array('recordstatus, currencyid, accounttypeid', 'numerical', 'integerOnly'=>true),
			array('accountcode', 'length', 'max'=>20),
			array('accountname, parentaccountid', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('accountid, accountname, accountcode, parentaccountid, currencyid, recordstatus,accounttypeid', 'safe', 'on'=>'search'),
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
      'parentaccount' => array(self::BELONGS_TO, 'Account', 'parentaccountid'),
      'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
      'accounttype' => array(self::BELONGS_TO, 'Accounttype', 'accounttypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'accountid' => 'ID',
			'accountname' => 'Account',
			'accountcode' => 'Account Code',
			'parentaccountid' => 'Parent Account',
			'currencyid' => 'Currency',
			'recordstatus' => 'Record Status',
            'accounttypeid'=>'Account Type'
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
		$criteria->with=array('parentaccount','currency','accounttype');
		$criteria->compare('t.accountid',$this->accountid,true);
		$criteria->compare('t.accountcode',$this->accountcode,true);
		$criteria->compare('t.accountname',$this->accountname,true);
		$criteria->compare('parentaccount.accountcode',$this->parentaccountid,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('accounttype.accounttypename',$this->accounttypeid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
	
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('parentaccount','currency','accounttype');
		$criteria->condition='t.recordstatus=1';
		$criteria->compare('t.accountid',$this->accountid,true);
		$criteria->compare('t.accountcode',$this->accountcode,true);
		$criteria->compare('t.accountname',$this->accountname,true);
		$criteria->compare('parentaccount.accountcode',$this->parentaccountid,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('accounttype.accounttypename',$this->accounttypeid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
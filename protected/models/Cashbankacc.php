<?php

/**
 * This is the model class for table "cashbankacc".
 *
 * The followings are the available columns in table 'cashbankacc':
 * @property string $cashbankaccid
 * @property string $cashbankid
 * @property integer $accountid
 * @property string $debit
 * @property string $credit
 * @property integer $currencyid
 * @property string $currencyrate
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Cashbank $cashbank
 * @property Currency $currency
 * @property Account $account
 */
class Cashbankacc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cashbankacc the static model class
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
		return 'cashbankacc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cashbankid', 'required'),
			array('accountid, currencyid', 'numerical', 'integerOnly'=>true),
			array('cashbankid', 'length', 'max'=>10),
			array('debit, credit, currencyrate', 'length', 'max'=>30),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cashbankaccid, cashbankid, accountid, debit, credit, currencyid, currencyrate, description', 'safe', 'on'=>'search'),
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
			'cashbank' => array(self::BELONGS_TO, 'Cashbank', 'cashbankid'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
			'account' => array(self::BELONGS_TO, 'Account', 'accountid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cashbankaccid' => 'ID',
			'cashbankid' => 'Cash Bank',
			'accountid' => 'Account',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'currencyid' => 'Currency',
			'currencyrate' => 'Currency Rate',
			'description' => 'Description',
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
if (isset($_GET['Cashbankacc'])) {
$model=new Cashbankacc('search');
$criteria->condition='t.cashbankid='.$_GET['Cashbankacc']['cashbankid'];
} else {
$criteria->condition='t.cashbankid=0';
}
		$criteria->compare('cashbankaccid',$this->cashbankaccid,true);
		$criteria->compare('cashbankid',$this->cashbankid,true);
		$criteria->compare('accountid',$this->accountid);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('currencyid',$this->currencyid);
		$criteria->compare('currencyrate',$this->currencyrate,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
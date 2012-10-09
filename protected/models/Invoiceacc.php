<?php

/**
 * This is the model class for table "invoiceacc".
 *
 * The followings are the available columns in table 'invoiceacc':
 * @property string $invoiceaccid
 * @property string $invoiceid
 * @property integer $accountid
 * @property string $debit
 * @property string $credit
 * @property integer $currencyid
 * @property string $currencyrate
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 * @property Currency $currency
 * @property Account $account
 */
class Invoiceacc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoiceacc the static model class
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
		return 'invoiceacc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoiceid', 'required'),
			array('accountid, currencyid', 'numerical', 'integerOnly'=>true),
			array('invoiceid', 'length', 'max'=>10),
			array('debit, credit, currencyrate', 'length', 'max'=>30),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('invoiceaccid, invoiceid, accountid, debit, credit, currencyid, currencyrate, description', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoiceid'),
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
			'invoiceaccid' => 'ID',
			'invoiceid' => 'Invoice',
			'accountid' => 'Account',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'currencyid' => 'Currency',
			'currencyrate' => 'Rate',
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
if (isset($_GET['Invoiceacc'])) {
$model=new Invoiceacc('search');
$criteria->condition='t.invoiceid='.$_GET['Invoiceacc']['invoiceid'];
} else {
$criteria->condition='t.invoiceid=0';
}
		$criteria->compare('invoiceaccid',$this->invoiceaccid,true);
		$criteria->compare('invoiceid',$this->invoiceid,true);
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
	
		public function beforeSave() {
		$this->debit = str_replace(",","",$this->debit);
		$this->credit = str_replace(",","",$this->credit);
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
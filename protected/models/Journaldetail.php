<?php

/**
 * This is the model class for table "journaldetail".
 *
 * The followings are the available columns in table 'journaldetail':
 * @property integer $journaldetailid
 * @property integer $genjournalid
 * @property integer $accountid
 * @property string $debit
 * @property string $credit
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Genjournal $genjournal
 */
class Journaldetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Journaldetail the static model class
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
		return 'journaldetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('genjournalid, accountid, debit, credit,currencyid', 'required'),
			array('genjournalid, accountid', 'numerical', 'integerOnly'=>true),
			array('debit, credit', 'length', 'max'=>20),
			array('detailnote', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('journaldetailid, genjournalid, accountid, debit, credit,currencyid', 'safe', 'on'=>'search'),
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
			'genjournal' => array(self::BELONGS_TO, 'Genjournal', 'genjournalid'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'journaldetailid' => 'ID',
			'genjournalid' => 'Header',
			'accountid' => 'Account',
			'debit' => 'Debit',
			'credit' => 'Credit',
			'currencyid' => 'Currency',
			'detailnote' => 'Detail Note'
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
		$criteria->with=array('genjournal','account','currency');
		if (isset($_GET['Journaldetail'])) {
$model=new Journaldetail('search');
$model->attributes = $_GET['Journaldetail'];
$criteria->condition='t.genjournalid='.$model->genjournalid;
} else {
$criteria->condition='t.genjournalid=0';
}
		$criteria->compare('journaldetailid',$this->journaldetailid);
		$criteria->compare('genjournal.genjournalid',$this->genjournalid,true);
		$criteria->compare('t.accountid',$this->accountid);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
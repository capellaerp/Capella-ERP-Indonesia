<?php

/**
 * This is the model class for table "genledger".
 *
 * The followings are the available columns in table 'genledger':
 * @property integer $genledgerid
 * @property integer $accountid
 * @property integer $genjournalid
 * @property string $debit
 * @property string $credit
 *
 * The followings are the available model relations:
 * @property Account $account
 */
class Genledger extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Genledger the static model class
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
		return 'genledger';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('accountid, genjournalid, debit, credit', 'required'),
			array('accountid, genjournalid', 'numerical', 'integerOnly'=>true),
			array('debit, credit', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('genledgerid, accountid, genjournalid, debit, credit', 'safe', 'on'=>'search'),
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
			'genledgerid' => 'ID',
			'accountid' => 'Account',
			'genjournalid' => 'General Journal',
			'debit' => 'Debit',
			'credit' => 'Credit',
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
        $criteria->with=array('account','genjournal','currency');
        		if (isset($_GET['Genledger'])) {
$model=new Genledger('search');
$model->attributes = $_GET['Genledger'];
$criteria->condition='t.accountid='.$model->accountid;
} else {
$criteria->condition='t.accountid=0';
}
		$criteria->compare('genledgerid',$this->genledgerid);
		$criteria->compare('t.accountid',$this->accountid,true);
		$criteria->compare('genjournal.referenceno',$this->genjournalid,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);

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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
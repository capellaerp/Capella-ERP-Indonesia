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
class Gidetail extends CActiveRecord
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
		return 'gidetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('giheaderid, productid, unitofmeasureid, qty', 'required'),
			array('giheaderid, productid, unitofmeasureid,slocid', 'numerical', 'integerOnly'=>true),
			array('qty,itemnote,serialno', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('giheaderid, productid, unitofmeasureid, qty,slocid,itemnote', 'safe', 'on'=>'search'),
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
			'giheader' => array(self::BELONGS_TO, 'Giheader', 'giheaderid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gidetailid' => 'ID',
			'giheader' => 'GI Header',
			'productid' => 'Material',
			'unitofmeasureid' => 'Unit of Measure',
			'qty' => 'Quantity',
			'slocid'=>'Sloc',
            'itemnote'=>'Item Note',
            'serialno'=>'Serial No'
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
		$criteria->with=array('giheader','product','unitofmeasure','sloc');
		if (isset($_GET['Gidetail'])) {
$model=new Gidetail('search');
$model->attributes = $_GET['Gidetail'];
$criteria->condition='t.giheaderid='.$model->giheaderid;
} else {
$criteria->condition='t.giheaderid=0';
}
		$criteria->compare('gidetailid',$this->gidetailid);
		$criteria->compare('giheader.giheaderid',$this->giheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('sloc.sloccode',$this->sloc,true);
		$criteria->compare('itemnote',$this->itemnote,true);

		return new CActiveDataProvider(get_class($this), array(
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
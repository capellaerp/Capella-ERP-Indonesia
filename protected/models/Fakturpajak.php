<?php

/**
 * This is the model class for table "fakturpajak".
 *
 * The followings are the available columns in table 'fakturpajak':
 * @property string $fakturpajakid
 * @property string $fakturpajakno
 * @property string $invoiceid
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
class Fakturpajak extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fakturpajak the static model class
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
		return 'fakturpajak';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fakturpajakno', 'length', 'max'=>50),
			array('invoiceid', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fakturpajakid, fakturpajakno, invoiceid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fakturpajakid' => 'ID',
			'fakturpajakno' => 'Faktur Pajak',
			'invoiceid' => 'Invoice',
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

		$criteria->compare('fakturpajakid',$this->fakturpajakid,true);
		$criteria->compare('fakturpajakno',$this->fakturpajakno,true);
		$criteria->compare('invoiceid',$this->invoiceid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
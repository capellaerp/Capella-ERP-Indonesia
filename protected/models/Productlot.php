<?php

/**
 * This is the model class for table "productlot".
 *
 * The followings are the available columns in table 'productlot':
 * @property integer $productlotid
 * @property integer $productid
 * @property string $lotno
 * @property string $startdate
 * @property string $sled
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class Productlot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productlot the static model class
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
		return 'productlot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productid, lotno, startdate, sled', 'required'),
			array('productid', 'numerical', 'integerOnly'=>true),
			array('lotno', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productlotid, productid, lotno, startdate, sled', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productlotid' => 'ID',
			'productid' => 'Product',
			'lotno' => 'Lot No',
			'startdate' => 'Start Date',
			'sled' => 'Sled',
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

		$criteria->compare('productlotid',$this->productlotid);
		$criteria->compare('productid',$this->productid);
		$criteria->compare('lotno',$this->lotno,true);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('sled',$this->sled,true);

		return new CActiveDataProvider(get_class($this), array(
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
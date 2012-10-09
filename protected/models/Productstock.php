<?php

/**
 * This is the model class for table "productstock".
 *
 * The followings are the available columns in table 'productstock':
 * @property integer $productstockid
 * @property integer $productid
 * @property integer $slocid
 * @property integer $qty
 * @property integer $unitofmeasureid
 * @property integer $referenceno
 * @property integer $transtype
 * @property string $refsource
 */
class Productstock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productstock the static model class
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
		return 'productstock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productid, slocid, qty, unitofmeasureid', 'required'),
			array('productid, slocid, qty, unitofmeasureid', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productstockid, productid, slocid, qty, unitofmeasureid', 'safe', 'on'=>'search'),
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
          'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
          'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productstockid' => 'ID',
			'productid' => 'Product',
			'slocid' => 'Sloc',
			'qty' => 'Qty',
			'unitofmeasureid' => 'Unit Of Measure',
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
$criteria->with=array('product','sloc','unitofmeasure');
		$criteria->compare('productstockid',$this->productstockid);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('sloc.description',$this->slocid,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);

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
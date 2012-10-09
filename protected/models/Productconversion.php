<?php

/**
 * This is the model class for table "productconversion".
 *
 * The followings are the available columns in table 'productconversion':
 * @property integer $productconversionid
 * @property integer $productid
 * @property integer $fromuom
 * @property string $fromvalue
 * @property integer $touom
 * @property integer $tovalue
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Unitofmeasure $fromuom0
 * @property Unitofmeasure $touom0
 */
class Productconversion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productconversion the static model class
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
		return 'productconversion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productid, fromuom, fromvalue, touom, tovalue', 'required'),
			array('productid, fromuom, touom', 'numerical', 'integerOnly'=>true),
			array('fromvalue, tovalue', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productconversionid, productid, fromuom, fromvalue, touom, tovalue', 'safe', 'on'=>'search'),
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
			'fromuom0' => array(self::BELONGS_TO, 'Unitofmeasure', 'fromuom'),
			'touom0' => array(self::BELONGS_TO, 'Unitofmeasure', 'touom'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productconversionid' => 'ID',
			'productid' => 'Product',
			'fromuom' => 'From UOM',
			'fromvalue' => 'From Value',
			'touom' => 'To UOM',
			'tovalue' => 'To Value',
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
		if (isset($_GET['Productconversion'])) {
$model=new Productconversion('search');
$criteria->condition='t.productid='.$_GET['Productconversion']['productid'];
} else {
$criteria->condition='t.productid=0';
}
        $criteria->with=array('product','fromuom0','touom0');
		$criteria->compare('productconversionid',$this->productconversionid);
		$criteria->compare('t.productid',$this->productid,true);
		$criteria->compare('fromuom0.uomcode',$this->fromuom,true);
		$criteria->compare('fromvalue',$this->fromvalue,true);
		$criteria->compare('touom0.uomcode',$this->touom,true);
		$criteria->compare('tovalue',$this->tovalue);

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
<?php

/**
 * This is the model class for table "productpurchase".
 *
 * The followings are the available columns in table 'productpurchase':
 * @property integer $productpurchaseid
 * @property integer $productid
 * @property integer $plantid
 * @property integer $orderunit
 * @property integer $purchasinggroupid
 * @property string $validfrom
 * @property integer $isbatch
 * @property integer $isautoPO
 *
 * The followings are the available model relations:
 * @property Unitofmeasure $orderunit0
 * @property Plant $plant
 * @property Product $product
 * @property Purchasinggroup $purchasinggroup
 */
class Productpurchase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productpurchase the static model class
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
		return 'productpurchase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productid', 'required'),
			array('productid, plantid, orderunit, purchasinggroupid, isautoPO', 'numerical', 'integerOnly'=>true),
			array('validfrom,validto', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productpurchaseid, productid, plantid, orderunit, purchasinggroupid, validfrom, validto, isautoPO', 'safe', 'on'=>'search'),
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
			'orderunit0' => array(self::BELONGS_TO, 'Unitofmeasure', 'orderunit'),
			'plant' => array(self::BELONGS_TO, 'Plant', 'plantid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'purchasinggroup' => array(self::BELONGS_TO, 'Purchasinggroup', 'purchasinggroupid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productpurchaseid' => 'ID',
			'productid' => 'Product',
			'plantid' => 'Plant',
			'orderunit' => 'Order Unit',
			'purchasinggroupid' => 'Purchasing Group',
			'validfrom' => 'Valid From',
			'validto' => 'Valid To',
			'isautoPO' => 'Is Auto PR ?',
		);
	}

            public function beforeSave()
    {
      $this->validfrom = date(Yii::app()->params['datetodb'], strtotime($this->validfrom));
      $this->validto = date(Yii::app()->params['datetodb'], strtotime($this->validto));
      return parent::beforeSave();
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
		if (isset($_GET['Productpurchase'])) {
$model=new Productpurchase('search');
$criteria->condition='t.productid='.$_GET['Productpurchase']['productid'];
} else {
$criteria->condition='t.productid=0';
}
		$criteria->compare('productpurchaseid',$this->productpurchaseid);
		$criteria->compare('productid',$this->productid);
		$criteria->compare('plantid',$this->plantid);
		$criteria->compare('orderunit',$this->orderunit);
		$criteria->compare('purchasinggroupid',$this->purchasinggroupid);
		$criteria->compare('validfrom',$this->validfrom,true);
		$criteria->compare('validto',$this->validto,true);
		$criteria->compare('isautoPO',$this->isautoPO);

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
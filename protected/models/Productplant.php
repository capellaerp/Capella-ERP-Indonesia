<?php

/**
 * This is the model class for table "productplant".
 *
 * The followings are the available columns in table 'productplant':
 * @property integer $productplantid
 * @property integer $slocid
 * @property integer $unitofissue
 * @property integer $isbatch
 * @property string $storagebin
 * @property string $pickingarea
 * @property integer $sled
 */
class Productplant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productplant the static model class
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
		return 'productplant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slocid, productid', 'required'),
			array('slocid, productid, unitofissue, isautolot, sled,snroid', 'numerical', 'integerOnly'=>true),
			array('storagebin, pickingarea', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productplantid, slocid, productid, unitofissue, snroid, isautolot, storagebin, pickingarea, sled', 'safe', 'on'=>'search'),
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
		  	'unitofissue0' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofissue'),
		  	'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
		  	'snro' => array(self::BELONGS_TO, 'Snro', 'snroid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productplantid' => 'ID',
			'productid' => 'Product',
			'slocid' => 'Storage Location',
			'unitofissue' => 'Unit of Issue',
			'isautolot' => 'Is Serial No ?',
			'storagebin' => 'Storage Bin',
			'pickingarea' => 'Picking Area',
			'sled' => 'SLED (days)',
			'snroid' => 'SNRO'
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
		$criteria->with=array('snro','product','unitofissue0');
		if (isset($_GET['Productplant'])) {
$model=new Productplant('search');
$criteria->condition='t.productid='.$_GET['Productplant']['productid'];
} else {
$criteria->condition='t.productid=0';
}
		$criteria->compare('productplantid',$this->productplantid);
		$criteria->compare('t.productid',$this->productid,true);
		$criteria->compare('sloc.sloccode',$this->slocid,true);
		$criteria->compare('unitofissue0.uomcode',$this->unitofissue,true);
		$criteria->compare('isautolot',$this->isautolot);
		$criteria->compare('storagebin',$this->storagebin,true);
		$criteria->compare('pickingarea',$this->pickingarea,true);
		$criteria->compare('sled',$this->sled);
		$criteria->compare('snro.description',$this->sled,true);

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
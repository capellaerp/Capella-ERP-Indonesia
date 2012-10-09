<?php

/**
 * This is the model class for table "sodetail".
 *
 * The followings are the available columns in table 'sodetail':
 * @property integer $sodetailid
 * @property integer $soheader
 * @property integer $productid
 * @property double $poqty
 * @property integer $unitofmeasureid
 * @property string $delvdate
 * @property double $netprice
 * @property integer $currencyid
 * @property integer $slocid
 * @property integer $taxid
 *
 * The followings are the available model relations:
 * @property Poheader $soheader
 * @property Product $product
 * @property Unitofmeasure $unitofmeasure
 * @property Currency $currency
 * @property Sloc $sloc
 * @property Tax $tax
 */
class Sodetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sodetail the static model class
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
		return 'sodetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('soheaderid', 'required'),
			array('soheaderid, productid, unitofmeasureid, currencyid, slocid, taxid', 'numerical', 'integerOnly'=>true),
			array('qty,price,currencyrate', 'length'),
			array('itemnote', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sodetailid, soheaderid, productid,unitofmeasureid, currencyid, slocid, taxid, qty,price,currencyrate,itemnote', 'safe', 'on'=>'search'),
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
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
			'tax' => array(self::BELONGS_TO, 'Tax', 'taxid'),
			'gidetail' => array(self::BELONGS_TO, 'Gidetail', 'gidetailid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sodetailid' => 'ID',
			'soheaderid' => 'Header',
			'productid' => 'Product',
			'giqty' => 'GI Qty',
			'unitofmeasureid' => 'UOM',
			'price' => 'Price',
			'currencyid' => 'Currency',
			'currencyrate' => 'Currency Rate',
			'slocid' => 'Sloc',
			'taxid' => 'Tax',
			'itemnote' => 'Item Note',
            'gidetailid' => 'Goods Issue',
		);
	}
	
	public function getTotals()
	{
		$total=0;
		$connection=Yii::app()->db;
			  try
			  {
				$sql = 'select sum(ifnull(price,0) * ifnull(qty,0) * ifnull(currencyrate,0)) as total from sodetail where soheaderid = '.$this->soheaderid;
				$command=$connection->createCommand($sql);
				$row = 	$command->queryRow();
				$total = $row['total'];
				return $total;
			  }
			  catch(Exception $e) // an exception is raised if a query fails
			  {
				return $total;
			}
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
		$criteria->with=array('tax','currency','product','unitofmeasure','sloc','gidetail');
                if (isset($_GET['Sodetail'])) {
$criteria->condition='t.soheaderid='.$_GET['Sodetail']['soheaderid'];
} else {
$criteria->condition='t.soheaderid=0';
}
		$criteria->compare('sodetailid',$this->sodetailid);
		$criteria->compare('t.soheaderid',$this->soheaderid,true);
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}

		public function beforeSave() {
		$this->qty = str_replace(",","",$this->qty);
		$this->currencyrate = str_replace(",","",$this->currencyrate);
		$this->price = str_replace(",","",$this->price);
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
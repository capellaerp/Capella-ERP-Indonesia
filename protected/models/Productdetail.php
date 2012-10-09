<?php

/**
 * This is the model class for table "productdetail".
 *
 * The followings are the available columns in table 'productdetail':
 * @property string $productdetailid
 * @property string $grdetailid
 * @property string $slocid
 * @property string $expiredate
 * @property string $serialno
 * @property string $qty
 * @property string $unitofmeasureid
 * @property string $buydate
 * @property string $buyprice
 * @property string $currencyid
 */
class Productdetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productdetail the static model class
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
		return 'productdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slocid, unitofmeasureid, currencyid,productid,recordstatus,ownershipid', 'length', 'max'=>10),
			array('serialno,materialcode,location', 'length', 'max'=>50),
			array('buyprice,buydate,qty,expiredate,materialstatusid', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productdetailid, slocid, expiredate, serialno, qty, unitofmeasureid, buydate, buyprice, currencyid,materialstatusid,materialcode,
              productid', 'safe', 'on'=>'search'),
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
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'materialstatus' => array(self::BELONGS_TO, 'Materialstatus', 'materialstatusid'),
			'ownership' => array(self::BELONGS_TO, 'Ownership', 'ownershipid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productdetailid' => 'ID',
			'slocid' => 'Sloc',
			'expiredate' => 'Expire Date',
			'serialno' => 'Serial No',
			'qty' => 'Qty',
			'unitofmeasureid' => 'UOM',
			'buydate' => 'Buy Date',
			'buyprice' => 'Buy Price',
			'currencyid' => 'Currency',
            'productid'=>'Product',
            'picproduct'=>'PIC',
            'location'=>'Location',
            'locationdate'=>'Change Location Date',
			'materialstatusid'=>'Material Status',
			'materialcode'=>'Material Code',
			'recordstatus'=>'Record Status',
			'ownershipid'=>'Ownership'
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
        $criteria->with=array('product','materialstatus','unitofmeasure','sloc','currency','ownership');
		$criteria->compare('productdetailid',$this->productdetailid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('sloc.description',$this->slocid,true);
		$criteria->compare('expiredate',$this->expiredate,true);
		$criteria->compare('serialno',$this->serialno,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('buydate',$this->buydate,true);
		$criteria->compare('buyprice',$this->buyprice,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('materialstatus.materialstatusname',$this->materialstatusid,true);
		$criteria->compare('ownership.ownershipname',$this->ownershipid,true);
		$criteria->compare('location',$this->location,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('product','materialstatus','unitofmeasure','sloc','currency','ownership');
        if (isset($_GET['productid']) && isset($_GET['slocid']) ) 
		{
			$criteria->condition = "t.materialcode is not null and t.recordstatus = 1 and qty > 0 and 
				t.slocid = ".$_GET['slocid'].
				" and t.productid = ".$_GET['productid'];
		}
		$criteria->compare('productdetailid',$this->productdetailid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('sloc.description',$this->slocid,true);
		$criteria->compare('expiredate',$this->expiredate,true);
		$criteria->compare('serialno',$this->serialno,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('buydate',$this->buydate,true);
		$criteria->compare('buyprice',$this->buyprice,true);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('materialstatus.materialstatusname',$this->materialstatusid,true);
		$criteria->compare('ownership.ownershipname',$this->ownershipid,true);
		$criteria->compare('location',$this->location,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	        public function beforeSave()
    {
      $this->expiredate = date(Yii::app()->params['datetodb'], strtotime($this->expiredate));
      $this->buydate = date(Yii::app()->params['datetodb'], strtotime($this->buydate));
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
<?php

/**
 * This is the model class for table "productbasic".
 *
 * The followings are the available columns in table 'productbasic':
 * @property integer $productbasicid
 * @property integer $productid
 * @property integer $baseuom
 * @property integer $materialgroupid
 * @property string $oldmatno
 * @property integer $divisionid
 * @property string $grossweight
 * @property integer $weightunit
 * @property string $netweight
 * @property string $volume
 * @property integer $volumeunit
 * @property string $sizedimension
 * @property integer $materialpackage
 *
 * The followings are the available model relations:
 * @property Product $materialpackage0
 * @property Unitofmeasure $baseuom0
 * @property Division $division
 * @property Materialgroup $materialgroup
 * @property Product $product
 */
class Productbasic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productbasic the static model class
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
		return 'productbasic';
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
			array('productid, baseuom, materialgroupid, weightunit, volumeunit, materialpackage', 'numerical', 'integerOnly'=>true),
			array('oldmatno', 'length', 'max'=>30),
			array('grossweight, netweight, volume', 'length', 'max'=>10),
			array('sizedimension', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productbasicid, productid, baseuom, materialgroupid, oldmatno, grossweight, weightunit, netweight, volume, volumeunit, sizedimension, materialpackage', 'safe', 'on'=>'search'),
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
			'materialpackage0' => array(self::BELONGS_TO, 'Product', 'materialpackage'),
			'baseuom0' => array(self::BELONGS_TO, 'Unitofmeasure', 'baseuom'),
			'baseuom1' => array(self::BELONGS_TO, 'Unitofmeasure', 'weightunit'),
			'baseuom2' => array(self::BELONGS_TO, 'Unitofmeasure', 'volumeunit'),
			'materialgroup' => array(self::BELONGS_TO, 'Materialgroup', 'materialgroupid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productbasicid' => 'ID',
			'productid' => 'Product',
			'baseuom' => 'Base UOM',
			'materialgroupid' => 'Material Group',
			'oldmatno' => 'Old Material Number',
			'grossweight' => 'Gross Weight',
			'weightunit' => 'Weight Unit',
			'netweight' => 'Net Weight',
			'volume' => 'Volume',
			'volumeunit' => 'Volume Unit',
			'sizedimension' => 'Size Dimension',
			'materialpackage' => 'Material Package',
            ''=>'Record Status'
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
        $criteria->with=array('product','materialgroup','materialpackage0',
            'baseuom0','baseuom1','baseuom1','baseuom2');
			if (isset($_GET['Productbasic'])) {
$model=new Productbasic('search');
$criteria->condition='t.productid='.$_GET['Productbasic']['productid'];
} else {
$criteria->condition='t.productid=0';
}
		$criteria->compare('productbasicid',$this->productbasicid);
		$criteria->compare('t.productid',$this->productid,true);
		$criteria->compare('baseuom',$this->baseuom,true);
		$criteria->compare('materialgroup.materialgroupcode',$this->materialgroupid,true);
		$criteria->compare('oldmatno',$this->oldmatno,true);
		$criteria->compare('grossweight',$this->grossweight,true);
		$criteria->compare('weightunit',$this->weightunit,true);
		$criteria->compare('netweight',$this->netweight,true);
		$criteria->compare('volume',$this->volume,true);
		$criteria->compare('volumeunit',$this->volumeunit,true);
		$criteria->compare('sizedimension',$this->sizedimension,true);
		$criteria->compare('materialpackage0.productname',$this->materialpackage,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

    public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->condition='=1';
        $criteria->with=array('product','materialgroup','materialpackage0',
            'baseuom0','baseuom1','baseuom1','baseuom2');
		$criteria->compare('productbasicid',$this->productbasicid);
		$criteria->compare('t.productid',$this->productid,true);
		$criteria->compare('baseuom',$this->baseuom,true);
		$criteria->compare('materialgroup.materialgroupcode',$this->materialgroupid,true);
		$criteria->compare('oldmatno',$this->oldmatno,true);
		$criteria->compare('grossweight',$this->grossweight,true);
		$criteria->compare('weightunit',$this->weightunit,true);
		$criteria->compare('netweight',$this->netweight,true);
		$criteria->compare('volume',$this->volume,true);
		$criteria->compare('volumeunit',$this->volumeunit,true);
		$criteria->compare('sizedimension',$this->sizedimension,true);
		$criteria->compare('materialpackage0.productname',$this->materialpackage,true);

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
        // Classproductname => path to Class
        'ActiveRecordLogableBehavior'=>
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
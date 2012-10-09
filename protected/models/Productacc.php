<?php

/**
 * This is the model class for table "productacc".
 *
 * The followings are the available columns in table 'productacc':
 * @property string $productaccid
 * @property integer $productid
 * @property integer $inventoryaccid
 * @property integer $salesaccid
 * @property integer $salesretaccid
 * @property integer $itemdiscaccid
 * @property integer $cogsaccid
 * @property integer $purchaseretaccid
 * @property integer $expenseaccid
 * @property integer $unbilledgoodsaccid
 *
 * The followings are the available model relations:
 * @property Account $unbilledgoodsacc
 * @property Account $cogsacc
 * @property Account $expenseacc
 * @property Account $inventoryacc
 * @property Account $itemdiscacc
 * @property Product $product
 * @property Account $purchaseretacc
 * @property Account $salesretacc
 * @property Account $salesacc
 */
class Productacc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productacc the static model class
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
		return 'productacc';
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
			array('productid, inventoryaccid, salesaccid, salesretaccid, itemdiscaccid, cogsaccid, purchaseretaccid, expenseaccid, unbilledgoodsaccid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productaccid, productid, inventoryaccid, salesaccid, salesretaccid, itemdiscaccid, cogsaccid, purchaseretaccid, expenseaccid, unbilledgoodsaccid', 'safe', 'on'=>'search'),
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
			'unbilledgoodsacc' => array(self::BELONGS_TO, 'Account', 'unbilledgoodsaccid'),
			'cogsacc' => array(self::BELONGS_TO, 'Account', 'cogsaccid'),
			'expenseacc' => array(self::BELONGS_TO, 'Account', 'expenseaccid'),
			'inventoryacc' => array(self::BELONGS_TO, 'Account', 'inventoryaccid'),
			'itemdiscacc' => array(self::BELONGS_TO, 'Account', 'itemdiscaccid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'purchaseretacc' => array(self::BELONGS_TO, 'Account', 'purchaseretaccid'),
			'salesretacc' => array(self::BELONGS_TO, 'Account', 'salesretaccid'),
			'salesacc' => array(self::BELONGS_TO, 'Account', 'salesaccid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productaccid' => 'ID',
			'productid' => 'Product',
			'inventoryaccid' => 'Inventory Account',
			'salesaccid' => 'Sales Account',
			'salesretaccid' => 'Sales Ret Account',
			'itemdiscaccid' => 'Item Discharge Account',
			'cogsaccid' => 'Cogs Account',
			'purchaseretaccid' => 'Purchase Return Account',
			'expenseaccid' => 'Expense Account',
			'unbilledgoodsaccid' => 'Unbilled Goods Account',
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
if (isset($_GET['Productacc'])) {
$model=new Productacc('search');
$criteria->condition='t.productid='.$_GET['Productacc']['productid'];
} else {
$criteria->condition='t.productid=0';
}
		$criteria->compare('productaccid',$this->productaccid,true);
		$criteria->compare('productid',$this->productid);
		$criteria->compare('inventoryaccid',$this->inventoryaccid);
		$criteria->compare('salesaccid',$this->salesaccid);
		$criteria->compare('salesretaccid',$this->salesretaccid);
		$criteria->compare('itemdiscaccid',$this->itemdiscaccid);
		$criteria->compare('cogsaccid',$this->cogsaccid);
		$criteria->compare('purchaseretaccid',$this->purchaseretaccid);
		$criteria->compare('expenseaccid',$this->expenseaccid);
		$criteria->compare('unbilledgoodsaccid',$this->unbilledgoodsaccid);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
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
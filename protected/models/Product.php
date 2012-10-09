<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $productid
 * @property string $productname
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table productname
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array valproductidation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productname, recordstatus', 'required'),
			array('recordstatus,isstock', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productid, productname, isstock,recordstatus', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation productname and the related
		// class productname for the relations automatically generated below.
		return array(
          'productbasic' => array(self::HAS_MANY, 'Productbasic', 'productid'),
          'productacc' => array(self::HAS_MANY, 'Productacc', 'productid'),
		);
	}

	/**
	 * @return array customized attribute labels (productname=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productid' => 'ID',
			'productname' => 'Product',
			'productpic' => 'Picture',
			'isstock'=>'Is Stock',
			'recordstatus' => 'Record Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvproductider the data provproductider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('productid',$this->productid);
		$criteria->compare('productname',$this->productname,true);
		$criteria->compare('recordstatus',$this->recordstatus,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvproductider the data provproductider that can return the models based on the search/filter conditions.
	 */
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$criteria->compare('productid',$this->productid);
		$criteria->compare('productname',$this->productname,true);
		$criteria->compare('recordstatus',$this->recordstatus,true);

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
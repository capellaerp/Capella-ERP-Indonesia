<?php

/**
 * This is the model class for table "journaldetail".
 *
 * The followings are the available columns in table 'journaldetail':
 * @property integer $journaldetailid
 * @property integer $genjournalid
 * @property integer $accountid
 * @property string $debit
 * @property string $credit
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Genjournal $genjournal
 */
class Productstockhist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Journaldetail the static model class
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
		return 'productstockhist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
					array('productid,slocid, qty, unitofmeasureid', 'numerical'),
					array('referenceno,referencedate,productstockid','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productstockhistid,slocid,qty,unitofmeasureid,productid,referenceno,productstockid,referencedate', 'safe', 'on'=>'search'),
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
			'productstock' => array(self::BELONGS_TO, 'Productstock', 'productstockid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productstockhistid' => 'ID',
			'productstockid'=>'Product Stock',
			'productid' => 'Material',
			'unitofmeasureid' => 'Unit of Measure',
			'qty' => 'Quantity',
			'slocid'=>'Sloc',
			'referenceno'=>'Reference No'
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
		$criteria->with=array('product','unitofmeasure','sloc','productstock');
if (isset($_GET['Productstockhist'])) {

$model=new Productstockhist('search');
$criteria->condition='t.productstockid='.$_GET['Productstockhist']['productstockid'];
} else {
$criteria->condition='t.productstockid=0';
}
$criteria->compare('t.productid',$this->productid,true);
$criteria->compare('t.productstockid',$this->productstockid,true);
$criteria->compare('qty',$this->qty,true);
$criteria->compare('t.slocid',$this->slocid,true);
$criteria->compare('t.unitofmeasureid',$this->unitofmeasureid,true);
		return new CActiveDataProvider(get_class($this), array(
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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
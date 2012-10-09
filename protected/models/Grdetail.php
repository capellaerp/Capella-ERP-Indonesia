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
class Grdetail extends CActiveRecord
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
		return 'grdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grheaderid, productid, unitofmeasureid, qty', 'required'),
			array('grheaderid, productid, unitofmeasureid, podetailid', 'numerical', 'integerOnly'=>true),
			array('qty', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('grheaderid, productid, unitofmeasureid, qty', 'safe', 'on'=>'search'),
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
			'grheader' => array(self::BELONGS_TO, 'Grheader', 'grheaderid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
			'podetail' => array(self::BELONGS_TO, 'Podetail', 'podetailid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grdetailid' => 'ID',
			'grheaderid' => 'Header',
			'productid' => 'Material',
			'unitofmeasureid' => 'Unit of Measure',
			'qty' => 'Quantity',
			'slocid'=> 'Storage Location'
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
		$criteria->with=array('product','unitofmeasure','grheader','sloc');
		if (isset($_GET['Grdetail'])) {
$model=new Grdetail('search');
$model->attributes = $_GET['Grdetail'];
$criteria->condition='t.grheaderid='.$model->grheaderid;
} else {
$criteria->condition='t.grheaderid=0';
}
		$criteria->compare('grdetailid',$this->grdetailid);
		$criteria->compare('grheader.grheaderid',$this->grheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('sloc.sloccode',$this->slocid,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
    
    public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('product','unitofmeasure','grheader','sloc');
$criteria->condition="grheader.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listgr') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('grdetailid',$this->grdetailid);
		$criteria->compare('grheader.grheaderid',$this->grheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('sloc.sloccode',$this->slocid,true);

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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
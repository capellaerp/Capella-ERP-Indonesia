<?php

/**
 * This is the model class for table "prmaterial".
 *
 * The followings are the available columns in table 'prmaterial':
 * @property integer $prmaterialid
 * @property integer $prheaderid
 * @property integer $productid
 * @property double $qty
 * @property integer $unitofmeasureid
 * @property integer $requestedbyid
 * @property string $reqdate
 * @property string $itemtext
 *
 * The followings are the available model relations:
 * @property Requestedby $requestedby
 * @property Prheader $prheader
 * @property Product $product
 * @property Unitofmeasure $unitofmeasure
 */
class Prmaterial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Prmaterial the static model class
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
		return 'prmaterial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prheaderid, productid, qty, unitofmeasureid, reqdate', 'required'),
			array('prheaderid, productid, unitofmeasureid, requestedbyid', 'numerical', 'integerOnly'=>true),
			array('qty', 'numerical'),
			array('itemtext,reqdate', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prmaterialid, prheaderid, productid, qty, unitofmeasureid, requestedbyid, reqdate, itemtext', 'safe', 'on'=>'search'),
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
			'requestedby' => array(self::BELONGS_TO, 'Requestedby', 'requestedbyid'),
			'prheader' => array(self::BELONGS_TO, 'Prheader', 'prheaderid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prmaterialid' => 'ID',
			'prheaderid' => 'Pr Header',
			'productid' => 'Product',
			'qty' => 'Qty',
			'unitofmeasureid' => 'UOM',
			'requestedbyid' => 'Requested By',
			'reqdate' => 'Estimated Time Arrival (ETA)',
			'itemtext' => 'Item Text',
            'poqty' => 'PO Qty'
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
		$criteria->with=array('prheader','requestedby','product','unitofmeasure');
                if (isset($_GET['Prmaterial'])) {
$model=new Prmaterial('search');
$model->attributes = $_GET['Prmaterial'];
$criteria->condition='t.prheaderid='.$model->prheaderid;
} else {
$criteria->condition='t.prheaderid=0';
}
		$criteria->compare('prmaterialid',$this->prmaterialid);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('requestedby.requestedbycode',$this->requestedbyid,true);
		$criteria->compare('reqdate',$this->reqdate,true);
		$criteria->compare('itemtext',$this->itemtext,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

            public function beforeSave()
    {
      $this->reqdate = date(Yii::app()->params['datetodb'], strtotime($this->reqdate));
      return parent::beforeSave();
    }

        public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('prheader');
$criteria->condition="prheader.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listpr') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('prmaterialid',$this->prmaterialid);
		$criteria->compare('prheader.prno',$this->prheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('requestedby.requestedbycode',$this->requestedbyid,true);
		$criteria->compare('reqdate',$this->reqdate,true);
		$criteria->compare('itemtext',$this->itemtext,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

        public function searchwfqtystatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('prheader');
$criteria->condition="prheader.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listpr') and upper(e.username)=upper('".Yii::app()->user->name."') 
and t.qty > t.poqty and prheader.prno is not null)";
		$criteria->compare('prmaterialid',$this->prmaterialid);
		$criteria->compare('prheader.prno',$this->prheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('requestedby.requestedbycode',$this->requestedbyid,true);
		$criteria->compare('reqdate',$this->reqdate,true);
		$criteria->compare('itemtext',$this->itemtext,true);

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
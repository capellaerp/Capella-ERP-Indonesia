<?php

/**
 * This is the model class for table "podetail".
 *
 * The followings are the available columns in table 'podetail':
 * @property integer $podetailid
 * @property integer $poheaderid
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
 * @property Poheader $poheader
 * @property Product $product
 * @property Unitofmeasure $unitofmeasure
 * @property Currency $currency
 * @property Sloc $sloc
 * @property Tax $tax
 */
class Podetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Podetail the static model class
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
		return 'podetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poheaderid, productid, unitofmeasureid, currencyid, slocid, taxid, prdetailid', 'numerical', 'integerOnly'=>true),
			array('poqty, netprice,ratevalue,underdelvtol, overdelvtol', 'length'),
			array('itemtext,delvdate', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('podetailid, poheaderid, productid, poqty, unitofmeasureid, delvdate, netprice, currencyid, slocid, taxid,itemtext', 'safe', 'on'=>'search'),
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
			'poheader' => array(self::BELONGS_TO, 'Poheader', 'poheaderid'),
			'product' => array(self::BELONGS_TO, 'Product', 'productid'),
			'unitofmeasure' => array(self::BELONGS_TO, 'Unitofmeasure', 'unitofmeasureid'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currencyid'),
			'sloc' => array(self::BELONGS_TO, 'Sloc', 'slocid'),
			'tax' => array(self::BELONGS_TO, 'Tax', 'taxid'),
			'prdetail' => array(self::BELONGS_TO, 'Prmaterial', 'prdetailid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'podetailid' => 'ID',
			'poheaderid' => 'Header',
			'productid' => 'Product',
			'poqty' => 'Qty',
			'unitofmeasureid' => 'UOM',
			'delvdate' => 'Delivery Date',
			'netprice' => 'Price',
			'currencyid' => 'Currency',
			'slocid' => 'Sloc',
			'taxid' => 'Tax',
			'itemtext' => 'Item Text',
                        'prdetailid' => 'Pr Material',
                    'underdelvtol' => 'Under Delivery Tolerance',
                    'overdelvtol' => 'Over Delivery Tolerance',
            'qtyres'=>'GR Qty',
			'ratevalue'=>'Rate Value'
		);
	}
	
	public function getTotals()
	{
		$total=0;
		$connection=Yii::app()->db;
			  try
			  {
				$sql = 'select sum(ifnull(netprice,0) * ifnull(poqty,0) * ifnull(ratevalue,0)) as total from podetail where poheaderid = '.$this->poheaderid;
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
		$criteria->with=array('poheader','tax','currency','product','unitofmeasure','sloc','prdetail');
                if (isset($_GET['Podetail'])) {
$model=new Podetail('search');
$model->attributes = $_GET['Podetail'];
$criteria->condition='t.poheaderid='.$model->poheaderid;
} else {
$criteria->condition='t.poheaderid=0';
}
		$criteria->compare('podetailid',$this->podetailid);
		$criteria->compare('poheader.poheaderid',$this->poheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('poqty',$this->poqty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('delvdate',$this->delvdate,true);
		$criteria->compare('netprice',$this->netprice);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('sloc.sloccode',$this->slocid,true);
		$criteria->compare('tax.taxcode',$this->taxid,true);
		$criteria->compare('itemtext',$this->itemtext,true);
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
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
where upper(a.wfname) = upper('listpo') and upper(e.username)=upper('".Yii::app()->user->name."') and t.qty > t.qtyres and poheader.pono is not null)";
		$criteria->compare('podetailid',$this->podetailid);
		$criteria->compare('poheader.poheaderid',$this->poheaderid,true);
		$criteria->compare('product.productname',$this->productid,true);
		$criteria->compare('poqty',$this->poqty);
		$criteria->compare('unitofmeasure.uomcode',$this->unitofmeasureid,true);
		$criteria->compare('delvdate',$this->delvdate,true);
		$criteria->compare('netprice',$this->netprice);
		$criteria->compare('currency.currencyname',$this->currencyid,true);
		$criteria->compare('sloc.sloccode',$this->slocid,true);
		$criteria->compare('tax.taxcode',$this->taxid,true);
		$criteria->compare('itemtext',$this->itemtext,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$this->netprice = str_replace(",","",$this->netprice);
		$this->ratevalue = str_replace(",","",$this->ratevalue);
		$this->poqty = str_replace(",","",$this->poqty);
        $this->delvdate = date(Yii::app()->params['datetodb'], strtotime($this->delvdate));
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
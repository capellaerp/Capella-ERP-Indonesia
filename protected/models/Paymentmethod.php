<?php

/**
 * This is the model class for table "paymentmethod".
 *
 * The followings are the available columns in table 'paymentmethod':
 * @property integer $paymentmethodid
 * @property string $paycode
 * @property string $paymentname
 * @property integer $recordstatus
 */
class Paymentmethod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Paymentmethod the static model class
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
		return 'paymentmethod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recordstatus,paycode,paydays,paymentname', 'required'),
			array('recordstatus,paydays', 'numerical', 'integerOnly'=>true),
			array('paycode', 'length', 'max'=>5),
			array('paymentname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('paymentmethodid, paycode, paymentname, paydays,recordstatus', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paymentmethodid' => 'ID',
			'paycode' => 'Paycode',
			'paymentname' => 'Payment ',
			'paydays' => 'Payment Days',
			'recordstatus' => 'Record Status',
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

		$criteria->compare('paymentmethodid',$this->paymentmethodid);
		$criteria->compare('paycode',$this->paycode,true);
		$criteria->compare('paymentname',$this->paymentname,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

  /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
    $criteria->condition='recordstatus=1';
		$criteria->compare('paymentmethodid',$this->paymentmethodid);
		$criteria->compare('paycode',$this->paycode,true);
		$criteria->compare('paymentname',$this->paymentname,true);

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
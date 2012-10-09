<?php

/**
 * This is the model class for table "employeeinsurance".
 *
 * The followings are the available columns in table 'employeeinsurance':
 * @property integer $employeeinsuranceid
 * @property integer $employeeid
 * @property integer $insuranceid
 * @property string $insuranceno
 * @property integer $recordstatus
 */
class Employeeinsurance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeeinsurance the static model class
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
		return 'employeeinsurance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, insuranceid, insuranceno, recordstatus', 'required'),
			array('employeeid, insuranceid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('insuranceno', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeeinsuranceid, employeeid, insuranceid, insuranceno, recordstatus', 'safe', 'on'=>'search'),
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
			'employee' => array(self::BELONGS_TO, 'Employee', 'employeeid'),
			'insurance' => array(self::BELONGS_TO, 'Insurance', 'insuranceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeeinsuranceid' => 'ID',
			'employeeid' => 'Employee',
			'insuranceid' => 'Insurance',
			'insuranceno' => 'Insurance Card No',
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
    $criteria->with=array('employee','insurance','employee.addressbook');
		$criteria->compare('employeeinsuranceid',$this->employeeinsuranceid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('insurance.fullname',$this->insuranceid,true);
		$criteria->compare('insuranceno',$this->insuranceno,true);
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
    $criteria->with=array('employee','insurance');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('employeeinsuranceid',$this->employeeinsuranceid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('insurance.addressbook.fullname',$this->insuranceid,true);
		$criteria->compare('insuranceno',$this->insuranceno,true);

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
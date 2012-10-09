<?php

/**
 * This is the model class for table "absschedule".
 *
 * The followings are the available columns in table 'absschedule':
 * @property integer $absscheduleid
 * @property string $absschedulename
 * @property string $absin
 * @property string $absout
 * @property string $status
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Abstrans[] $abstrans
 * @property Employeeschedule[] $employeeschedules
 */
class Absschedule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Absschedule the static model class
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
		return 'absschedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('absschedulename, absin, absout, absstatusid, recordstatus', 'required'),
			array('absstatusid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('absschedulename', 'length', 'max'=>50),
			array('absin, absout', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('absscheduleid, absschedulename, absin, absout, absstatusid, recordstatus', 'safe', 'on'=>'search'),
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
			'abstrans' => array(self::HAS_MANY, 'Abstrans', 'absscheduleid'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd1'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd2'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd3'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd4'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd5'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd6'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd7'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd8'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd9'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd10'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd11'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd12'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd13'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd14'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd15'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd16'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd17'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd18'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd19'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd20'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd21'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd22'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd23'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd24'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd25'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd26'),
      'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd27'),
			'employeeschedules' => array(self::HAS_MANY, 'Employeeschedule', 'd28'),
      'absrule' => array(self::HAS_MANY, 'Absrule', 'absscheduleid'),
      'absstatus' => array(self::BELONGS_TO, 'Absstatus', 'absstatusid'),
		);
	}

	/**
   *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'absscheduleid' => 'ID',
			'absschedulename' => 'Schedule',
			'absin' => 'Absence In',
			'absout' => 'Absence Out',
			'absstatusid' => 'Status',
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
    $criteria->with=array('absstatus');
		$criteria->compare('t.absscheduleid',$this->absscheduleid);
		$criteria->compare('t.absschedulename',$this->absschedulename,true);
		$criteria->compare('t.absin',$this->absin,true);
		$criteria->compare('t.absout',$this->absout,true);
		$criteria->compare('absstatus.shortstat',$this->absstatusid,true);

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
    $criteria->condition='t.recordstatus=1';
    $criteria->with=array('absstatus');
		$criteria->compare('t.absscheduleid',$this->absscheduleid);
		$criteria->compare('t.absschedulename',$this->absschedulename,true);
		$criteria->compare('t.absin',$this->absin,true);
		$criteria->compare('t.absout',$this->absout,true);
		$criteria->compare('absstatus.shortstat',$this->absstatusid,true);

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
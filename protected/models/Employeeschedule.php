<?php

/**
 * This is the model class for table "employeeschedule".
 *
 * The followings are the available columns in table 'employeeschedule':
 * @property integer $employeescheduleid
 * @property integer $employeeid
 * @property string $fullname
 * @property string $oldnik
 * @property string $newnik
 * @property string $fulldivision
 * @property integer $month
 * @property integer $year
 * @property integer $d1
 * @property integer $d2
 * @property integer $d3
 * @property integer $d4
 * @property integer $d5
 * @property integer $d6
 * @property integer $d7
 * @property integer $d8
 * @property integer $d9
 * @property integer $d10
 * @property integer $d11
 * @property integer $d12
 * @property integer $d13
 * @property integer $d14
 * @property integer $d15
 * @property integer $d16
 * @property integer $d17
 * @property integer $d18
 * @property integer $d19
 * @property integer $d20
 * @property integer $d21
 * @property integer $d22
 * @property integer $d23
 * @property integer $d24
 * @property integer $d25
 * @property integer $d26
 * @property integer $d27
 * @property integer $d28
 * @property integer $d29
 * @property integer $d30
 * @property integer $d31
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Absschedule $d110
 * @property Absschedule $d100
 * @property Absschedule $d120
 * @property Absschedule $d130
 * @property Absschedule $d140
 * @property Absschedule $d150
 * @property Absschedule $d160
 * @property Absschedule $d170
 * @property Absschedule $d180
 * @property Absschedule $d190
 * @property Absschedule $d210
 * @property Absschedule $d200
 * @property Absschedule $d220
 * @property Absschedule $d230
 * @property Absschedule $d240
 * @property Absschedule $d250
 * @property Absschedule $d260
 * @property Absschedule $d270
 * @property Absschedule $d280
 * @property Absschedule $d32
 * @property Absschedule $d300
 * @property Absschedule $d310
 * @property Absschedule $d40
 * @property Absschedule $d50
 * @property Absschedule $d60
 * @property Absschedule $d70
 * @property Absschedule $d80
 * @property Absschedule $d90
 * @property Employee $employee
 * @property Absschedule $d290
 */
class Employeeschedule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeeschedule the static model class
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
		return 'employeeschedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, month, year', 'required'),
			array('employeeid, month, year, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeescheduleid, employeeid, month, year, recordstatus', 'safe', 'on'=>'search'),
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
			'd100' => array(self::BELONGS_TO, 'Absschedule', 'd1'),
			'd200' => array(self::BELONGS_TO, 'Absschedule', 'd2'),
			'd300' => array(self::BELONGS_TO, 'Absschedule', 'd3'),
			'd400' => array(self::BELONGS_TO, 'Absschedule', 'd4'),
			'd500' => array(self::BELONGS_TO, 'Absschedule', 'd5'),
			'd600' => array(self::BELONGS_TO, 'Absschedule', 'd6'),
			'd700' => array(self::BELONGS_TO, 'Absschedule', 'd7'),
			'd800' => array(self::BELONGS_TO, 'Absschedule', 'd8'),
			'd900' => array(self::BELONGS_TO, 'Absschedule', 'd9'),
			'd1000' => array(self::BELONGS_TO, 'Absschedule', 'd10'),
			'd1100' => array(self::BELONGS_TO, 'Absschedule', 'd11'),
			'd1200' => array(self::BELONGS_TO, 'Absschedule', 'd12'),
			'd1300' => array(self::BELONGS_TO, 'Absschedule', 'd13'),
			'd1400' => array(self::BELONGS_TO, 'Absschedule', 'd14'),
			'd1500' => array(self::BELONGS_TO, 'Absschedule', 'd15'),
			'd1600' => array(self::BELONGS_TO, 'Absschedule', 'd16'),
			'd1700' => array(self::BELONGS_TO, 'Absschedule', 'd17'),
			'd1800' => array(self::BELONGS_TO, 'Absschedule', 'd18'),
			'd1900' => array(self::BELONGS_TO, 'Absschedule', 'd19'),
			'd2100' => array(self::BELONGS_TO, 'Absschedule', 'd21'),
			'd2000' => array(self::BELONGS_TO, 'Absschedule', 'd20'),
			'd2200' => array(self::BELONGS_TO, 'Absschedule', 'd22'),
			'd2300' => array(self::BELONGS_TO, 'Absschedule', 'd23'),
			'd2400' => array(self::BELONGS_TO, 'Absschedule', 'd24'),
			'd2500' => array(self::BELONGS_TO, 'Absschedule', 'd25'),
			'd2600' => array(self::BELONGS_TO, 'Absschedule', 'd26'),
			'd2700' => array(self::BELONGS_TO, 'Absschedule', 'd27'),
			'd2800' => array(self::BELONGS_TO, 'Absschedule', 'd28'),
			'd2900' => array(self::BELONGS_TO, 'Absschedule', 'd29'),
			'd3000' => array(self::BELONGS_TO, 'Absschedule', 'd30'),
			'd3100' => array(self::BELONGS_TO, 'Absschedule', 'd31'),
			'employee' => array(self::BELONGS_TO, 'Employee', 'employeeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeescheduleid' => 'ID',
			'employeeid' => 'Employee',
			'month' => 'Month',
			'year' => 'Year',
			'd1' => '1',
			'd2' => '2',
			'd3' => '3',
			'd4' => '4',
			'd5' => '5',
			'd6' => '6',
			'd7' => '7',
			'd8' => '8',
			'd9' => '9',
			'd10' => '10',
			'd11' => '11',
			'd12' => '12',
			'd13' => '13',
			'd14' => '14',
			'd15' => '15',
			'd16' => '16',
			'd17' => '17',
			'd18' => '18',
			'd19' => '19',
			'd20' => '20',
			'd21' => '21',
			'd22' => '22',
			'd23' => '23',
			'd24' => '24',
			'd25' => '25',
			'd26' => '26',
			'd27' => '27',
			'd28' => '28',
			'd29' => '29',
			'd30' => '30',
			'd31' => '31',
			'recordstatus' => 'Record Status',
		);
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
        $criteria->with=array('d100','d200','d300','d400','d500','d600','d700',
            'd800','d900','d1000','d1100','d1200','d1300','d1400','d1500',
            'd1600','d1700','d1800','d1900','d2000','d2100','d2200','d2300',
            'd2400','d2500','d2600','d2700','d2800','d2900','d3000','d3100','employee');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listempsched') and upper(e.username)=upper('".Yii::app()->user->name."'))";    
		$criteria->compare('employeescheduleid',$this->employeescheduleid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('year',$this->year,true);

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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('d100','d200','d300','d400','d500','d600','d700',
            'd800','d900','d1000','d1100','d1200','d1300','d1400','d1500',
            'd1600','d1700','d1800','d1900','d2000','d2100','d2200','d2300',
            'd2400','d2500','d2600','d2700','d2800','d2900','d3000','d3100','employee');
		$criteria->compare('employeescheduleid',$this->employeescheduleid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year);
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
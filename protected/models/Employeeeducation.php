<?php

/**
 * This is the model class for table "employeeeducation".
 *
 * The followings are the available columns in table 'employeeeducation':
 * @property integer $employeeeducationid
 * @property integer $employeeid
 * @property integer $educationid
 * @property string $schoolname
 * @property integer $cityid
 * @property integer $yeargraduate
 * @property integer $isdiploma
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Education $education
 * @property Employee $employee
 */
class Employeeeducation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeeeducation the static model class
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
		return 'employeeeducation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, educationid, schoolname, cityid, yeargraduate, isdiploma, recordstatus', 'required'),
			array('employeeid, educationid, cityid, yeargraduate, isdiploma, recordstatus', 'numerical', 'integerOnly'=>true),
			array('schoolname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeeeducationid, employeeid, educationid, schoolname, cityid, yeargraduate, isdiploma, recordstatus', 'safe', 'on'=>'search'),
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
			'city' => array(self::BELONGS_TO, 'City', 'cityid'),
			'education' => array(self::BELONGS_TO, 'Education', 'educationid'),
			'employee' => array(self::BELONGS_TO, 'Employee', 'employeeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeeeducationid' => 'ID',
			'employeeid' => 'Employee',
			'educationid' => 'Degree',
			'schoolname' => 'School / Institut',
			'cityid' => 'City',
            'schooldegree'=>'Major',
			'yeargraduate' => 'Year Graduate',
			'isdiploma' => 'Is Certificate',
			'recordstatus' => 'Status',
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
    $criteria->with=array('employee','city','education');
	if (isset($_GET['Employeeeducation'])) {
			$criteria->condition='t.employeeid ='.$_GET['Employeeeducation']['employeeid'];
		} else {
			$criteria->condition='t.employeeid=0';
		}
		$criteria->compare('employeeeducationid',$this->employeeeducationid);
		$criteria->compare('t.employeeid',$this->employeeid,true);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('schoolname',$this->schoolname,true);
		$criteria->compare('city.cityname',$this->cityid,true);
		$criteria->compare('yeargraduate',$this->yeargraduate);
		$criteria->compare('isdiploma',$this->isdiploma);
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
    $criteria->condition='t.recordstatus=1';
    $criteria->with=array('employee','city','education');
		$criteria->compare('employeeeducationid',$this->employeeeducationid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('schoolname',$this->schoolname,true);
		$criteria->compare('city.cityname',$this->cityid,true);
		$criteria->compare('yeargraduate',$this->yeargraduate);
		$criteria->compare('isdiploma',$this->isdiploma);

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
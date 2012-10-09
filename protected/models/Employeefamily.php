<?php

/**
 * This is the model class for table "employeefamily".
 *
 * The followings are the available columns in table 'employeefamily':
 * @property integer $employeefamilyid
 * @property integer $employeeid
 * @property integer $familyrelationid
 * @property string $familyname
 * @property integer $sexid
 * @property integer $cityid
 * @property string $birthdate
 * @property integer $educationid
 * @property integer $occupationid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Education $education
 * @property Employee $employee
 * @property Familyrelation $familyrelation
 * @property Occupation $occupation
 * @property Sex $sex
 */
class Employeefamily extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeefamily the static model class
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
		return 'employeefamily';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, familyrelationid, familyname, recordstatus', 'required'),
			array('employeeid, familyrelationid, sexid, cityid, educationid, occupationid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('familyname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeefamilyid, employeeid, familyrelationid, familyname, sexid, cityid, birthdate, educationid, occupationid, recordstatus', 'safe', 'on'=>'search'),
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
			'familyrelation' => array(self::BELONGS_TO, 'Familyrelation', 'familyrelationid'),
			'occupation' => array(self::BELONGS_TO, 'Occupation', 'occupationid'),
			'sex' => array(self::BELONGS_TO, 'Sex', 'sexid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeefamilyid' => 'ID',
			'employeeid' => 'Employee ',
			'familyrelationid' => 'Family Relation',
			'familyname' => 'Name of Family',
			'sexid' => 'Sex',
			'cityid' => 'City of Birth',
			'birthdate' => 'Birthdate',
			'educationid' => 'Education',
			'occupationid' => 'Occupation',
			'recordstatus' => 'Record Status',
		);
	}
  
  public function beforeSave()
    {
      $this->birthdate = date(Yii::app()->params['datetodb'], strtotime($this->birthdate));
      return parent::beforeSave();
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
		$criteria->with=array('employee','familyrelation','sex','city','education',
      'occupation');	
	  if (isset($_GET['Employeefamily'])) {
			$criteria->condition='t.employeeid ='.$_GET['Employeefamily']['employeeid'];
		} else {
			$criteria->condition='t.employeeid=0';
		}
		$criteria->compare('employeefamilyid',$this->employeefamilyid);
		$criteria->compare('t.employeeid',$this->employeeid,true);
		$criteria->compare('familyrelation.familyrelationname',$this->familyrelationid,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('sex.sexname',$this->sexid,true);
		$criteria->compare('city.cityname',$this->cityid,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('occupation.occupationname',$this->occupationid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),			'criteria'=>$criteria,
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
    $criteria->with=array('employee','familyrelation','sex','city','education',
      'occupation');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('employeefamilyid',$this->employeefamilyid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('familyrelation.familyrelationname',$this->familyrelationid,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('sex.sexname',$this->sexid,true);
		$criteria->compare('city.cityname',$this->cityid,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('occupation.occupationname',$this->occupationid,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),			'criteria'=>$criteria,
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
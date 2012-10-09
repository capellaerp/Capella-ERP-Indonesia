<?php

/**
 * This is the model class for table "employeeidentity".
 *
 * The followings are the available columns in table 'employeeidentity':
 * @property integer $employeeidentityid
 * @property integer $employeeid
 * @property integer $identitytypeid
 * @property string $identityname
 * @property integer $recordstatus
 */
class Employeeidentity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeeidentity the static model class
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
		return 'employeeidentity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, identitytypeid, identityname, recordstatus', 'required'),
			array('employeeid, identitytypeid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('identityname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeeidentityid, employeeid, identitytypeid, identityname, recordstatus', 'safe', 'on'=>'search'),
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
      'identitytype' => array(self::BELONGS_TO, 'Identitytype', 'identitytypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeeidentityid' => 'ID',
			'employeeid' => 'Employee',
			'identitytypeid' => 'Identity Type',
			'identityname' => 'Identity Number',
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
    $criteria->with=array('employee','identitytype','employee.addressbook');
			$criteria->compare('employeeidentityid',$this->employeeidentityid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('identitytype.identitytypename',$this->identitytypeid,true);
		$criteria->compare('identityname',$this->identityname,true);
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
    $criteria->with=array('employee','identitytype');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('employeeidentityid',$this->employeeidentityid);
		$criteria->compare('employee.employeeid',$this->employeeid,true);
		$criteria->compare('identitytype.identitytypename',$this->identitytypeid,true);
		$criteria->compare('identityname',$this->identityname,true);

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
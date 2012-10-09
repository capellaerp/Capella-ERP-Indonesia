<?php

/**
 * This is the model class for table "employeetype".
 *
 * The followings are the available columns in table 'employeetype':
 * @property integer $employeetypeid
 * @property string $employeetypename
 * @property integer $snroid
 * @property integer $sicksnroid
 * @property integer $sickstatusid
 * @property integer $recordstatus
 */
class Employeetype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeetype the static model class
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
		return 'employeetype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeetypename, recordstatus', 'required'),
			array('snroid, sicksnroid, sickstatusid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('employeetypename', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeetypeid, employeetypename, snroid, sicksnroid, sickstatusid, recordstatus', 'safe', 'on'=>'search'),
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
       'snro' => array(self::BELONGS_TO, 'Snro', 'snroid'),
       'sicksnro' => array(self::BELONGS_TO, 'Snro', 'sicksnroid'),
       'sickstatus' => array(self::BELONGS_TO, 'Absstatus', 'sickstatusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeetypeid' => 'Employee Type',
			'employeetypename' => 'Employee Type ',
			'snroid' => 'Snro',
			'sicksnroid' => 'Sick Snro',
			'sickstatusid' => 'Sick Status',
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
    $criteria->with=array('snro','sicksnro','sickstatus');
		$criteria->compare('employeetypeid',$this->employeetypeid);
		$criteria->compare('employeetypename',$this->employeetypename,true);
		$criteria->compare('snro.description',$this->snroid,true);
		$criteria->compare('sicksnro.description',$this->sicksnroid,true);
		$criteria->compare('sickstatus.shortstat',$this->sickstatusid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);

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
    $criteria->with=array('snro','sicksnro','sickstatus');
		$criteria->compare('employeetypeid',$this->employeetypeid);
		$criteria->compare('employeetypename',$this->employeetypename,true);
		$criteria->compare('snro.description',$this->snroid,true);
		$criteria->compare('sicksnro.description',$this->sicksnroid,true);
		$criteria->compare('sickstatus.shortstat',$this->sickstatusid,true);

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
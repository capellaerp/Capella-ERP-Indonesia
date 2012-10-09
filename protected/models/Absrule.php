<?php

/**
 * This is the model class for table "absrule".
 *
 * The followings are the available columns in table 'absrule':
 * @property integer $absruleid
 * @property integer $absscheduleid
 * @property string $difftimein
 * @property string $difftimeout
 * @property integer $absstatusid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Absschedule $absschedule
 */
class Absrule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Absrule the static model class
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
		return 'absrule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('absscheduleid, difftimein, difftimeout, absstatusid, recordstatus', 'required'),
			array('absscheduleid, absstatusid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('difftimein, difftimeout', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('absscheduleid, difftimein, difftimeout, absstatusid, recordstatus', 'safe', 'on'=>'search'),
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
			'absschedule' => array(self::BELONGS_TO, 'Absschedule', 'absscheduleid'),
      'absstatus' => array(self::BELONGS_TO, 'Absstatus', 'absstatusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'absruleid' => 'ID',
			'absscheduleid' => 'Schedule',
			'difftimein' => 'Time In',
			'difftimeout' => 'Time Out',
			'absstatusid' => 'Absence Status',
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
		$criteria->with=array('absschedule','absstatus');
		$criteria->compare('absschedule.absschedulename',$this->absscheduleid);
		$criteria->compare('t.difftimein',$this->difftimein,true);
		$criteria->compare('t.difftimeout',$this->difftimeout,true);
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
    $criteria->with=array('absschedule','absstatus');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('absschedule.absschedulename',$this->absscheduleid);
		$criteria->compare('t.difftimein',$this->difftimein,true);
		$criteria->compare('t.difftimeout',$this->difftimeout,true);
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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}

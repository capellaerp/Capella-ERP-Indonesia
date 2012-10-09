<?php

/**
 * This is the model class for table "employeeforeignlanguage".
 *
 * The followings are the available columns in table 'employeeforeignlanguage':
 * @property integer $employeeforeignlanguageid
 * @property integer $employeeid
 * @property integer $languageid
 * @property integer $languagevalueid
 * @property integer $recordstatus
 */
class Employeeforeignlanguage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employeeforeignlanguage the static model class
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
		return 'employeeforeignlanguage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeid, languageid, languagevalueid, recordstatus', 'required'),
			array('employeeid, languageid, languagevalueid, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employeeforeignlanguageid, employeeid, languageid, languagevalueid, recordstatus', 'safe', 'on'=>'search'),
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
      'language' => array(self::BELONGS_TO, 'Language', 'languageid'),
      'languagevalue' => array(self::BELONGS_TO, 'Languagevalue', 'languagevalueid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employeeforeignlanguageid' => 'ID',
			'employeeid' => 'Employee',
			'languageid' => 'Language',
			'languagevalueid' => 'Language Value',
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
    $criteria->with=array('employee','language','languagevalue','employee.addressbook');
	$criteria->compare('employeeforeignlanguageid',$this->employeeforeignlanguageid);
		$criteria->compare('t.employeeid',$this->employeeid,true);
		$criteria->compare('language.languagename',$this->languageid,true);
		$criteria->compare('languagevalue.languagevaluename',$this->languagevalueid,true);
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
    $criteria->with=array('employee','language','languagevalue');
		$criteria->compare('employeeforeignlanguageid',$this->employeeforeignlanguageid);
		$criteria->compare('employee.fullname',$this->employeeid,true);
		$criteria->compare('language.languagename',$this->languageid,true);
		$criteria->compare('languagevalue.languagevaluename',$this->languagevalueid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

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
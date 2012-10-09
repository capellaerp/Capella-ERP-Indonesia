<?php

/**
 * This is the model class for table "absstatus".
 *
 * The followings are the available columns in table 'absstatus':
 * @property integer $absstatusid
 * @property string $shortstat
 * @property string $longstat
 * @property integer $isin
 * @property integer $priority
 * @property integer $recordstatus
 */
class Absstatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Absstatus the static model class
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
		return 'absstatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shortstat, longstat, isin, priority, recordstatus', 'required'),
			array('isin, priority, recordstatus', 'numerical', 'integerOnly'=>true),
			array('shortstat', 'length', 'max'=>5),
			array('longstat', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('absstatusid, shortstat, longstat, isin, priority, recordstatus', 'safe', 'on'=>'search'),
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
      'absrule' => array(self::HAS_MANY, 'Absrule', 'absstatusid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'absstatusid' => 'ID',
			'shortstat' => 'Short Status',
			'longstat' => 'Long Status',
			'isin' => 'Is In ?',
			'priority' => 'Priority',
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
		$criteria->compare('absstatusid',$this->absstatusid);
		$criteria->compare('shortstat',$this->shortstat,true);
		$criteria->compare('longstat',$this->longstat,true);
		$criteria->compare('isin',$this->isin);
		$criteria->compare('priority',$this->priority);

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
		$criteria->compare('absstatusid',$this->absstatusid);
		$criteria->compare('shortstat',$this->shortstat,true);
		$criteria->compare('longstat',$this->longstat,true);
		$criteria->compare('isin',$this->isin);
		$criteria->compare('priority',$this->priority);

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
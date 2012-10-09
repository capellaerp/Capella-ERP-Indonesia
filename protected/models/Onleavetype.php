<?php

/**
 * This is the model class for table "onleavetype".
 *
 * The followings are the available columns in table 'onleavetype':
 * @property integer $onleavetypeid
 * @property string $onleavename
 * @property integer $cutimax
 * @property integer $cutistart
 * @property integer $snroid
 * @property integer $abstatusid
 * @property integer $recordstatus
 */
class Onleavetype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Onleavetype the static model class
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
		return 'onleavetype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('onleavename, cutimax, cutistart, snroid, absstatusid, recordstatus', 'required'),
			array('cutimax, cutistart, snroid, absstatusid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('onleavename', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('onleavetypeid, onleavename, cutimax, cutistart, snroid, absstatusid, recordstatus', 'safe', 'on'=>'search'),
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
      'absstatus' => array(self::BELONGS_TO, 'Absstatus', 'absstatusid'),
      'snro' => array(self::BELONGS_TO, 'Snro', 'snroid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'onleavetypeid' => 'ID',
			'onleavename' => 'Onleave ',
			'cutimax' => 'Day Max',
			'cutistart' => 'Start Day',
			'snroid' => 'Snro',
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
		$criteria->with=array('snro','absstatus');
		$criteria->compare('onleavetypeid',$this->onleavetypeid);
		$criteria->compare('onleavename',$this->onleavename,true);
		$criteria->compare('cutimax',$this->cutimax);
		$criteria->compare('cutistart',$this->cutistart);
		$criteria->compare('snro.description',$this->snroid,true);
		$criteria->compare('abstatus.shortstat',$this->absstatusid,true);
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
		$criteria->with=array('snro','absstatus');
		$criteria->condition='t.recordstatus=1';
		$criteria->compare('onleavetypeid',$this->onleavetypeid);
		$criteria->compare('onleavename',$this->onleavename,true);
		$criteria->compare('cutimax',$this->cutimax);
		$criteria->compare('cutistart',$this->cutistart);
		$criteria->compare('snro.description',$this->snroid,true);
		$criteria->compare('abstatus.shortstat',$this->absstatusid,true);
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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
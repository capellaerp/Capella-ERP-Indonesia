<?php

/**
 * This is the model class for table "accounttype".
 *
 * The followings are the available columns in table 'accounttype':
 * @property string $accounttypeid
 * @property string $accounttypename
 * @property integer $recordstatus
 */
class Accounttype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Accounttype the static model class
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
		return 'accounttype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('accounttypename, recordstatus', 'required'),
			array('recordstatus,parentaccounttypeid', 'numerical', 'integerOnly'=>true),
			array('accounttypename', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('accounttypeid, accounttypename, recordstatus', 'safe', 'on'=>'search'),
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
      'parentaccounttype' => array(self::BELONGS_TO, 'Accounttype', 'parentaccounttypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'accounttypeid' => 'ID',
			'accounttypename' => 'Description',
			'recordstatus' => 'Record Status',
            'parentaccounttypeid'=>'Parent'
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
$criteria->with=array('parentaccounttype');
		$criteria->compare('t.accounttypeid',$this->accounttypeid,true);
		$criteria->compare('t.accounttypename',$this->accounttypename,true);
		$criteria->compare('parentaccounttype.accounttypename',$this->parentaccounttypeid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);

		return new CActiveDataProvider($this, array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),			'criteria'=>$criteria,
		));
	}

    public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->with=array('parentaccounttype');
$criteria->condition='t.recordstatus=1';
		$criteria->compare('t.accounttypeid',$this->accounttypeid,true);
		$criteria->compare('t.accounttypename',$this->accounttypename,true);
		$criteria->compare('parentaccounttype.accounttypename',$this->parentaccounttypeid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);

		return new CActiveDataProvider($this, array(
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
            'application.behaviors.ActiveRecordLogableBehavior'
    );
  }
}
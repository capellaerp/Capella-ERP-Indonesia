<?php

/**
 * This is the model class for table "usergroup".
 *
 * The followings are the available columns in table 'usergroup':
 * @property integer $usergroupid
 * @property integer $useraccessid
 * @property integer $groupaccessid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Useraccess $useraccess
 * @property Groupaccess $groupaccess
 */
class Usergroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usergroup the static model class
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
		return 'usergroup';
	}
	
	public $realname;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('useraccessid, groupaccessid, recordstatus', 'required'),
			array('useraccessid, groupaccessid, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('usergroupid, useraccessid, groupaccessid, recordstatus, realname', 'safe', 'on'=>'search'),
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
			'useraccess' => array(self::BELONGS_TO, 'Useraccess', 'useraccessid'),
			'groupaccess' => array(self::BELONGS_TO, 'Groupaccess', 'groupaccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usergroupid' => 'ID',
			'useraccessid' => 'User Access',
			'groupaccessid' => 'Group Access',
			'recordstatus' => 'Record Status',
			'realname' => 'Real Name'
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
		$criteria->with=array('useraccess','groupaccess');
		$criteria->compare('usergroupid',$this->usergroupid);
		$criteria->compare('useraccess.username',$this->useraccessid,true);
		$criteria->compare('groupaccess.groupname',$this->groupaccessid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);
		$criteria->compare('useraccess.realname',$this->realname);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}

	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('useraccess','groupaccess');
		$criteria->condition='recordstatus=1';
		$criteria->compare('usergroupid',$this->usergroupid);
		$criteria->compare('useraccess.username',$this->useraccessid,true);
		$criteria->compare('groupaccess.groupname',$this->groupaccessid,true);
		$criteria->compare('t.recordstatus',$this->recordstatus);
		$criteria->compare('useraccess.realname',$this->realname);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
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
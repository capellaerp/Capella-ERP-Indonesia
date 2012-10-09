<?php

/**
 * This is the model class for table "userfav".
 *
 * The followings are the available columns in table 'userfav':
 * @property integer $userfavid
 * @property integer $useraccessid
 * @property integer $menuaccessid
 *
 * The followings are the available model relations:
 * @property Useraccess $useraccess
 * @property Menuaccess $menuaccess
 */
class Userfav extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userfav the static model class
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
		return 'userfav';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('useraccessid, menuaccessid', 'required'),
			array('useraccessid, menuaccessid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userfavid, useraccessid, menuaccessid', 'safe', 'on'=>'search'),
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
			'menuaccess' => array(self::BELONGS_TO, 'Menuaccess', 'menuaccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userfavid' => 'ID',
			'useraccessid' => 'User',
			'menuaccessid' => 'Menu',
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
		$criteria->with=array('menuaccess','useraccess');
		$criteria->compare('userfavid',$this->userfavid);
		$criteria->compare('useraccess.username',$this->useraccessid,true);
		$criteria->compare('menuaccess.menuname',$this->menuaccessid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

public function searchwuser()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('menuaccess','useraccess');
		$criteria->condition="useraccess.username = '".Yii::app()->user->id."'";
		$criteria->compare('userfavid',$this->userfavid);
		$criteria->compare('useraccess.username',$this->useraccessid,true);
		$criteria->compare('menuaccess.menuname',$this->menuaccessid,true);

		return new CActiveDataProvider($this, array(
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

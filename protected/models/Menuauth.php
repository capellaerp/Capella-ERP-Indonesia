<?php

/**
 * This is the model class for table "menuauth".
 *
 * The followings are the available columns in table 'menuauth':
 * @property string $menuauthid
 * @property string $menuaccessid
 * @property string $menuobject
 * @property integer $recordstatus
 */
class Menuauth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menuauth the static model class
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
		return 'menuauth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menuaccessid, menuobject, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('menuaccessid', 'length', 'max'=>10),
			array('menuobject', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuauthid, menuaccessid, menuobject, recordstatus', 'safe', 'on'=>'search'),
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
			'menuaccess' => array(self::BELONGS_TO, 'Menuaccess', 'menuaccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menuauthid' => 'ID',
			'menuaccessid' => 'Menu',
			'menuobject' => 'Menu Object',
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
        $criteria->with=array('menuaccess');
		$criteria->compare('menuauthid',$this->menuauthid,true);
		$criteria->compare('menuaccessid',$this->menuaccessid,true);
		$criteria->compare('menuobject',$this->menuobject,true);
		$criteria->compare('recordstatus',$this->recordstatus);

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
        $criteria->with=array('menuaccess');
		$criteria->condition='t.recordstatus = 1';
		$criteria->compare('menuauthid',$this->menuauthid,true);
		$criteria->compare('menuaccess.menuname',$this->menuaccessid,true);
		$criteria->compare('menuobject',$this->menuobject,true);
		$criteria->compare('recordstatus',$this->recordstatus);

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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }

}
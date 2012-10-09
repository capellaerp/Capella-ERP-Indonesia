<?php

/**
 * This is the model class for table "orgstructure".
 *
 * The followings are the available columns in table 'orgstructure':
 * @property integer $orgstructureid
 * @property string $structurename
 * @property string $parentid
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Groupstructure[] $groupstructures
 */
class Orgstructure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Orgstructure the static model class
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
		return 'orgstructure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('structurename, recordstatus', 'required'),
			array('recordstatus, parentid', 'numerical', 'integerOnly'=>true),
			array('structurename', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('orgstructureid, structurename, parentid, recordstatus', 'safe', 'on'=>'search'),
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
		  			'parent' => array(self::BELONGS_TO, 'Orgstructure', 'parentid'),
			'groupstructures' => array(self::HAS_MANY, 'Groupstructure', 'orgstructureid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orgstructureid' => 'ID',
			'structurename' => 'Structure ',
			'parentid' => 'Superior',
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
        $criteria->with=array('parent');
		$criteria->compare('orgstructureid',$this->orgstructureid);
		$criteria->compare('t.structurename',$this->structurename,true);
		$criteria->compare('parent.structurename',$this->parentid,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),			'criteria'=>$criteria,
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
        $criteria->with=array('parent');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('orgstructureid',$this->orgstructureid);
		$criteria->compare('t.structurename',$this->structurename,true);
		$criteria->compare('parent.structurename',$this->parentid,true);

		return new CActiveDataProvider(get_class($this), array(
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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
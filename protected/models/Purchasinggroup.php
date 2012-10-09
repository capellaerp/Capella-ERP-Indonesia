<?php

/**
 * This is the model class for table "purchasinggroup".
 *
 * The followings are the available columns in table 'purchasinggroup':
 * @property integer $purchasinggroupid
 * @property integer $purchasingorgid
 * @property string $purchasinggroupcode
 * @property string $description
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Purchasingorg $purchasingorg
 */
class Purchasinggroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Purchasinggroup the static model class
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
		return 'purchasinggroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchasingorgid, purchasinggroupcode, description, recordstatus', 'required'),
			array('purchasingorgid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('purchasinggroupcode', 'length', 'max'=>5),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('purchasinggroupid, purchasingorgid, purchasinggroupcode, description, recordstatus', 'safe', 'on'=>'search'),
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
			'purchasingorg' => array(self::BELONGS_TO, 'Purchasingorg', 'purchasingorgid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'purchasinggroupid' => 'ID',
			'purchasingorgid' => 'Purchasing Organization',
			'purchasinggroupcode' => 'Purchasing Group Code',
			'description' => 'Description',
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

		$criteria->compare('purchasinggroupid',$this->purchasinggroupid);
		$criteria->compare('purchasingorgid',$this->purchasingorgid);
		$criteria->compare('purchasinggroupcode',$this->purchasinggroupcode,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$criteria->compare('purchasinggroupid',$this->purchasinggroupid);
		$criteria->compare('purchasingorgid',$this->purchasingorgid);
		$criteria->compare('purchasinggroupcode',$this->purchasinggroupcode,true);
		$criteria->compare('description',$this->description,true);
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
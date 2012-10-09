<?php

/**
 * This is the model class for table "requestedby".
 *
 * The followings are the available columns in table 'requestedby':
 * @property integer $requestedbyid
 * @property string $requestedbycode
 * @property string $description
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Prmaterial[] $prmaterials
 */
class Requestedby extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Requestedby the static model class
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
		return 'requestedby';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requestedbycode, description, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('requestedbycode', 'length', 'max'=>5),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('requestedbyid, requestedbycode, description, recordstatus', 'safe', 'on'=>'search'),
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
			'prmaterials' => array(self::HAS_MANY, 'Prmaterial', 'requestedbyid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'requestedbyid' => 'ID',
			'requestedbycode' => 'Requested By Code',
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

		$criteria->compare('requestedbyid',$this->requestedbyid);
		$criteria->compare('requestedbycode',$this->requestedbycode,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$criteria->compare('requestedbyid',$this->requestedbyid);
		$criteria->compare('requestedbycode',$this->requestedbycode,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
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
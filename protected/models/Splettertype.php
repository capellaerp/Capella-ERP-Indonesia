<?php

/**
 * This is the model class for table "splettertype".
 *
 * The followings are the available columns in table 'splettertype':
 * @property string $splettertypeid
 * @property string $splettername
 * @property string $description
 * @property string $validperiod
 * @property integer $recordstatus
 */
class Splettertype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Splettertype the static model class
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
		return 'splettertype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('splettername, description, validperiod, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('splettername, description', 'length', 'max'=>50),
			array('validperiod', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('splettertypeid, splettername, description, validperiod, recordstatus', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'splettertypeid' => 'ID',
			'splettername' => 'SP Type',
			'description' => 'Description',
			'validperiod' => 'Valid Period',
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

		$criteria->compare('splettertypeid',$this->splettertypeid,true);
		$criteria->compare('splettername',$this->splettername,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('validperiod',$this->validperiod,true);
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
        $criteria->condition='recordstatus=1';
		$criteria->compare('splettertypeid',$this->splettertypeid,true);
		$criteria->compare('splettername',$this->splettername,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('validperiod',$this->validperiod,true);
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
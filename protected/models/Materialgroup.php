<?php

/**
 * This is the model class for table "materialgroup".
 *
 * The followings are the available columns in table 'materialgroup':
 * @property integer $materialgroupid
 * @property string $materialgroupcode
 * @property string $description
 * @property integer $recordstatus
 */
class Materialgroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Materialgroup the static model class
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
		return 'materialgroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materialgroupcode, materialtypeid,description, recordstatus', 'required'),
			array('recordstatus,parentmatgroupid,materialtypeid', 'numerical', 'integerOnly'=>true),
			array('materialgroupcode', 'length', 'max'=>5),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('materialgroupid, materialgroupcode, materialtypeid, description, recordstatus,parentmatgroupid', 'safe', 'on'=>'search'),
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
		  			'parentmatgroup' => array(self::BELONGS_TO, 'Materialgroup', 'parentmatgroupid'),
		  			'materialtype' => array(self::BELONGS_TO, 'Materialtype', 'materialtypeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'materialgroupid' => 'ID',
			'materialgroupcode' => 'Material Group Code',
			'description' => 'Description',
			'parentmatgroupid'=>'Parent',
            'materialtypeid'=>'Material Type',
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
        $criteria->with=array('materialtype');
		$criteria->compare('materialgroupid',$this->materialgroupid);
		$criteria->compare('materialgroupcode',$this->materialgroupcode,true);
		$criteria->compare('materialtype.description',$this->materialtypeid,true);
		$criteria->compare('t.description',$this->description,true);
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
        $criteria->with=array('materialtype');
		$criteria->condition='t.recordstatus=1';
		$criteria->compare('materialgroupid',$this->materialgroupid);
		$criteria->compare('materialtype.description',$this->materialtypeid,true);
		$criteria->compare('materialgroupcode',$this->materialgroupcode,true);
		$criteria->compare('t.description',$this->description,true);
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
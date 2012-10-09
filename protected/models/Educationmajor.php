<?php

/**
 * This is the model class for table "educationmajor".
 *
 * The followings are the available columns in table 'educationmajor':
 * @property integer $educationmajorid
 * @property integer $educationid
 * @property string $educationmajorname
 * @property integer $recordstatus
 */
class Educationmajor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Educationmajor the static model class
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
		return 'educationmajor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('educationid, educationmajorname, recordstatus', 'required'),
			array('educationid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('educationmajorname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('educationmajorid, educationid, educationmajorname, recordstatus', 'safe', 'on'=>'search'),
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
			'education' => array(self::BELONGS_TO, 'Education', 'educationid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'educationmajorid' => 'ID',
			'educationid' => 'Education',
			'educationmajorname' => 'Education Major ',
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
    $criteria->with=array('education');
		$criteria->compare('t.educationmajorid',$this->educationmajorid);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('t.educationmajorname',$this->educationmajorname,true);

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
    $criteria->with=array('education');
    $criteria->condition='t.recordstatus=1';
		$criteria->compare('t.educationmajorid',$this->educationmajorid);
		$criteria->compare('education.educationname',$this->educationid,true);
		$criteria->compare('t.educationmajorname',$this->educationmajorname,true);

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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
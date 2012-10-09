<?php

/**
 * This is the model class for table "jobs".
 *
 * The followings are the available columns in table 'jobs':
 * @property integer $jobsid
 * @property integer $orgstructureid
 * @property string $jobdesc
 * @property integer $jobqty
 * @property string $qualification
 * @property integer $recordstatus
 */
class Jobs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Jobs the static model class
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
		return 'jobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orgstructureid, jobdesc, qualification, recordstatus', 'required'),
			array('orgstructureid, positionid, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('jobsid, orgstructureid, jobdesc, qualification, recordstatus', 'safe', 'on'=>'search'),
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
			'orgstructure' => array(self::BELONGS_TO, 'Orgstructure', 'orgstructureid'),
			'position' => array(self::BELONGS_TO, 'Position', 'positionid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jobsid' => 'ID',
			'orgstructureid' => 'Organization Structure',
			'jobdesc' => 'Job Description',
			'qualification' => 'Qualification',
			'recordstatus' => 'Record Status',
            'positionid'=>'Position'
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
$criteria->with=array('orgstructure','position');
		$criteria->compare('jobsid',$this->jobsid);
		$criteria->compare('orgstructure.orgstructurename',$this->orgstructureid,true);
		$criteria->compare('jobdesc',$this->jobdesc,true);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('position.positionname',$this->positionid,true);

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
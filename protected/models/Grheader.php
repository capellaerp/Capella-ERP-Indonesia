<?php

/**
 * This is the model class for table "genjournal".
 *
 * The followings are the available columns in table 'genjournal':
 * @property integer $genjournalid
 * @property string $grno
 * @property string $journaldate
 * @property string $journalnote
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Journaldetail[] $journaldetails
 */
class Grheader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Genjournal the static model class
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
		return 'grheader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('grno', 'length', 'max'=>50),
			array('headernote', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('grheaderid, grno, grdate,postdate, recordstatus', 'safe', 'on'=>'search'),
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
			'grdetail' => array(self::HAS_MANY, 'Grdetail', 'grheaderid'),
      'poheader' => array(self::BELONGS_TO, 'Poheader', 'poheaderid'),
      'giheader' => array(self::BELONGS_TO, 'Giheader', 'giheaderid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grheaderid' => 'ID',
			'grno' => 'GR No',
			'grdate' => 'GR Date',
			'postdate' => 'Post Date',
			'poheaderid'=>'PO',
            'giheaderid'=>'GI',
			'headernote'=>'Header Note',
			'recordstatus' => 'Record Status',
		);
	}

    public function beforeSave() {
        $this->grdate = date(Yii::app()->params['datetodb'], strtotime($this->grdate));
        $this->postdate = date(Yii::app()->params['datetodb'], strtotime($this->grdate));
    return parent::beforeSave();
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
        $criteria->with=array('poheader','giheader');

		$criteria->compare('grheaderid',$this->grheaderid);
		$criteria->compare('grno',$this->grno,true);
		$criteria->compare('grdate',$this->grdate,true);
		$criteria->compare('postdate',$this->postdate,true);
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
        $criteria->with=array('poheader','giheader');
		$criteria->condition='t.recordstatus=1';
		$criteria->compare('grheaderid',$this->grheaderid);
		$criteria->compare('grno',$this->grno,true);
		$criteria->compare('grdate',$this->grdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

	public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('poheader','giheader');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listgr') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('grheaderid',$this->grheaderid);
		$criteria->compare('grno',$this->grno,true);
		$criteria->compare('grdate',$this->grdate,true);
		$criteria->compare('postdate',$this->postdate,true);
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
            'application.behaviors.ActiveRecordLogableBehavior',
    );
  }
}
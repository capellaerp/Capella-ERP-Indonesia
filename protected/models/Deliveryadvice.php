<?php

/**
 * This is the model class for table "deliveryadvice".
 *
 * The followings are the available columns in table 'deliveryadvice':
 * @property integer $deliveryadviceid
 * @property string $dano
 * @property string $headernote
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Deliveryadvicedetail[] $deliveryadvicedetails
 */
class Deliveryadvice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Deliveryadvice the static model class
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
		return 'deliveryadvice';
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
			array('recordstatus,useraccessid', 'numerical', 'integerOnly'=>true),
			array('dadate','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('deliveryadviceid, dano, headernote, recordstatus,useraccessid', 'safe', 'on'=>'search'),
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
			'deliveryadvicedetails' => array(self::HAS_MANY, 'Deliveryadvicedetail', 'deliveryadviceid'),
			'useraccess' => array(self::BELONGS_TO, 'Useraccess', 'useraccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'deliveryadviceid' => 'ID',
			'dano' => 'Request No',
			'headernote' => 'Header Note',
			'dadate' => 'Request Date',
			'recordstatus' => 'Record Status',
        'useraccessid'=>'Created By'
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
        $criteria->with=array('useraccess');

		$criteria->compare('deliveryadviceid',$this->deliveryadviceid);
		$criteria->compare('dano',$this->dano,true);
		$criteria->compare('headernote',$this->headernote,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
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
        $criteria->with=array('useraccess');
		$criteria->condition='recordstatus=1';
		$criteria->compare('deliveryadviceid',$this->deliveryadviceid);
		$criteria->compare('dano',$this->dano,true);
		$criteria->compare('headernote',$this->headernote,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('sloc.description',$this->slocid,true);
		$criteria->compare('useraccess.username',$this->useraccessid,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}

        public function beforeSave() {
        $this->dadate = date(Yii::app()->params['datetodb'], strtotime($this->dadate));
    return parent::beforeSave();
}

        public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('useraccess');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listda') and upper(e.username)=upper('".Yii::app()->user->name."') and
t.useraccessid in (select gm.menuvalueid from groupmenuauth gm
inner join menuauth ma on ma.menuauthid = gm.menuauthid
where upper(ma.menuobject) = upper('useraccess') and gm.groupaccessid = c.groupaccessid))";
		$criteria->compare('deliveryadviceid',$this->deliveryadviceid);
		$criteria->compare('dano',$this->dano,true);
		$criteria->compare('headernote',$this->headernote,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('useraccess.username',$this->useraccessid,true);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
    
    public function searchwfqtystatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array('useraccess');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listda') and upper(e.username)=upper('".Yii::app()->user->name."') and
t.deliveryadviceid in (select dad.deliveryadviceid
from deliveryadvicedetail dad
where qty > giqty))";
		$criteria->compare('deliveryadviceid',$this->deliveryadviceid);
		$criteria->compare('dano',$this->dano,true);
		$criteria->compare('headernote',$this->headernote,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('useraccess.username',$this->useraccessid,true);

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
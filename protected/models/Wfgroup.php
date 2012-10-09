<?php

/**
 * This is the model class for table "wfgroup".
 *
 * The followings are the available columns in table 'wfgroup':
 * @property integer $wfgroupid
 * @property integer $workflowid
 * @property integer $groupaccessid
 * @property integer $wfbefstat
 * @property integer $wfrecstat
 * @property integer $recordstatus
 */
class Wfgroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Wfgroup the static model class
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
		return 'wfgroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workflowid, groupaccessid, wfbefstat, wfrecstat, recordstatus', 'required'),
			array('workflowid, groupaccessid, wfbefstat, wfrecstat, recordstatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wfgroupid, workflowid, groupaccessid, wfbefstat, wfrecstat, recordstatus', 'safe', 'on'=>'search'),
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
                    'workflow' => array(self::BELONGS_TO, 'Workflow', 'workflowid'),
                    'groupaccess' => array(self::BELONGS_TO, 'Groupaccess', 'groupaccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wfgroupid' => 'ID',
			'workflowid' => 'Workflow',
			'groupaccessid' => 'Group Access',
			'wfbefstat' => 'WF Before Status',
			'wfrecstat' => 'WF After Status',
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
$criteria->with=array('workflow','groupaccess');
		$criteria->compare('wfgroupid',$this->wfgroupid);
		$criteria->compare('workflow.wfdesc',$this->workflowid,true);
		$criteria->compare('groupaccess.groupname',$this->groupaccessid,true);
		$criteria->compare('wfbefstat',$this->wfbefstat);
		$criteria->compare('wfrecstat',$this->wfrecstat);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider($this, array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
  
  public function findstatusbyuser($workflow)
  {
      $status = Wfgroup::model()->findbysql("select b.*
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('". $workflow ."') and upper(e.username)=upper('".Yii::app()->user->name."')");
      if ($status != null)
      {
           return $status->wfbefstat;
      }
      else
      {
          return 0;
      }
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
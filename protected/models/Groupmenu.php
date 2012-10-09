<?php

/**
 * This is the model class for table "groupmenu".
 *
 * The followings are the available columns in table 'groupmenu':
 * @property integer $groupmenuid
 * @property integer $groupaccessid
 * @property integer $menuaccessid
 * @property integer $isread
 * @property integer $iswrite
 * @property integer $ispost
 * @property integer $isreject
 * @property integer $isupload
 * @property integer $isdownload
 *
 * The followings are the available model relations:
 * @property Menuaccess $menuaccess
 * @property Groupaccess $groupaccess
 */
class Groupmenu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Groupmenu the static model class
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
		return 'groupmenu';
	}
	
	public $menudescription;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload', 'required'),
			array('groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('groupmenuid, groupaccessid, menuaccessid, isread, iswrite, ispost, isreject, isupload, isdownload, menudescription', 'safe', 'on'=>'search'),
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
			'menuaccess' => array(self::BELONGS_TO, 'Menuaccess', 'menuaccessid'),
			'groupaccess' => array(self::BELONGS_TO, 'Groupaccess', 'groupaccessid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'groupmenuid' => 'ID',
			'groupaccessid' => 'Group Access',
			'menuaccessid' => 'Menu Access',
			'isread' => 'Read',
			'iswrite' => 'Write',
			'ispost' => 'Post',
			'isreject' => 'Reject',
			'isupload' => 'Upload',
			'isdownload' => 'Download',
			'menudescription' => 'Menu Description'
		);
	}
  
  public function GetReadMenu($menuname)
  {
    $menu = Groupmenu::model()->findbysql("select isread ".
		" from useraccess a ".
		" inner join usergroup b on b.useraccessid = a.useraccessid ".
		" inner join groupmenu c on c.groupaccessid = b.groupaccessid ".
		" inner join menuaccess d on d.menuaccessid = c.menuaccessid ".
		" where lower(username) = '".Yii::app()->user->id."' and lower(menuname) = '".$menuname."'");
    if ($menu != null)
    {
      if ($menu->isread == 1)
      {
        return true;
      } else
      {
        return false;
      }
    }
    else 
    {
      return false;
    }
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
        $criteria->with=array('groupaccess','menuaccess');
		$criteria->compare('groupmenuid',$this->groupmenuid);
		$criteria->compare('groupaccess.groupname',$this->groupaccessid,true);
		$criteria->compare('menuaccess.menuname',$this->menuaccessid,true);
		$criteria->compare('menuaccess.description',$this->menudescription);
		$criteria->compare('isread',$this->isread);
		$criteria->compare('iswrite',$this->iswrite);
		$criteria->compare('ispost',$this->ispost);
		$criteria->compare('isreject',$this->isreject);
		$criteria->compare('isupload',$this->isupload);
		$criteria->compare('isdownload',$this->isdownload);

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

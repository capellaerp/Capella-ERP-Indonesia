<?php

/**
 * This is the model class for table "menuaccess".
 *
 * The followings are the available columns in table 'menuaccess':
 * @property integer $menuaccessid
 * @property string $menucode
 * @property string $menuname
 * @property string $menuurl
 * @property integer $recordstatus
 */
class Menuaccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menuaccess the static model class
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
		return 'menuaccess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menucode, menuname, menuurl, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('menucode', 'length', 'max'=>10),
			array('menuname, menuurl,description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menuaccessid, menucode, menuname, menuurl, recordstatus,description', 'safe', 'on'=>'search'),
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
			'menuaccessid' => 'ID',
			'menucode' => 'Menu Code',
			'menuname' => 'Menu ',
			'menuurl' => 'Menu Url',
            'description'=> 'Description',
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

		$criteria->compare('menuaccessid',$this->menuaccessid);
		$criteria->compare('menucode',$this->menucode,true);
		$criteria->compare('menuname',$this->menuname,true);
		$criteria->compare('menuurl',$this->menuurl,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function GetMenuTitle($menuname)
  {
    $menu = Menuaccess::model()->findbysql("select description ".
		" from menuaccess a ".
		" where lower(menuname) = lower('".$menuname."')");
    if ($menu != null)
    {
      return  $menu->description;
    }
    else 
    {
      return $menuname;
    }
  }
  
  public function GetMenuUrl($menuname)
  {
    $menu = Menuaccess::model()->findbysql("select menuurl ".
		" from menuaccess a ".
		" where lower(menuname) = lower('".$menuname."')");
    if ($menu != null)
    {
      return  $menu->menuurl;
    }
    else 
    {
      return $menuname;
    }
  }
  
  public function GetMenuCode($menuname)
  {
    $menu = Menuaccess::model()->findbysql("select menucode ".
		" from menuaccess a ".
		" where lower(menuname) = lower('".$menuname."')");
    if ($menu != null)
    {
      return  $menu->menucode;
    }
    else 
    {
      return $menuname;
    }
  }

public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition='recordstatus=1';
		$criteria->compare('menuaccessid',$this->menuaccessid);
		$criteria->compare('menucode',$this->menucode,true);
		$criteria->compare('menuname',$this->menuname,true);
		$criteria->compare('menuurl',$this->menuurl,true);
		$criteria->compare('description',$this->description,true);
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

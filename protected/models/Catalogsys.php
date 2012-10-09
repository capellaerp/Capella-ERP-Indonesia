<?php

/**
 * This is the model class for table "catalogsys".
 *
 * The followings are the available columns in table 'catalogsys':
 * @property integer $catalogsysid
 * @property integer $languageid
 * @property string $catalogname
 * @property string $catalogval
 * @property integer $recordstatus
 */
class Catalogsys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Catalogsys the static model class
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
		return 'catalogsys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('languageid, catalogname, catalogval, recordstatus', 'required'),
			array('languageid, recordstatus', 'numerical', 'integerOnly'=>true),
			array('catalogname', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('catalogsysid, languageid, catalogname, catalogval, recordstatus', 'safe', 'on'=>'search'),
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
			'language' => array(self::BELONGS_TO, 'Language', 'languageid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'catalogsysid' => 'ID',
			'languageid' => 'Language',
			'catalogname' => 'Catalog ',
			'catalogval' => 'Catalog Value',
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

		$criteria->compare('catalogsysid',$this->catalogsysid);
		$criteria->compare('languageid',$this->languageid);
		$criteria->compare('catalogname',$this->catalogname,true);
		$criteria->compare('catalogval',$this->catalogval,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
						'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),'criteria'=>$criteria,
		));
	}
	
	public function GetCatalog($menuname)
  {
    $menu = Catalogsys::model()->findbysql("select catalogval ".
		" from catalogsys a ".
		" inner join useraccess b on b.languageid = a.languageid ".
		" where lower(catalogname) = lower('".$menuname."') and lower(b.username) = lower('". Yii::app()->user->id ."')");
    if ($menu != null)
    {
      return  $menu->catalogval;
    }
    else 
    {
      return $menuname;
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
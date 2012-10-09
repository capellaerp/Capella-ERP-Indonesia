<?php

/**
 * This is the model class for table "menudata".
 *
 * The followings are the available columns in table 'menudata':
 * @property string $menudataid
 * @property integer $menuaccessid
 * @property string $datalimit
 *
 * The followings are the available model relations:
 * @property Menuaccess $menuaccess
 */
class Menudata extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menudata the static model class
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
		return 'menudata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menuaccessid', 'required'),
			array('menuaccessid', 'numerical', 'integerOnly'=>true),
			array('datalimit', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menudataid, menuaccessid, datalimit', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menudataid' => 'Menudataid',
			'menuaccessid' => 'Menuaccessid',
			'datalimit' => 'Datalimit',
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

		$criteria->compare('menudataid',$this->menudataid,true);
		$criteria->compare('menuaccessid',$this->menuaccessid);
		$criteria->compare('datalimit',$this->datalimit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
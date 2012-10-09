<?php

/**
 * This is the model class for table "snrodet".
 *
 * The followings are the available columns in table 'snrodet':
 * @property integer $snrodid
 * @property integer $snroid
 * @property integer $curdd
 * @property integer $curmm
 * @property integer $curyy
 * @property integer $curvalue
 */
class Snrodet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Snrodet the static model class
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
		return 'snrodet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('snroid, curdd, curmm, curyy, curvalue', 'required'),
			array('snroid, curdd, curmm, curyy, curvalue', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('snrodid, snroid, curdd, curmm, curyy, curvalue', 'safe', 'on'=>'search'),
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
      'snro' => array(self::BELONGS_TO, 'Snro', 'snroid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'snrodid' => 'ID',
			'snroid' => 'Description',
			'curdd' => 'Current Date',
			'curmm' => 'Current Month',
			'curyy' => 'Current Year',
			'curvalue' => 'Current Value',
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
    $criteria->with=array('snro');
		$criteria->compare('snrodid',$this->snrodid);
		$criteria->compare('snroid',$this->snroid);
		$criteria->compare('curdd',$this->curdd);
		$criteria->compare('curmm',$this->curmm);
		$criteria->compare('curyy',$this->curyy);
		$criteria->compare('curvalue',$this->curvalue);

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
<?php

class ActiveRecordLogableBehavior extends CActiveRecordBehavior
{
    private $_oldattributes = array();

    public function afterSave($event)
    {
        $newattributes = $this->Owner->getAttributes();
        if (!$this->Owner->isNewRecord) {

            // new attributes            
            $oldattributes = $this->getOldAttributes();

            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }

                if ($value != $old) {
                    //$changes = $name . ' ('.$old.') => ('.$value.'), ';

                    $log=new Translog;
                    $log->username = Yii::app()->user->id;
                    $log->model =  get_class($this->Owner);
                    $log->useraction = 'CHANGE';
                    $log->createddate = new CDbExpression('NOW()');
                    $log->fieldname = $name;
                    $log->fieldnewvalue = $value;
                    $log->save();
                }
            }
        } else {
            foreach ($newattributes as $name => $value) {
            $log=new Translog;
                    $log->username = Yii::app()->user->id;
                    $log->model =  get_class($this->Owner);
                    $log->useraction = 'CREATE';
                    $log->createddate = new CDbExpression('NOW()');
                    $log->fieldname = $name;
                    $log->fieldnewvalue = $value;
            $log->save();
            }
        }
    }

    public function afterDelete($event)
    {

    }

    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }

    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }

    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}
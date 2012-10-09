<?php
Yii::import('zii.widgets.CPortlet');
class Information extends CPortlet
{
    public $title='Information';
 
    protected function renderContent()
    {
		$this->render('Information',array(
		));
    }
}
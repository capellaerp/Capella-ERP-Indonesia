<?php
Yii::import('zii.widgets.CPortlet');
class Agenda extends CPortlet
{
    public $title='';
 
    protected function renderContent()
    {
        $this->render('Agenda');
    }
}
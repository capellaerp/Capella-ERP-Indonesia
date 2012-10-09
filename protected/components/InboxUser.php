<?php
Yii::import('zii.widgets.CPortlet');
class InboxUser extends CPortlet
{
    public $title='User Inbox';
 
    protected function renderContent()
    {
		$model=new Userinbox('search');
		if(isset($_GET['Userinbox']))
			$model->attributes=$_GET['Employee'];
		if (isset($_GET['pageSize']))
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('InboxUser',array(
			'model'=>$model
		));
    }
}
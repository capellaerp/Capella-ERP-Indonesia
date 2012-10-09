<?php
Yii::import('zii.widgets.CPortlet');
class DaftarKaryawan extends CPortlet
{
    public $title='Daftar Karyawan Yang Ulang Tahun';
 
    protected function renderContent()
    {
		$model=new Employee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
			$model->attributes=$_GET['Employee'];
		if (isset($_GET['pageSize']))
		{
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
		}
		$this->render('DaftarKaryawan',array(
			'model'=>$model
		));
    }
}
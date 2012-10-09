<?php $this->pageTitle=Yii::app()->name; ?>
<?php  
//echo CHtml::image(Yii::app()->request->baseUrl.'/images/banner.jpg');
if(!Yii::app()->user->isGuest) 
	   {
			$this->widget('DaftarKaryawan'); 
		}
?>

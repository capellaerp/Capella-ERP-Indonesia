<div class="userinboxform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userinbox-form',
	'enableAjaxValidation'=>true,
)); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'userinboxgrid',
	'dataProvider'=>$model->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
        array(
      'name'=>'inboxdatetime',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->inboxdatetime))',
     ),	
array(
		'class'=>'ext.CountColumn',
		'name'=>'usermessages',
		'visible'=>true, 
		'value'=>'$data->usermessages',
		'footer'=>true
	),		
		'userfrom'
	),
)); 
?>
<?php $this->endWidget(); ?>
</div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maritalstatus-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'maritalstatus/write',
	'isCancel'=>true,'UrlCancel'=>'maritalstatus/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'maritalstatusid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'maritalstatusname'); ?>
		<?php echo $form->textField($model,'maritalstatusname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'maritalstatusname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
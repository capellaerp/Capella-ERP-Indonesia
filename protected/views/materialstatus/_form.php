<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materialstatus-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'materialstatus/write',
	'isCancel'=>true,'UrlCancel'=>'materialstatus/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'materialstatusid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'materialstatusname'); ?>
		<?php echo $form->textField($model,'materialstatusname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'materialstatusname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
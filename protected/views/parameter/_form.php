<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parameter-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'parameter/write',
	'isCancel'=>true,'UrlCancel'=>'parameter/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'parameterid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'paramname'); ?>
		<?php echo $form->textField($model,'paramname',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'paramname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paramvalue'); ?>
		<?php echo $form->textField($model,'paramvalue',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'paramvalue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
		
<?php $this->endWidget(); ?>
</div><!-- form -->
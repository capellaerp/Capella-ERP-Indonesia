<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menuaccess-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'menuaccess/write',
	'isCancel'=>true,'UrlCancel'=>'menuaccess/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'menuaccessid'); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'menucode'); ?>
		<?php echo $form->textField($model,'menucode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'menucode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menuname'); ?>
		<?php echo $form->textField($model,'menuname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'menuname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menuurl'); ?>
		<?php echo $form->textField($model,'menuurl',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'menuurl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->

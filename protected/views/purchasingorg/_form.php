<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchasingorg-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'purchasingorg/write',
	'isCancel'=>true,'UrlCancel'=>'purchasingorg/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'purchasingorgid'); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'purchasingorgcode'); ?>
		<?php echo $form->textField($model,'purchasingorgcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'purchasingorgcode'); ?>
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
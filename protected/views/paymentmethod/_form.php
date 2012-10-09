<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paymentmethod-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'paymentmethod/write',
	'isCancel'=>true,'UrlCancel'=>'paymentmethod/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'paymentmethodid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'paycode'); ?>
		<?php echo $form->textField($model,'paycode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'paycode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentname'); ?>
		<?php echo $form->textField($model,'paymentname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'paymentname'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'paydays'); ?>
		<?php echo $form->textField($model,'paydays'); ?>
		<?php echo $form->error($model,'paydays'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
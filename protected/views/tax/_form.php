<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tax-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'tax/write',
	'isCancel'=>true,'UrlCancel'=>'tax/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'taxid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'taxcode'); ?>
		<?php echo $form->textField($model,'taxcode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'taxcode'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'taxvalue'); ?>
		<?php echo $form->textField($model,'taxvalue',array('size'=>5,'maxlength'=>5)); ?> %
		<?php echo $form->error($model,'taxvalue'); ?>
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
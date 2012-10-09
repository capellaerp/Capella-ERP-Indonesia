<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absstatus-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'absstatus/write',
	'isCancel'=>true,'UrlCancel'=>'absstatus/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'absstatusid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'shortstat'); ?>
		<?php echo $form->textField($model,'shortstat',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'shortstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longstat'); ?>
		<?php echo $form->textField($model,'longstat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'longstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isin'); ?>
		<?php echo $form->checkBox($model,'isin'); ?>
		<?php echo $form->error($model,'isin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

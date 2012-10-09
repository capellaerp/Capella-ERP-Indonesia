<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requestedby-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'requestedby/write',
	'isCancel'=>true,'UrlCancel'=>'requestedby/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'requestedbyid'); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'requestedbycode'); ?>
		<?php echo $form->textField($model,'requestedbycode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'requestedbycode'); ?>
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
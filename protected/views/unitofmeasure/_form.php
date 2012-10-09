<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unitofmeasure-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'unitofmeasure/write',
	'isCancel'=>true,'UrlCancel'=>'unitofmeasure/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'unitofmeasureid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uomcode'); ?>
		<?php echo $form->textField($model,'uomcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'uomcode'); ?>
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
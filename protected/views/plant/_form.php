<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plant-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'plant/write',
	'isCancel'=>true,'UrlCancel'=>'plant/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'plantid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'plantcode'); ?>
		<?php echo $form->textField($model,'plantcode'); ?>
		<?php echo $form->error($model,'plantcode'); ?>
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
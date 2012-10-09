<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'education-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'education/write',
	'isCancel'=>true,'UrlCancel'=>'education/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'educationid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'educationname'); ?>
		<?php echo $form->textField($model,'educationname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'educationname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
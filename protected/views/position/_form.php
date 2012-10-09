<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'position/write',
	'isCancel'=>true,'UrlCancel'=>'position/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'positionid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'positionname'); ?>
		<?php echo $form->textField($model,'positionname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'positionname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ownership-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'ownership/write',
	'isCancel'=>true,'UrlCancel'=>'ownership/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'ownershipid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ownershipname'); ?>
		<?php echo $form->textField($model,'ownershipname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ownershipname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
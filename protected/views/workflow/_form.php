<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workflow-form',
	'enableAjaxValidation'=>false,
)); ?>
 <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'workflow/write',
	'isCancel'=>true,'UrlCancel'=>'workflow/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'workflowid'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'wfname'); ?>
		<?php echo $form->textField($model,'wfname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'wfname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wfdesc'); ?>
		<?php echo $form->textField($model,'wfdesc',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'wfdesc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wfminstat'); ?>
		<?php echo $form->textField($model,'wfminstat'); ?>
		<?php echo $form->error($model,'wfminstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wfmaxstat'); ?>
		<?php echo $form->textField($model,'wfmaxstat'); ?>
		<?php echo $form->error($model,'wfmaxstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
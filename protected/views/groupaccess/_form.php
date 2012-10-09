<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupaccess-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'groupaccess/write',
	'isCancel'=>true,'UrlCancel'=>'groupaccess/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'groupaccessid'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groupname'); ?>
		<?php echo $form->textField($model,'groupname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'groupname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>

	
<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sex-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'sex/write',
	'isCancel'=>true,'UrlCancel'=>'sex/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'sexid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'sexname'); ?>
		<?php echo $form->textField($model,'sexname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sexname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
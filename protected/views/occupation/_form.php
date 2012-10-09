<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'occupation-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'occupation/write',
	'isCancel'=>true,'UrlCancel'=>'occupation/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'occupationid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'occupationname'); ?>
		<?php echo $form->textField($model,'occupationname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'occupationname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
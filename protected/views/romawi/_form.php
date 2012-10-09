<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'romawi-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'romawi/write',
	'isCancel'=>true,'UrlCancel'=>'romawi/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'romawiid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'monthcal'); ?>
		<?php echo $form->textField($model,'monthcal'); ?>
		<?php echo $form->error($model,'monthcal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monthrm'); ?>
		<?php echo $form->textField($model,'monthrm',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'monthrm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
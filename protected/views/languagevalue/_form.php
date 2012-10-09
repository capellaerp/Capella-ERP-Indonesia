<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languagevalue-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'languagevalue/write',
	'isCancel'=>true,'UrlCancel'=>'languagevalue/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'languagevalueid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'languagevaluename'); ?>
		<?php echo $form->textField($model,'languagevaluename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'languagevaluename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'language/write',
	'isCancel'=>true,'UrlCancel'=>'language/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'languageid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'languagename'); ?>
		<?php echo $form->textField($model,'languagename',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'languagename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
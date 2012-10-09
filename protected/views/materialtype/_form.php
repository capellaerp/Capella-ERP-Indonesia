<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materialtype-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'materialtype/write',
	'isCancel'=>true,'UrlCancel'=>'materialtype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'materialtypeid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'materialtypecode'); ?>
		<?php echo $form->textField($model,'materialtypecode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'materialtypecode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
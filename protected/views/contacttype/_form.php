<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacttype-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'contacttype/write',
	'isCancel'=>true,'UrlCancel'=>'contacttype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'contacttypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'contacttypename'); ?>
		<?php echo $form->textField($model,'contacttypename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'contacttypename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->

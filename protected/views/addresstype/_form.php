<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addresstype-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'addresstype/write',
	'isCancel'=>true,'UrlCancel'=>'addresstype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'addresstypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'addresstypename'); ?>
		<?php echo $form->textField($model,'addresstypename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'addresstypename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
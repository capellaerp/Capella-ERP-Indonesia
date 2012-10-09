<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'identitytype-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'identitytype/write',
	'isCancel'=>true,'UrlCancel'=>'identitytype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'identitytypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'identitytypename'); ?>
		<?php echo $form->textField($model,'identitytypename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'identitytypename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
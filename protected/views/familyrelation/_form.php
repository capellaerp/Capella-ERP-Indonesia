<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'familyrelation-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'familyrelation/write',
	'isCancel'=>true,'UrlCancel'=>'familyrelation/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'familyrelationid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'familyrelationname'); ?>
		<?php echo $form->textField($model,'familyrelationname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'familyrelationname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
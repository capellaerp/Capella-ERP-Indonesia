<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'industry-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'industry/write',
	'isCancel'=>true,'UrlCancel'=>'industry/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'industryid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'industryname'); ?>
		<?php echo $form->textField($model,'industryname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'industryname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
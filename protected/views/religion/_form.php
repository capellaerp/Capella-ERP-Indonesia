<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'religion-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'religion/write',
	'isCancel'=>true,'UrlCancel'=>'religion/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'religionid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'religionname'); ?>
		<?php echo $form->textField($model,'religionname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'religionname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

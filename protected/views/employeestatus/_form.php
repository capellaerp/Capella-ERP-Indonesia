<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employeestatus-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'employeestatus/write',
	'isCancel'=>true,'UrlCancel'=>'employeestatus/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'employeestatusid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'employeestatusname'); ?>
		<?php echo $form->textField($model,'employeestatusname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'employeestatusname'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'taxvalue'); ?>
		<?php echo $form->textField($model,'taxvalue',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'taxvalue'); ?>
	</div>
  
  <div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
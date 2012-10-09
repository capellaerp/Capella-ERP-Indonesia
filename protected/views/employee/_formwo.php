<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog4',
	'DialogGrid'=>'detail4datagrid',
	'isSave'=>true,'UrlSave'=>'employee/writewo',
	'isCancel'=>true,'UrlCancel'=>'employee/cancelwritewo'
));
?>
<?php echo $form->hiddenField($model,'employeeinformalid'); ?>
<?php echo $form->hiddenField($model,'employeeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'informalname'); ?>
		<?php echo $form->textField($model,'informalname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'informalname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organizer'); ?>
		<?php echo $form->textField($model,'organizer',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'organizer'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->labelEx($model,'sponsoredby'); ?>
		<?php echo $form->textField($model,'sponsoredby',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sponsoredby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'period'); ?>
		<?php echo $form->textField($model,'period'); ?>
		<?php echo $form->error($model,'period'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->CheckBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
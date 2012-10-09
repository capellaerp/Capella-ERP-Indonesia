<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'facilitytype/write',
	'isCancel'=>true,'UrlCancel'=>'facilitytype/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'facilitytypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'facilitytypename'); ?>
		<?php echo $form->textField($model,'facilitytypename'); ?>
		<?php echo $form->error($model,'facilitytypename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
    <?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'country/write',
	'isCancel'=>true,'UrlCancel'=>'country/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'countryid'); ?>
<div id="contentform">
	<div class="row">
		<?php echo $form->labelEx($model,'countrycode'); ?>
		<?php echo $form->textField($model,'countrycode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'countrycode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'countryname'); ?>
		<?php echo $form->textField($model,'countryname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'countryname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
</div>	
		
<?php $this->endWidget(); ?>
</div><!-- form -->

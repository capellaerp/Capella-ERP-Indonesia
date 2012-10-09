<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currency-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'currency/write',
	'isCancel'=>true,'UrlCancel'=>'currency/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'currencyid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'countryid'); ?>
    <?php echo $form->dropDownList($model,'countryid', CHtml::listData(Country::model()->findAll(), 'countryid', 'countryname'),
    array('prompt' => 'Select a Country')); ?>
		<?php echo $form->error($model,'countryid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currencyname'); ?>
		<?php echo $form->textField($model,'currencyname',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'currencyname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symbol'); ?>
		<?php echo $form->textField($model,'symbol',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'symbol'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'i18n'); ?>
		<?php echo $form->textField($model,'i18n'); ?>
		<?php echo $form->error($model,'i18n'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
		
<?php $this->endWidget(); ?>
</div><!-- form -->

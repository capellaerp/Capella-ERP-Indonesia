<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'snrodet-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'snro/write',
	'isCancel'=>true,'UrlCancel'=>'snro/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'snrodid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'snroid'); ?>
    <?php echo $form->dropDownList($model,'snroid', CHtml::listData(Snro::model()->findAll(), 'snroid', 'description'),
      array('prompt' => 'Select a Specific Number Range Object')); ?>
		<?php echo $form->error($model,'snroid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'curdd'); ?>
		<?php echo $form->textField($model,'curdd'); ?>
		<?php echo $form->error($model,'curdd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'curmm'); ?>
		<?php echo $form->textField($model,'curmm'); ?>
		<?php echo $form->error($model,'curmm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'curyy'); ?>
		<?php echo $form->textField($model,'curyy'); ?>
		<?php echo $form->error($model,'curyy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'curvalue'); ?>
		<?php echo $form->textField($model,'curvalue'); ?>
		<?php echo $form->error($model,'curvalue'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'levelorg/write',
	'isCancel'=>true,'UrlCancel'=>'levelorg/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'levelorgid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'levelorgname'); ?>
		<?php echo $form->textField($model,'levelorgname'); ?>
		<?php echo $form->error($model,'levelorgname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
    <?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

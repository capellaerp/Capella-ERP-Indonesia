<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'splettertype/write',
	'isCancel'=>true,'UrlCancel'=>'splettertype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'splettertypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'splettername'); ?>
		<?php echo $form->textField($model,'splettername'); ?>
		<?php echo $form->error($model,'splettername'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'validperiod'); ?>
		<?php echo $form->textField($model,'validperiod'); ?>
		<?php echo $form->error($model,'validperiod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
    <?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

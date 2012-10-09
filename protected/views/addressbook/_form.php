<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'addressbook-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'addressbook/write',
	'isCancel'=>true,'UrlCancel'=>'addressbook/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'addressbookid'); ?>
	<?php echo $form->errorSummary($model); ?>
<table>
<tr>
	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>
</tr>
<tr>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'iscustomer'); ?>
		<?php echo $form->checkBox($model,'iscustomer'); ?>
		<?php echo $form->error($model,'iscustomer'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isemployee'); ?>
		<?php echo $form->checkBox($model,'isemployee'); ?>
		<?php echo $form->error($model,'isemployee'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isapplicant'); ?>
		<?php echo $form->checkBox($model,'isapplicant'); ?>
		<?php echo $form->error($model,'isapplicant'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isvendor'); ?>
		<?php echo $form->checkBox($model,'isvendor'); ?>
		<?php echo $form->error($model,'isvendor'); ?>
	</div>
</td>
</tr>
<tr>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isinsurance'); ?>
		<?php echo $form->checkBox($model,'isinsurance'); ?>
		<?php echo $form->error($model,'isinsurance'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isbank'); ?>
		<?php echo $form->checkBox($model,'isbank'); ?>
		<?php echo $form->error($model,'isbank'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'ishospital'); ?>
		<?php echo $form->checkBox($model,'ishospital'); ?>
		<?php echo $form->error($model,'ishospital'); ?>
	</div>
</td>
<td>

		<div class="row">
		<?php echo $form->labelEx($model,'iscatering'); ?>
		<?php echo $form->checkBox($model,'iscatering'); ?>
		<?php echo $form->error($model,'iscatering'); ?>
	</div>
</td>
</tr>
<tr>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'isstudent'); ?>
		<?php echo $form->checkBox($model,'isstudent'); ?>
		<?php echo $form->error($model,'isstudent'); ?>
	</div>
</td>
</tr>
<tr>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'taxno'); ?>
		<?php echo $form->textField($model,'taxno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'taxno'); ?>
	</div>
</td>
<td>
    	<div class="row">
		<?php echo $form->labelEx($model,'abno'); ?>
		<?php echo $form->textField($model,'abno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'abno'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
</td>
</tr>
</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
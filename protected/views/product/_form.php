<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'product/write',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'productid'); ?>
     
				<?php echo $form->labelEx($model,'productname'); ?>
				<?php echo $form->textField($model,'productname'); ?>
				<?php echo $form->error($model,'productname'); ?>
				
				<?php echo $form->labelEx($model,'isstock'); ?>
				<?php echo $form->checkBox($model,'isstock'); ?>
				<?php echo $form->error($model,'isstock'); ?>
				<?php echo $form->labelEx($model,'recordstatus'); ?>
				<?php echo $form->checkBox($model,'recordstatus'); ?>
				<?php echo $form->error($model,'recordstatus'); ?>

				
<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
         'Basic' => array('content' => $this->renderPartial('indexbasic',
			 array('productbasic'=>$productbasic),true)),
         'Plant' => array('content' => $this->renderPartial('indexplant',
			 array('productplant'=>$productplant),true)),
         'Purchase' => array('content' => $this->renderPartial('indexpurchase',
			 array('productpurchase'=>$productpurchase),true)),
         'Accounting' => array('content' => $this->renderPartial('indexacc',
			 array('productacc'=>$productacc),true)),
         'Conversion' => array('content' => $this->renderPartial('indexconversion',
			 array('productconversion'=>$productconversion),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->

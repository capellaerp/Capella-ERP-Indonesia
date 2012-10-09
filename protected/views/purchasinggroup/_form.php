<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchasinggroup-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'purchasinggroup/write',
	'isCancel'=>true,'UrlCancel'=>'purchasinggroup/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'purchasinggroupid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'purchasingorgid'); ?>
<?php echo $form->hiddenField($model,'purchasingorgid'); ?>
	  <input type="text" name="purchasingorgcode" id="purchasingorgcode" readonly value="<?php echo (Purchasingorg::model()->findByPk($model->purchasingorgid)!==null)?Purchasingorg::model()->findByPk($model->purchasingorgid)->purchasingorgcode:'';?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'purchasingorg_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Purchasing Organization'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'absschedule-grid',
      'dataProvider'=>$purchasingorg->Searchwstatus(),
      'filter'=>$purchasingorg,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#purchasingorg_dialog\").dialog(\"close\"); $(\"#purchasingorgcode\").val(\"$data->purchasingorgcode\"); $(\"#Purchasinggroup_purchasingorgid\").val(\"$data->purchasingorgid\");
		  "))',
          ),
	array('name'=>'purchasingorgid', 'visible'=>false,'value'=>'$data->purchasingorgid','htmlOptions'=>array('width'=>'1%')),
        'purchasingorgcode',
        'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#purchasingorg_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'purchasingorgid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchasinggroupcode'); ?>
		<?php echo $form->textField($model,'purchasinggroupcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'purchasinggroupcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
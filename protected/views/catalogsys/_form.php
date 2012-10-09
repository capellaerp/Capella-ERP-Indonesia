<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalogsys-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'catalogsys/write',
	'isCancel'=>true,'UrlCancel'=>'catalogsys/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'catalogsysid'); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'languageid'); ?>
		<?php echo $form->hiddenField($model,'languageid'); ?>
	  <input type="text" name="languagename" id="languagename" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'absschedule_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Absence Schedules'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'absschedule-grid',
      'dataProvider'=>$language->Searchwstatus(),
      'filter'=>$language,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#absschedule_dialog\").dialog(\"close\"); $(\"#languagename\").val(\"$data->languagename\"); $(\"#Catalogsys_languageid\").val(\"$data->languageid\");
		  "))',
          ),
          array('name'=>'languageid', 'visible'=>false,
        'value'=>'$data->languageid','htmlOptions'=>array('width'=>'1%')),
        'languagename',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("absschedule-grid");$("#absschedule_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'languageid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catalogname'); ?>
		<?php echo $form->textField($model,'catalogname',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'catalogname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catalogval'); ?>
		<?php echo $form->textArea($model,'catalogval',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'catalogval'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
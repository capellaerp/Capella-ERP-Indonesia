<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'city/write',
	'isCancel'=>true,'UrlCancel'=>'city/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'cityid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'provinceid'); ?>
    <?php echo $form->hiddenField($model,'provinceid'); ?>
	  <input type="text" name="provincename" id="provincename" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'catering_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Province'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'province-grid',
      'dataProvider'=>$province->Searchwstatus(),
      'filter'=>$province,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#catering_dialog\").dialog(\"close\"); $(\"#provincename\").val(\"$data->provincename\"); $(\"#City_provinceid\").val(\"$data->provinceid\");
		  "))',
          ),
	array('name'=>'provinceid', 'visible'=>false,
        'value'=>'$data->provinceid','htmlOptions'=>array('width'=>'1%')),
        'provincename',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("province-grid");$("#catering_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'provinceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityname'); ?>
		<?php echo $form->textField($model,'cityname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cityname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kelurahan-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'kelurahan/write',
	'isCancel'=>true,'UrlCancel'=>'kelurahan/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'kelurahanid'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kelurahanname'); ?>
		<?php echo $form->textField($model,'kelurahanname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'kelurahanname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subdistrictid'); ?>
    <?php echo $form->hiddenField($model,'subdistrictid'); ?>
	  <input type="text" name="subdistrictname" id="subdistrictname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'subdistrict_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Subdistrict'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'subdistrict-grid',
      'dataProvider'=>$subdistrict->Searchwstatus(),
      'filter'=>$subdistrict,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_subdistrict",
          "id" => "send_subdistrict",
          "onClick" => "$(\"#subdistrict_dialog\").dialog(\"close\"); $(\"#subdistrictname\").val(\"$data->subdistrictname\"); $(\"#Kelurahan_subdistrictid\").val(\"$data->subdistrictid\");
		  "))',
          ),
	array('name'=>'subdistrictid', 'visible'=>false,'value'=>'$data->subdistrictid','htmlOptions'=>array('width'=>'1%')),
        'subdistrictname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("subdistrict-grid");$("#subdistrict_dialog").dialog("open"); return false;',
                       ))?>
 		<?php echo $form->error($model,'subdistrictid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkbox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
		
<?php $this->endWidget(); ?>
</div><!-- form -->
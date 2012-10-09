<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'wfstatus/write',
	'isCancel'=>true,'UrlCancel'=>'wfstatus/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'wfstatusid'); ?>
  <div class="row">
		<?php echo $form->labelEx($model,'workflowid'); ?>
<?php echo $form->hiddenField($model,'workflowid'); ?>
                  <input type="text" name="wfname" id="wfname" readonly >
                  <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                     array(   'id'=>'workflow_dialog',
                              // additional javascript options for the dialog plugin
                              'options'=>array(
                                              'title'=>Yii::t('app','Workflow'),
                                              'width'=>'auto',
                                              'autoOpen'=>false,
                                              'modal'=>true,
                                              ),
                                      ));
$workflow=new Workflow('search');
                  $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'workflow-grid',
                    'dataProvider'=>$workflow->Searchwstatus(),
                    'filter'=>$workflow,
                    'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                    'columns'=>array(
                      array(
                        'header'=>'',
                        'type'=>'raw',
                      /* Here is The Button that will send the Data to The MAIN FORM */
                        'value'=>'CHtml::Button("+",
                        array("name" => "send_workflow",
                        "id" => "send_workflow",
                        "onClick" => "$(\"#workflow_dialog\").dialog(\"close\"); $(\"#wfname\").val(\"$data->wfname\"); $(\"#Wfstatus_workflowid\").val(\"$data->workflowid\");"))',
                        ),
	array('name'=>'workflowid', 'visible'=>false,'value'=>'$data->workflowid','htmlOptions'=>array('width'=>'1%')),
                      'wfname',
                      ),
                  ));

                  $this->endWidget('zii.widgets.jui.CJuiDialog');
                  echo CHtml::Button('...',
                                        array('onclick'=>'$.fn.yiiGridView.update("workflow-grid");$("#workflow_dialog").dialog("open"); return false;',
                                     ));?>		<?php echo $form->error($model,'workflowid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'wfstat'); ?>
		<?php echo $form->textField($model,'wfstat'); ?>
		<?php echo $form->error($model,'wfstat'); ?>
	</div>
  
  	<div class="row">
		<?php echo $form->labelEx($model,'wfstatusname'); ?>
		<?php echo $form->textField($model,'wfstatusname'); ?>
		<?php echo $form->error($model,'wfstatusname'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

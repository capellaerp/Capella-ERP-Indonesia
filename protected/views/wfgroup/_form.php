<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wfgroup-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'wfgroup/write',
	'isCancel'=>true,'UrlCancel'=>'wfgroup/cancelwrite'
));
?>
</div> 
		<?php echo $form->hiddenField($model,'wfgroupid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groupaccessid'); ?>
<?php echo $form->hiddenField($model,'groupaccessid'); ?>
    <input type="text" name="groupname" id="groupname" readonly >
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'groupaccess_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Group Access'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'groupaccess-grid',
        'dataProvider'=>$groupaccess->searchwstatus(),
        'filter'=>$groupaccess,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#groupaccess_dialog\").dialog(\"close\"); $(\"#groupname\").val(\"$data->groupname\"); $(\"#Wfgroup_groupaccessid\").val(\"$data->groupaccessid\");"))',
          ),
	array('name'=>'groupaccessid', 'visible'=>false,'value'=>'$data->groupaccessid','htmlOptions'=>array('width'=>'1%')),
          'groupname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("groupaccess-grid");$("#groupaccess_dialog").dialog("open"); return false;',
                       ))?>		<?php echo $form->error($model,'groupaccessid'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'workflowid'); ?>
<?php echo $form->hiddenField($model,'workflowid'); ?>
    <input type="text" name="wfdesc" id="wfdesc" readonly >
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'workflow_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Group Access'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'workflow-grid',
        'dataProvider'=>$workflow->searchwstatus(),
        'filter'=>$workflow,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#workflow_dialog\").dialog(\"close\"); $(\"#wfdesc\").val(\"$data->wfdesc\"); $(\"#Wfgroup_workflowid\").val(\"$data->workflowid\");"))',
          ),
	array('name'=>'workflowid', 'visible'=>false,'value'=>'$data->workflowid','htmlOptions'=>array('width'=>'1%')),
          'wfdesc',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("workflow-grid");$("#workflow_dialog").dialog("open"); return false;',
                       ))?>		<?php echo $form->error($model,'workflowid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wfbefstat'); ?>
		<?php echo $form->textField($model,'wfbefstat'); ?>
		<?php echo $form->error($model,'wfbefstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wfrecstat'); ?>
		<?php echo $form->textField($model,'wfrecstat'); ?>
		<?php echo $form->error($model,'wfrecstat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absschedule-form'
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'jobs/write',
	'isCancel'=>true,'UrlCancel'=>'jobs/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'jobsid'); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'orgstructureid'); ?>
    <?php echo $form->hiddenField($model,'orgstructureid'); ?>
    <input type="text" name="structurename" id="structurename" readonly value="<?php
echo (Orgstructure::model()->findByPk($model->orgstructureid)!==null)?Orgstructure::model()->findByPk($model->orgstructureid)->structurename :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'absstatus_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Organization Structure'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'absstatus-grid',
        'dataProvider'=>$orgstructure->searchwstatus(),
        'filter'=>$orgstructure,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#absstatus_dialog\").dialog(\"close\"); $(\"#structurename\").val(\"$data->structurename\"); $(\"#Jobs_orgstructureid\").val(\"$data->orgstructureid\");"))',
          ),
	array('name'=>'orgstructureid', 'visible'=>false,'value'=>'$data->orgstructureid','htmlOptions'=>array('width'=>'1%')),
          'structurename',
          array(
            'class'=>'CCheckBoxColumn',
            'name'=>'recordstatus',
            'selectableRows'=>'0',
            'header'=>'Record Status',
            'checked'=>'$data->recordstatus'
          ),
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#absstatus_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'orgstructureid'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'positionid'); ?>
    <?php echo $form->hiddenField($model,'positionid'); ?>
    <input type="text" name="positionname" id="positionname" readonly value="<?php
echo (Position::model()->findByPk($model->positionid)!==null)?Position::model()->findByPk($model->positionid)->positionname :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'position_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Organization Structure'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'absstatus-grid',
        'dataProvider'=>$position->searchwstatus(),
        'filter'=>$position,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#position_dialog\").dialog(\"close\"); $(\"#positionname\").val(\"$data->positionname\"); $(\"#Jobs_positionid\").val(\"$data->positionid\");"))',
          ),
	array('name'=>'positionid', 'visible'=>false,'value'=>'$data->positionid','htmlOptions'=>array('width'=>'1%')),
          'positionname',
          array(
            'class'=>'CCheckBoxColumn',
            'name'=>'recordstatus',
            'selectableRows'=>'0',
            'header'=>'Record Status',
            'checked'=>'$data->recordstatus'
          ),
          array(
            'class'=>'CButtonColumn',
          ),
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#position_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'positionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jobdesc'); ?>
		<?php echo $form->textArea($model,'jobdesc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'jobdesc'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'qualification'); ?>
		<?php echo $form->textArea($model,'qualification',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'qualification'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
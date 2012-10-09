<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'absrule/write',
	'isCancel'=>true,'UrlCancel'=>'absrule/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'absruleid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'absscheduleid'); ?>
    <?php echo $form->hiddenField($model,'absscheduleid'); ?>
	  <input type="text" name="sched_name" id="sched_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->absscheduleid)!==null)?Absschedule::model()->findByPk($model->absscheduleid)->absschedulename:''; ?>">
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
      'dataProvider'=>$absschedule->Searchwstatus(),
      'filter'=>$absschedule,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#absschedule_dialog\").dialog(\"close\"); $(\"#sched_name\").val(\"$data->absschedulename\"); $(\"#Absrule_absscheduleid\").val(\"$data->absscheduleid\");
		  "))',
          ),
	array('name'=>'absscheduleid', 'visible'=>false,
        'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
        'absschedulename',
        'absin',
        'absout',
        array('name'=>'absstatusid', 'header'=>'Status','value'=>'$data->absstatus->shortstat'),
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
                          array('onclick'=>'$("#absschedule_dialog").dialog("open"); return false;',
                       ))?>
 		<?php echo $form->error($model,'absscheduleid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'difftimein'); ?>
    <?php $this->widget('CMaskedTextField', array(
'mask' => '99:99',
'model' => $model,
'attribute' => 'difftimein',
        'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'5',
              ),
));?>
		<?php echo $form->error($model,'difftimein'); ?>
	</div>
  
  <div class="row">
		<?php echo $form->labelEx($model,'difftimeout'); ?>
    <?php $this->widget('CMaskedTextField', array(
'mask' => '99:99',
'model' => $model,
'attribute' => 'difftimeout',
        'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'5',
              ),
));?>
		<?php echo $form->error($model,'difftimeout'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'absstatusid'); ?>
    <?php echo $form->hiddenField($model,'absstatusid'); ?>
    <input type="text" name="stat_name" id="stat_name" readonly value="<?php echo (Absstatus::model()->findByPk($model->absstatusid)!==null)?Absstatus::model()->findByPk($model->absstatusid)->shortstat:'';?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'absstatus_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Absence Status'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'absstatus-grid',
        'dataProvider'=>$absstatus->searchwstatus(),
        'filter'=>$absstatus,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#absstatus_dialog\").dialog(\"close\"); $(\"#stat_name\").val(\"$data->shortstat\"); $(\"#Absrule_absstatusid\").val(\"$data->absstatusid\");"))',
          ),
	array('name'=>'absstatusid', 'visible'=>false,
        'value'=>'$data->absstatusid','htmlOptions'=>array('width'=>'1%')),
          'shortstat',
          'longstat',
          array('class'=>'CCheckBoxColumn',
            'name'=>'isin',
            'header'=>'Is In',
            'checked'=>'$data->isin',
            'selectableRows'=>'0'),
          'priority',
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
                       ))
    ?>
		<?php echo $form->error($model,'absstatusid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
    <?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget();?>
</div><!-- form -->

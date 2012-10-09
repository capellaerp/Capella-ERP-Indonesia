<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absschedule-form'
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'absschedule/write',
	'isCancel'=>true,'UrlCancel'=>'absschedule/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'absscheduleid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'absschedulename'); ?>
		<?php echo $form->textField($model,'absschedulename',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'absschedulename'); ?>
	</div>
  
<div class="row">
		<?php echo $form->labelEx($model,'absin'); ?>
    <?php $this->widget('CMaskedTextField', array(
'mask' => '99:99',
'model' => $model,
'attribute' => 'absin',
        'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'5',
              ),
));?>
		<?php echo $form->error($model,'absin'); ?>
	</div>
	
<div class="row">
		<?php echo $form->labelEx($model,'absout'); ?>
    <?php $this->widget('CMaskedTextField', array(
'mask' => '99:99',
'model' => $model,
'attribute' => 'absout',
        'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'5',
              ),
));?>
		<?php echo $form->error($model,'absout'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'absstatusid'); ?>
    <?php echo $form->hiddenField($model,'absstatusid'); ?>
    <input type="text" name="stat_name" id="stat_name" readonly value="<?php 
echo (Absstatus::model()->findByPk($model->absstatusid)!==null)?Absstatus::model()->findByPk($model->absstatusid)->shortstat :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
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
          "onClick" => "$(\"#absstatus_dialog\").dialog(\"close\"); $(\"#stat_name\").val(\"$data->shortstat\"); $(\"#Absschedule_absstatusid\").val(\"$data->absstatusid\");"))',
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
                       ))?>
    <?php echo $form->error($model,'absstatusid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
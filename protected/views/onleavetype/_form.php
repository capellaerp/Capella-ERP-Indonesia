<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'onleavetype-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'onleavetype/write',
	'isCancel'=>true,'UrlCancel'=>'onleavetype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'onleavetypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'onleavename'); ?>
		<?php echo $form->textField($model,'onleavename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'onleavename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cutimax'); ?>
		<?php echo $form->textField($model,'cutimax'); ?>
		<?php echo $form->error($model,'cutimax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cutistart'); ?>
		<?php echo $form->textField($model,'cutistart'); ?>
		<?php echo $form->error($model,'cutistart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'snroid'); ?>
		<?php echo $form->hiddenField($model,'snroid'); ?>
	  <input type="text" name="sched_name" id="description" title="Enter Schedule name" readonly value="<?php echo (Snro::model()->findByPk($model->snroid)!==null)?Snro::model()->findByPk($model->snroid)->description:''; ?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'snro_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Absence Schedules'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'snro-grid',
      'dataProvider'=>$snro->Searchwstatus(),
      'filter'=>$snro,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#snro_dialog\").dialog(\"close\"); $(\"#description\").val(\"$data->description\"); $(\"#Onleavetype_snroid\").val(\"$data->snroid\");
		  "))',
          ),
	array('name'=>'snroid', 'visible'=>false,'value'=>'$data->snroid','htmlOptions'=>array('width'=>'1%')),
        'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#snro_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'snroid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'absstatusid'); ?>
		<?php echo $form->hiddenField($model,'absstatusid'); ?>
	  <input type="text" name="sched_name" id="shortstat" title="Enter Schedule name" readonly value="<?php echo (Absstatus::model()->findByPk($model->absstatusid)!==null)?Absstatus::model()->findByPk($model->absstatusid)->shortstat:''; ?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'absstatus_dialog',
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
      'dataProvider'=>$absstatus->Searchwstatus(),
      'filter'=>$absstatus,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#absstatus_dialog\").dialog(\"close\"); $(\"#shortstat\").val(\"$data->shortstat\"); $(\"#Onleavetype_absstatusid\").val(\"$data->absstatusid\");
		  "))',
          ),
	array('name'=>'absstatusid', 'visible'=>false,'value'=>'$data->absstatusid','htmlOptions'=>array('width'=>'1%')),
        'shortstat',
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
		<?php echo $form->checkbox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
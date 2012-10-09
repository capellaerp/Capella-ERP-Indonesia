<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absrule-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'accounttype/write',
	'isCancel'=>true,'UrlCancel'=>'accounttype/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'accounttypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'accounttypename'); ?>
		<?php echo $form->textField($model,'accounttypename'); ?>
		<?php echo $form->error($model,'accounttypename'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'parentaccounttypeid'); ?>
		<?php echo $form->hiddenField($model,'parentaccounttypeid'); ?>
    <input type="text" name="parentaccounttypename" id="parentaccounttypename" readonly style="width:80%" value="
<?php echo (Accounttype::model()->findByPk($model->parentaccounttypeid)!==null)?Accounttype::model()->findByPk($model->parentaccounttypeid)->accounttypename:''; ?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'parentaccounttype_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Account Type'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'parentaccounttype-grid',
        'dataProvider'=>$parentaccounttype->searchwstatus(),
        'filter'=>$parentaccounttype,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#parentaccounttype_dialog\").dialog(\"close\");
          $(\"#parentaccounttypename\").val(\"$data->accounttypename\");
          $(\"#Accounttype_parentaccounttypeid\").val(\"$data->accounttypeid\");"))',
          ),
	array('name'=>'accounttypeid', 'visible'=>false,
        'value'=>'$data->accounttypeid','htmlOptions'=>array('width'=>'1%')),
          'accounttypename',
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
                          array('onclick'=>'$("#parentaccounttype_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'parentaccountid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
    <?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->

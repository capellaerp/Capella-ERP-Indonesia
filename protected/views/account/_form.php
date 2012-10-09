<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'account-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'account/write',
	'isCancel'=>true,'UrlCancel'=>'account/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'accountid'); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'accounttypeid'); ?>
		<?php echo $form->hiddenField($model,'accounttypeid'); ?>
    <input type="text" name="accounttypename" id="accounttypename" readonly value="
<?php echo (Accounttype::model()->findByPk($model->accounttypeid)!==null)?Accounttype::model()->findByPk($model->accounttypeid)->accounttypename:''; ?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'accounttype_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Account Type'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'accounttype-grid',
        'dataProvider'=>$accounttype->searchwstatus(),
        'filter'=>$accounttype,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#accounttype_dialog\").dialog(\"close\");
          $(\"#accounttypename\").val(\"$data->accounttypename\");
          $(\"#Account_accounttypeid\").val(\"$data->accounttypeid\");"))',
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
                          array('onclick'=>'$("#accounttype_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'parentaccountid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accountname'); ?>
		<?php echo $form->textField($model,'accountname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'accountname'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'accountcode'); ?>
		<?php echo $form->textField($model,'accountcode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'accountcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parentaccountid'); ?>
		<?php echo $form->hiddenField($model,'parentaccountid'); ?>
    <input type="text" name="parentaccountname" id="parentaccountname" readonly value="<?php echo (Account::model()->findByPk($model->accountid)!==null)?Account::model()->findByPk($model->accountid)->accountcode:''; ?>">
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'parentaccountcode_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Absence Status'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'parentaccountcode-grid',
        'dataProvider'=>$parentaccount->searchwstatus(),
        'filter'=>$parentaccount,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#parentaccountcode_dialog\").dialog(\"close\"); $(\"#parentaccountname\").val(\"$data->accountcode\"); $(\"#Account_parentaccountid\").val(\"$data->accountid\");"))',
          ),
	array('name'=>'accountid', 'visible'=>false,
        'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
            'accountcode',
          'accountname',
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
                          array('onclick'=>'$("#parentaccountcode_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'parentaccountid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currencyid'); ?>
		<?php echo $form->hiddenField($model,'currencyid'); ?>
    <input type="text" name="currencyname" id="currencyname" readonly value="<?php echo (Currency::model()->findByPk($model->currencyid)!==null)?Currency::model()->findByPk($model->currencyid)->currencyname:''; ?>">    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'currencyname_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Absence Status'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'currency-grid',
        'dataProvider'=>$currency->searchwstatus(),
        'filter'=>$currency,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#currencyname_dialog\").dialog(\"close\"); $(\"#currencyname\").val(\"$data->currencyname\"); $(\"#Account_currencyid\").val(\"$data->currencyid\");"))',
          ),
	array('name'=>'currencyid', 'visible'=>false,
        'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
          'currencyname',
		  'country.countryname',
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
                          array('onclick'=>'$("#currencyname_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'currencyid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
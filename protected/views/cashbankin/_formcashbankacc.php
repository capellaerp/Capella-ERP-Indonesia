<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog2',
	'DialogGrid'=>'detail2datagrid',
	'isSave'=>true,'UrlSave'=>'cashbankin/writecashbankacc',
	'isCancel'=>true,'UrlCancel'=>'cashbankin/cancelwritecashbankacc'
));
?>
<?php echo $form->hiddenField($model,'cashbankaccid'); ?>
<?php echo $form->hiddenField($model,'cashbankid'); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'accountid'); ?>
<?php echo $form->hiddenField($model,'accountid'); ?>
	  <input type="text" name="account_name" id="account_name" title="Account name" readonly >    
<?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'cbaccount_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Account'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$account=new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'cbaccount-grid',
      'dataProvider'=>$account->Searchwstatus(),
      'filter'=>$account,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#cbaccount_dialog\").dialog(\"close\"); 
		  $(\"#account_name\").val(\"$data->accountname\"); 
		  $(\"#Cashbankacc_accountid\").val(\"$data->accountid\");
		  "))',
          ),
		  	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
        'accountcode',
        'accountname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#cbaccount_dialog").dialog("open"); return false;',
                       ))?>		
		<?php echo $form->error($model,'accountid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
		<?php echo $form->error($model,'debit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credit'); ?>
		<?php echo $form->textField($model,'credit'); ?>
		<?php echo $form->error($model,'credit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currencyid'); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?>
	  <input type="text" name="invacccurrencyname" id="invacccurrencyname" title="Account name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'invacccurrency_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Currency'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$currency=new Currency('searchwstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'invacccurrency-grid',
      'dataProvider'=>$currency->Searchwstatus(),
      'filter'=>$currency,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#invacccurrency_dialog\").dialog(\"close\"); 
		  $(\"#invacccurrencyname\").val(\"$data->currencyname\"); 
		  $(\"#Cashbankacc_currencyid\").val(\"$data->currencyid\");
		  "))',
          ),
		  	array('name'=>'currencyid', 'visible'=>false,'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
        'currencyname',
        'symbol',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#invacccurrency_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'currencyid'); ?>
	</div>

    	<div class="row">
		<?php echo $form->labelEx($model,'currencyrate'); ?>
		<?php echo $form->textField($model,'currencyrate'); ?>
		<?php echo $form->error($model,'currencyrate'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('cols'=>10,'rows'=>5)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
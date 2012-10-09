<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'cashbankin/write',
	'isCancel'=>true,'UrlCancel'=>'cashbankin/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'cashbankid'); ?>
     
	<table class="table-condensed" style="width:100%">
	<tr> 
			<td>
		<div class="row">
          <?php echo $form->labelEx($model,'transdate'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'transdate',
              'model'=>$model,
              // additional javascript options for the date picker plugin
             'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'-10:+10'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'10',
              ),
          ));?>          <?php echo $form->error($model,'transdate'); ?>
        </div>
		</td>
		<td>
		<?php echo $form->labelEx($model,'invoiceid'); ?>
    <?php echo $form->hiddenField($model,'invoiceid'); ?>
    <input type="text" name="invoiceno" id="invoiceno" readonly >
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'invoice_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Invoice'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$invoice=new Invoice('searchwfstatus');
	  $invoice->unsetAttributes();  // clear any default values
	  if(isset($_GET['Invoice']))
		$invoice->attributes=$_GET['Invoice'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'invoice-grid',
        'dataProvider'=>$invoice->searchwfarstatus(),
        'filter'=>$invoice,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#invoice_dialog\").dialog(\"close\"); $(\"#invoiceno\").val(\"$data->invoiceno\"); 
		  $(\"#Cashbank_invoiceid\").val(\"$data->invoiceid\");"))',
          ),
	array('name'=>'invoiceid', 'visible'=>false,
        'value'=>'$data->invoiceid','htmlOptions'=>array('width'=>'1%')),
          'invoiceno',
		  array('name'=>'addressbookid', 'value'=>'($data->customer!==null)?$data->customer->fullname:""'),
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#invoice_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'addressbookid'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'accountid'); ?>
    <?php echo $form->hiddenField($model,'accountid'); ?>
    <input type="text" name="accountname" id="accountname" readonly >
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'account_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Account'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$account=new Account('searchwfstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'account-grid',
        'dataProvider'=>$account->searchwstatus(),
        'filter'=>$account,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#account_dialog\").dialog(\"close\"); $(\"#accountname\").val(\"$data->accountname\"); 
		  $(\"#Cashbank_accountid\").val(\"$data->accountid\");"))',
          ),
	array('name'=>'accountid', 'visible'=>false,
        'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
          'accountname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#account_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'accountid'); ?>
		</td>
		</tr>
		<tr>
<td>
		<div class="row">
          <?php echo $form->labelEx($model,'amount'); ?>
          <?php echo $form->textField($model,'amount'); ?>
          <?php echo $form->error($model,'amount'); ?>
        </div>
		</td>
		<td>
		<?php echo $form->labelEx($model,'currencyid'); ?>
    <?php echo $form->hiddenField($model,'currencyid'); ?>
    <input type="text" name="currencyname" id="currencyname" readonly>
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'currency_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Currency'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$currency=new Currency('searchwfstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];
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
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#currency_dialog\").dialog(\"close\"); $(\"#currencyname\").val(\"$data->currencyname\"); 
		  $(\"#Cashbank_currencyid\").val(\"$data->currencyid\");"))',
          ),
	array('name'=>'currencyid', 'visible'=>false,
        'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
          'currencyname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#currency_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'currencyid'); ?>
		</td>
		<td>
		<div class="row">
          <?php echo $form->labelEx($model,'currencyrate'); ?>
          <?php echo $form->textField($model,'currencyrate'); ?>
          <?php echo $form->error($model,'currencyrate'); ?>
        </div>
		</td>		
		<td>
		<div class="row">
          <?php echo $form->labelEx($model,'description'); ?>
          <?php echo $form->textArea($model,'description'); ?>
          <?php echo $form->error($model,'description'); ?>
        </div>
		</td>		
	</tr>
	</table>
<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
         'Journal' => array('content' => $this->renderPartial('indexcashbankacc',
			 array('cashbankacc'=>$cashbankacc),true)),
/*         'Informal' => array('content' => $this->renderPartial('indexinformal',
			 array('employeeinformal'=>$employeeinformal),true)),
         'Working Experience' => array('content' => $this->renderPartial('indexwo',
			 array('employeewo'=>$employeewo),true)),
         'Family' => array('content' => $this->renderPartial('indexfamily',
			 array('employeefamily'=>$employeefamily),true)),*/
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->

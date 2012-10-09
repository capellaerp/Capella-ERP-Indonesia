<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'supplier/write',
	'isCancel'=>true,'UrlCancel'=>'supplier/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'addressbookid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'taxno'); ?>
		<?php echo $form->textField($model,'taxno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'taxno'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'acchutangid'); ?>
<?php echo $form->hiddenField($model,'acchutangid'); ?>
          <input type="text" name="acchutangname" id="acchutangname" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'account_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Account'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'account-grid',
            'dataProvider'=>$account->Searchwstatus(),
            'filter'=>$account,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#account_dialog\").dialog(\"close\"); $(\"#acchutangname\").val(\"$data->accountname\"); $(\"#Supplier_acchutanghid\").val(\"$data->accountid\");"))',
                ),
		  	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
              'accountcode',
                'accountname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$.fn.yiiGridView.update("account-grid");$("#account_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'acchutangid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>

<?php $this->endWidget(); ?>
<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'Address' => array('content' => $this->renderPartial('indexaddress',
			array('supplieraddress'=>$supplieraddress),true)),
		'Contact' => array('content' => $this->renderPartial('indexcontact',
			array('suppliercontact'=>$suppliercontact),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->

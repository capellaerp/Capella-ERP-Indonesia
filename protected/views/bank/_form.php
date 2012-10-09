<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bank-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'bank/write',
	'isCancel'=>true,'UrlCancel'=>'bank/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'addressbookid'); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
		<?php echo $form->labelEx($model,'accpiutangid'); ?>
<?php echo $form->hiddenField($model,'accpiutangid'); ?>
          <input type="text" name="accpiutangname" id="accpiutangname" readonly value="<?php
echo (Account::model()->findByPk($model->accpiutangid)!==null)?Account::model()->findByPk($model->accpiutangid)->accountname:'';?>">
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
                "onClick" => "$(\"#account_dialog\").dialog(\"close\"); $(\"#accpiutangname\").val(\"$data->accountname\"); $(\"#Bank_accpiutangid\").val(\"$data->accountid\");"))',
                ),
              'accountid',
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
                                array('onclick'=>'$("#account_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'accpiutangid'); ?>
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
			array('bankaddress'=>$bankaddress),true)),
		'Contact' => array('content' => $this->renderPartial('indexcontact',
			array('bankcontact'=>$bankcontact),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->

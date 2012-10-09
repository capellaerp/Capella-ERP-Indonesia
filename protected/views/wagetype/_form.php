<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wagetype-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'wagetype/write',
	'isCancel'=>true,'UrlCancel'=>'wagetype/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'wagetypeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'wagename'); ?>
		<?php echo $form->textField($model,'wagename',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'wagename'); ?>
	</div>

    	<div class="row">
		<?php echo $form->labelEx($model,'ispph'); ?>
		<?php echo $form->checkbox($model,'ispph'); ?>
		<?php echo $form->error($model,'ispph'); ?>
	</div>

        	<div class="row">
		<?php echo $form->labelEx($model,'ispayroll'); ?>
		<?php echo $form->checkbox($model,'ispayroll'); ?>
		<?php echo $form->error($model,'ispayroll'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'isprint'); ?>
		<?php echo $form->checkbox($model,'isprint'); ?>
		<?php echo $form->error($model,'isprint'); ?>
	</div>

   	<div class="row">
		<?php echo $form->labelEx($model,'percentage'); ?>
		<?php echo $form->textField($model,'percentage'); ?>
		<?php echo $form->error($model,'percentage'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'maxvalue'); ?>
		<?php echo $form->textField($model,'maxvalue'); ?>
		<?php echo $form->error($model,'maxvalue'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'currencyid'); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?>
                  <input type="text" name="currency_name" id="currency_name" readonly value="<?php echo (Currency::model()->findByPk($model->currencyid)!==null)?Currency::model()->findByPk($model->currencyid)->currencyname:''; ?>">
                  <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                     array(   'id'=>'currency_dialog',
                              // additional javascript options for the dialog plugin
                              'options'=>array(
                                              'title'=>Yii::t('app','Currency'),
                                              'width'=>'auto',
                                              'autoOpen'=>false,
                                              'modal'=>true,
                                              ),
                                      ));
$employee=new Currency('searchwstatus');
	  $employee->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$employee->attributes=$_GET['Currency'];
                  $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'employee-grid',
                    'dataProvider'=>$employee->Searchwstatus(),
                    'filter'=>$employee,
                    'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                    'columns'=>array(
                      array(
                        'header'=>'',
                        'type'=>'raw',
                      /* Here is The Button that will send the Data to The MAIN FORM */
                        'value'=>'CHtml::Button("+",
                        array("name" => "send_employee",
                        "id" => "send_employee",
                        "onClick" => "$(\"#currency_dialog\").dialog(\"close\"); $(\"#currency_name\").val(\"$data->currencyname\"); $(\"#Wagetype_currencyid\").val(\"$data->currencyid\");"))',
                        ),
	array('name'=>'currencyid', 'visible'=>false,'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
                      'currencyname',
                      ),
                  ));

                  $this->endWidget('zii.widgets.jui.CJuiDialog');
                  echo CHtml::Button('...',
                                        array('onclick'=>'$("#currency_dialog").dialog("open"); return false;',
                                     ));?>		<?php echo $form->error($model,'employeeid'); ?>
	</div>

	
		<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
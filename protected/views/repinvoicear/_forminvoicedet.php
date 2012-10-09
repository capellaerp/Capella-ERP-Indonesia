<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog1',
	'DialogGrid'=>'detail1datagrid',
	'isSave'=>true,'UrlSave'=>'invoicear/writeinvoicedet',
	'isCancel'=>true,'UrlCancel'=>'invoicear/cancelwriteinvoicedet'
));
?>
<?php echo $form->hiddenField($model,'invoicedetid'); ?>
<?php echo $form->hiddenField($model,'invoiceid'); ?>
    <table class="table-condensed" style="width:100%">
    <tr>
	<td>
        <div class="row">
		<?php echo $form->labelEx($model,'itemname'); ?>
		<?php echo $form->textField($model,'itemname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'itemname'); ?>
	</div>
      </td>
		<td>
        <div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>
      </td>
	  <td>
        <div class="row">
		<?php echo $form->labelEx($model,'unitofmeasureid'); ?>
    <?php echo $form->hiddenField($model,'unitofmeasureid'); ?>
          <input type="text" name="uomcode" id="uomcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'uom_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Unit of Measure'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$uom = new Unitofmeasure('searchwstatus');
	  $uom->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$uom->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'uom-grid',
            'dataProvider'=>$uom->Searchwstatus(),
            'filter'=>$uom,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_city",
                "id" => "send_city",
                "onClick" => "$(\"#uom_dialog\").dialog(\"close\"); $(\"#uomcode\").val(\"$data->uomcode\"); 
				$(\"#Invoicedet_unitofmeasureid\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#uom_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
      </td>
	  </tr>
	  <tr>
	        <td>
        <div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
      </td>
	  <td>
        <div class="row">
		<?php echo $form->labelEx($model,'currencyid'); ?>
    <?php echo $form->hiddenField($model,'currencyid'); ?>
          <input type="text" name="invdetcurrencyname" id="invdetcurrencyname" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'invdetcurrency_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Currency'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$currency = new Currency('searchwstatus');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'invdetcurrency-grid',
            'dataProvider'=>$currency->Searchwstatus(),
            'filter'=>$currency,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_city",
                "id" => "send_city",
                "onClick" => "$(\"#invdetcurrency_dialog\").dialog(\"close\"); $(\"#invdetcurrencyname\").val(\"$data->currencyname\"); 
				$(\"#Invoicedet_currencyid\").val(\"$data->currencyid\");"))',
                ),
	array('name'=>'currencyid', 'visible'=>false,'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
              'currencyname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#invdetcurrency_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'currencyid'); ?>
	</div>
      </td>
	  <td>
	      	<div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate'); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>
	  </td>
	  </tr>
	  <tr>
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
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog2',
	'DialogGrid'=>'contactdatagrid',
	'isSave'=>true,'UrlSave'=>'supplier/writecontact',
	'isCancel'=>true,'UrlCancel'=>'supplier/cancelwritecontact'
));
?>
<?php echo $form->hiddenField($model,'addresscontactid'); ?>
<?php echo $form->hiddenField($model,'addressbookid'); ?>
    <div class="row">
		<?php echo $form->labelEx($model,'contacttypeid'); ?>
<?php echo $form->hiddenField($model,'contacttypeid'); ?>
          <input type="text" name="contacttype_name" id="contacttype_name" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'contacttype_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Contact Type'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$contacttype = new Contacttype('searchwstatus');
	  $contacttype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Contacttype']))
		$contacttype->attributes=$_GET['Contacttype'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'contacttype-grid',
            'dataProvider'=>$contacttype->Searchwstatus(),
            'filter'=>$contacttype,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_contacttype",
                "id" => "send_contacttype",
                "onClick" => "$(\"#contacttype_dialog\").dialog(\"close\"); $(\"#contacttype_name\").val(\"$data->contacttypename\"); $(\"#Suppliercontact_contacttypeid\").val(\"$data->contacttypeid\");"))',
                ),
		  	array('name'=>'contacttypeid', 'visible'=>false,'value'=>'$data->contacttypeid','htmlOptions'=>array('width'=>'1%')),
              'contacttypename',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$.fn.yiiGridView.update("contacttype-grid");$("#contacttype_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'contacttypeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addresscontactname'); ?>
		<?php echo $form->textField($model,'addresscontactname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'addresscontactname'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'phoneno'); ?>
		<?php echo $form->textField($model,'phoneno'); ?>
		<?php echo $form->error($model,'phoneno'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'mobilephone'); ?>
		<?php echo $form->textField($model,'mobilephone'); ?>
		<?php echo $form->error($model,'mobilephone'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'emailaddress'); ?>
		<?php echo $form->textField($model,'emailaddress'); ?>
		<?php echo $form->error($model,'emailaddress'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->

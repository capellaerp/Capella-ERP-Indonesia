<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'province-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'province/write',
	'isCancel'=>true,'UrlCancel'=>'province/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'provinceid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'countryid'); ?>
<?php echo $form->hiddenField($model,'countryid'); ?>
	  <input type="text" name="countryname" id="countryname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'country_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Country'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$country=new Country('searchwstatus');
	  $country->unsetAttributes();  // clear any default values
	  if(isset($_GET['Country']))
		$country->attributes=$_GET['Country'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'product-grid',
      'dataProvider'=>$country->Searchwstatus(),
      'filter'=>$country,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#country_dialog\").dialog(\"close\"); $(\"#countryname\").val(\"$data->countryname\"); $(\"#Province_countryid\").val(\"$data->countryid\");
		  "))',
          ),
	array('name'=>'countryid', 'visible'=>false,'value'=>'$data->countryid','htmlOptions'=>array('width'=>'1%')),
        'countryname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#country_dialog").dialog("open"); return false;',
                       ))?>		<?php echo $form->error($model,'countryid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provincename'); ?>
		<?php echo $form->textField($model,'provincename',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'provincename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->

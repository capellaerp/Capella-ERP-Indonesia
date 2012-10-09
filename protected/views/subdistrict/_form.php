<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subdistrict-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'subdistrict/write',
	'isCancel'=>true,'UrlCancel'=>'subdistrict/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'subdistrictid'); ?>
<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
<?php echo $form->hiddenField($model,'cityid'); ?>
	  <input type="text" name="cityname" id="cityname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'country_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','City'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$city=new City('searchwstatus');
	  $city->unsetAttributes();  // clear any default values
	  if(isset($_GET['City']))
		$city->attributes=$_GET['City'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'city-grid',
      'dataProvider'=>$city->Searchwstatus(),
      'filter'=>$city,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#country_dialog\").dialog(\"close\"); $(\"#cityname\").val(\"$data->cityname\"); $(\"#Subdistrict_cityid\").val(\"$data->cityid\");
		  "))',
          ),
	array('name'=>'cityid', 'visible'=>false,'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
        'cityname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("city-grid");$("#country_dialog").dialog("open"); return false;',
                       ))?>		<?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subdistrictname'); ?>
		<?php echo $form->textField($model,'subdistrictname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'subdistrictname'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
		
<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog6',
	'DialogGrid'=>'detailconversiondatagrid',
	'isSave'=>true,'UrlSave'=>'product/writeconversion',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwriteconversion'
));
?>
<?php echo $form->hiddenField($model,'productconversionid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
          <div class="row">
              <?php echo $form->labelEx($model,'fromuom'); ?>
              <?php echo $form->hiddenField($model,'fromuom'); ?>
                    <input type="text" name="fromuomcode" id="fromuomcode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'fromuomcode_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Unit of Measure'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$fromuom = new Unitofmeasure('searchwstatus');
	  $fromuom->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$fromuom->attributes=$_GET['Unitofmeasure'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'fromuom-grid',
                      'dataProvider'=>$fromuom->Searchwstatus(),
                      'filter'=>$fromuom,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_conversionrelation",
                          "id" => "send_conversionrelation",
                          "onClick" => "$(\"#fromuomcode_dialog\").dialog(\"close\"); 
						  $(\"#fromuomcode\").val(\"$data->uomcode\"); 
						  $(\"#Productconversion_fromuom\").val(\"$data->unitofmeasureid\");"))',
                          ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
                        'uomcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#fromuomcode_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'fromuom'); ?>
            </div>
			
			 				<?php echo $form->labelEx($model,'fromvalue'); ?>
				<?php echo $form->textField($model,'fromvalue'); ?>
				<?php echo $form->error($model,'fromvalue'); ?>

				 <div class="row">
              <?php echo $form->labelEx($model,'touom'); ?>
              <?php echo $form->hiddenField($model,'touom'); ?>
                    <input type="text" name="touomcode" id="touomcode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'touomcode_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Unit of Measure'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$touom = new Unitofmeasure('searchwstatus');
	  $touom->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$touom->attributes=$_GET['Unitofmeasure'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'touom-grid',
                      'dataProvider'=>$touom->Searchwstatus(),
                      'filter'=>$touom,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_conversionrelation",
                          "id" => "send_conversionrelation",
                          "onClick" => "$(\"#touomcode_dialog\").dialog(\"close\"); 
						  $(\"#touomcode\").val(\"$data->uomcode\"); 
						  $(\"#Productconversion_touom\").val(\"$data->unitofmeasureid\");"))',
                          ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
                        'uomcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#touomcode_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'touom'); ?>
            </div>
			
			<?php echo $form->labelEx($model,'tovalue'); ?>
				<?php echo $form->textField($model,'tovalue'); ?>
				<?php echo $form->error($model,'tovalue'); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->

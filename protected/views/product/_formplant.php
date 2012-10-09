<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
'DialogID'=>'createdialog2',
	'DialogGrid'=>'detailplantdatagrid',
	'isSave'=>true,'UrlSave'=>'product/writeplant',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwriteplant'
));
?>
<?php echo $form->hiddenField($model,'productplantid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'slocid'); ?>
    <?php echo $form->hiddenField($model,'slocid'); ?>
    <input type="text" name="sloccode" id="sloccode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'sloc_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Storage Location (Sloc)'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$sloc = new Sloc('searchwstatus');
	  $sloc->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sloc']))
		$sloc->attributes=$_GET['Sloc'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'sloc-grid',
            'dataProvider'=>$sloc->Searchwstatus(),
            'filter'=>$sloc,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_education",
                "id" => "send_education",
                "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); 
				$(\"#sloccode\").val(\"$data->sloccode\"); 
				$(\"#Productplant_slocid\").val(\"$data->slocid\");"))',
                ),
	array('name'=>'slocid', 'visible'=>false,'value'=>'$data->slocid','htmlOptions'=>array('width'=>'1%')),
              'sloccode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#sloc_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'slocid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'unitofissue'); ?>
    <?php echo $form->hiddenField($model,'unitofissue'); ?>
    <input type="text" name="unitofissuecode" id="unitofissuecode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'unitofissue_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Unit of Measurement'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$unitofissue = new Unitofmeasure('searchwstatus');
	  $unitofissue->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$unitofissue->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'unitofissue-grid',
            'dataProvider'=>$unitofissue->Searchwstatus(),
            'filter'=>$unitofissue,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_education",
                "id" => "send_education",
                "onClick" => "$(\"#unitofissue_dialog\").dialog(\"close\"); 
				$(\"#unitofissuecode\").val(\"$data->uomcode\"); 
				$(\"#Productplant_unitofissue\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#unitofissue_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'unitofissue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isautolot'); ?>
		<?php echo $form->checkbox($model,'isautolot'); ?>
		<?php echo $form->error($model,'isautolot'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->labelEx($model,'storagebin'); ?>
		<?php echo $form->textField($model,'storagebin'); ?>
		<?php echo $form->error($model,'storagebin'); ?>
	</div>

	    	<div class="row">
		<?php echo $form->labelEx($model,'pickingarea'); ?>
		<?php echo $form->textField($model,'pickingarea'); ?>
		<?php echo $form->error($model,'pickingarea'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'sled'); ?>
		<?php echo $form->textField($model,'sled'); ?>
		<?php echo $form->error($model,'sled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'snroid'); ?>
    <?php echo $form->hiddenField($model,'snroid'); ?>
    <input type="text" name="description" id="description" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'snro_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Specific Number Range Object'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$snro = new Snro('searchwstatus');
	  $snro->unsetAttributes();  // clear any default values
	  if(isset($_GET['Snro']))
		$snro->attributes=$_GET['Snro'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'snro-grid',
            'dataProvider'=>$snro->Searchwstatus(),
            'filter'=>$snro,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_city",
                "id" => "send_city",
                "onClick" => "$(\"#snro_dialog\").dialog(\"close\"); 
				$(\"#description\").val(\"$data->description\"); 
				$(\"#Productplant_snroid\").val(\"$data->snroid\");"))',
                ),
	array('name'=>'snroid', 'visible'=>false,'value'=>'$data->snroid','htmlOptions'=>array('width'=>'1%')),
              'description',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#snro_dialog").dialog("open"); return false;',
                             ));?>
    <?php echo $form->error($model,'snroid'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
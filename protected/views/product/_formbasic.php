<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog1',
	'DialogGrid'=>'detailbasicdatagrid',
	'isSave'=>true,'UrlSave'=>'product/writebasic',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwritebasic'
));
?>
<?php echo $form->hiddenField($model,'productbasicid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
    <table class="table-condensed" style="width:100%">
    <tr>
      <td>
        <div class="row">
		<?php echo $form->labelEx($model,'baseuom'); ?>
<?php echo $form->hiddenField($model,'baseuom'); ?>
          <input type="text" name="baseuomcode" id="baseuomcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'baseuom_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Unit of Measure'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$baseuom = new Unitofmeasure('searchwstatus');
	  $baseuom->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$baseuom->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'baseuom-grid',
            'dataProvider'=>$baseuom->Searchwstatus(),
            'filter'=>$baseuom,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#baseuom_dialog\").dialog(\"close\"); 
                $(\"#baseuomcode\").val(\"$data->uomcode\");
                $(\"#Productbasic_baseuom\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#baseuom_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'addresstypeid'); ?>
	</div>
      </td>
	  <td>
        <div class="row">
		<?php echo $form->labelEx($model,'materialgroupid'); ?>
<?php echo $form->hiddenField($model,'materialgroupid'); ?>
          <input type="text" name="materialgroupcode" id="materialgroupcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'materialgroup_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Material Group'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$materialgroup = new Materialgroup('searchwstatus');
	  $materialgroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialgroup']))
		$materialgroup->attributes=$_GET['Materialgroup'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'materialgroup-grid',
            'dataProvider'=>$materialgroup->Searchwstatus(),
            'filter'=>$materialgroup,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#materialgroup_dialog\").dialog(\"close\"); 
                $(\"#materialgroupcode\").val(\"$data->materialgroupcode\");
                $(\"#Productbasic_materialgroupid\").val(\"$data->materialgroupid\");"))',
                ),
	array('name'=>'materialgroupid', 'visible'=>false,'value'=>'$data->materialgroupid','htmlOptions'=>array('width'=>'1%')),
              'materialgroupcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#materialgroup_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'materialgroupid'); ?>
	</div>
      </td>
      <td>
        <div class="row">
		<?php echo $form->labelEx($model,'oldmatno'); ?>
		<?php echo $form->textField($model,'oldmatno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'oldmatno'); ?>
	</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
		<?php echo $form->labelEx($model,'grossweight'); ?>
		<?php echo $form->textField($model,'grossweight'); ?>
		<?php echo $form->error($model,'grossweight'); ?>
	</div>
      </td>
      <td>
        <div class="row">
		<?php echo $form->labelEx($model,'weightunit'); ?>
<?php echo $form->hiddenField($model,'weightunit'); ?>
          <input type="text" name="weightunitcode" id="weightunitcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'weightunit_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Material Group'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$weightunit = new Unitofmeasure('searchwstatus');
	  $weightunit->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$weightunit->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'weightunit-grid',
            'dataProvider'=>$weightunit->Searchwstatus(),
            'filter'=>$weightunit,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#weightunit_dialog\").dialog(\"close\"); 
                $(\"#weightunitcode\").val(\"$data->uomcode\");
                $(\"#Productbasic_weightunit\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#weightunit_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
      </td>
	   <td>
        <div class="row">
		<?php echo $form->labelEx($model,'netweight'); ?>
		<?php echo $form->textField($model,'netweight'); ?>
		<?php echo $form->error($model,'netweight'); ?>
	</div>
      </td>
    </tr>
    <tr>
	<td>
        <div class="row">
		<?php echo $form->labelEx($model,'volume'); ?>
		<?php echo $form->textField($model,'volume'); ?>
		<?php echo $form->error($model,'volume'); ?>
	</div>
      </td>
	 <td>
        <div class="row">
		<?php echo $form->labelEx($model,'volumeunit'); ?>
    <?php echo $form->hiddenField($model,'volumeunit'); ?>
          <input type="text" name="volumeunitcode" id="volumeunitcode" readonly >

          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'volumeunit_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Unit of Measure'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$volumeunit = new Unitofmeasure('searchwstatus');
	  $volumeunit->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$volumeunit->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'volumeunit-grid',
            'dataProvider'=>$volumeunit->Searchwstatus(),
            'filter'=>$volumeunit,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_city",
                "id" => "send_city",
                "onClick" => "$(\"#volumeunit_dialog\").dialog(\"close\"); $(\"#volumeunitcode\").val(\"$data->uomcode\"); 
				$(\"#Productbasic_volumeunit\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#volumeunit_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
      </td>
	  <td>
        <div class="row">
		<?php echo $form->labelEx($model,'sizedimension'); ?>
		<?php echo $form->textField($model,'sizedimension'); ?>
		<?php echo $form->error($model,'sizedimension'); ?>
	</div>
      </td>
	  </tr>
	  <tr>
      <td>
        <div class="row">
		<?php echo $form->labelEx($model,'materialpackage'); ?>
<?php echo $form->hiddenField($model,'materialpackage'); ?>
          <input type="text" name="materialpackagecode" id="materialpackagecode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'materialpackage_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Material Package'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$materialpackage = new Product('searchwstatus');
	  $materialpackage->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$materialpackage->attributes=$_GET['Product'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'materialpackage-grid',
            'dataProvider'=>$materialpackage->Searchwstatus(),
            'filter'=>$materialpackage,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_kelurahan",
                "id" => "send_kelurahan",
                "onClick" => "$(\"#materialpackage_dialog\").dialog(\"close\"); $(\"#materialpackagecode\").val(\"$data->productname\"); 
				$(\"#Productbasic_productid\").val(\"$data->productid\");"))',
                ),
	array('name'=>'productid', 'visible'=>false,'value'=>'$data->productid','htmlOptions'=>array('width'=>'1%')),
              'productname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#materialpackage_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'productid'); ?>
	</div>
      </td>
    </tr>
		</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
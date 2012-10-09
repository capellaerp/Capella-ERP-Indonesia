<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'podetail-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog1',
	'DialogGrid'=>'detaildatagrid',
	'isSave'=>true,'UrlSave'=>'poheader/writedetail',
	'isCancel'=>true,'UrlCancel'=>'poheader/cancelwritedetail'
));
?>
<?php echo $form->hiddenField($model,'podetailid'); ?>
<?php echo $form->hiddenField($model,'poheaderid'); ?>
    <table>
      <tr>
        <td>
          <div class="row">
            		<?php echo $form->labelEx($model,'prdetailid'); ?>
<?php echo $form->hiddenField($model,'prdetailid'); ?>
            <input type="text" name="product_name" id="prno" style="width: 250px" readonly>
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'prmaterial_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Purchase Request'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
		$prmaterial=new Prmaterial('search');
	  $prmaterial->unsetAttributes();  // clear any default values
	  if(isset($_GET['Prmaterial']))
		$prmaterial->attributes=$_GET['Prmaterial'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'prmaterial-grid',
      'dataProvider'=>$prmaterial->searchwfqtystatus(),
      'filter'=>$prmaterial,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#prmaterial_dialog\").dialog(\"close\");
          $(\"#Podetail_productid\").val(\"$data->productid\");
          $(\"#Podetail_prdetailid\").val(\"$data->prmaterialid\");
          generatedata();
		  "))',
          ),
	array('name'=>'prmaterialid', 'visible'=>false,'value'=>'$data->prmaterialid'),
          array('name'=>'prheaderid', 'header'=>'PR Date','value'=>'($data->prheader!==null)?$data->prheader->prdate:""'),
          array('name'=>'prheaderid', 'value'=>'($data->prheader!==null)?$data->prheader->prno:""'),
          array('name'=>'productid', 'header'=>'Product Name','value'=>'($data->product!==null)?$data->product->productname:""'),
        array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty - $data->poqty)',
     ),
          array('name'=>'unitofmeasureid', 'header'=>'UOM Code','value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
          array('name'=>'requestedbyid','header'=>'Requested By Code','value'=>'($data->requestedby!==null)?$data->requestedby->description:""'),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("prmaterial-grid");$("#prmaterial_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'prdetailid'); ?>
	</div>
        </td>
        <td>
          <div class="row">
            		<?php echo $form->labelEx($model,'productid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
	  <input type="text" name="product_name" id="productname" style="width: 250px" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'product_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Product'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
		$product=new Product('search');
	  $product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$product->attributes=$_GET['Product'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'product-grid',
      'dataProvider'=>$product->searchwstatus(),
      'filter'=>$product,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#product_dialog\").dialog(\"close\");
          $(\"#Podetail_productid\").val(\"$data->productid\");
          $(\"#productname\").val(\"$data->productname\");
		  "))',
          ),
	array('name'=>'productid', 'visible'=>false,'value'=>'$data->productid'),
	'productname'
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("product-grid");$("#product_dialog").dialog("open"); return false;',
                       ))?>
					   <?php echo $form->error($model,'productid'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'poqty'); ?>
		<?php echo $form->textField($model,'poqty'); ?>
		<?php echo $form->error($model,'poqty'); ?>
	</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'unitofmeasureid'); ?>
<?php echo $form->hiddenField($model,'unitofmeasureid'); ?>
	  <input type="text" name="product_name" id="uomcode" readonly >
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
$unitofmeasure=new Unitofmeasure('search');
	  $unitofmeasure->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$unitofmeasure->attributes=$_GET['Unitofmeasure'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'uom-grid',
      'dataProvider'=>$unitofmeasure->Searchwstatus(),
      'filter'=>$unitofmeasure,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#uom_dialog\").dialog(\"close\"); $(\"#uomcode\").val(\"$data->uomcode\"); $(\"#Podetail_unitofmeasureid\").val(\"$data->unitofmeasureid\");
		  "))',
          ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid'),
        'uomcode',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("uom-grid");$("#uom_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'netprice'); ?>
		<?php echo $form->textField($model,'netprice'); ?>
		<?php echo $form->error($model,'netprice'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'currencyid'); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?>
	  <input type="text" name="product_name" id="currencyname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'curr_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Currency'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$currency=new Currency('search');
	  $currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$currency->attributes=$_GET['Currency'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'curr-grid',
      'dataProvider'=>$currency->Searchwstatus(),
      'filter'=>$currency,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#curr_dialog\").dialog(\"close\"); $(\"#currencyname\").val(\"$data->currencyname\"); $(\"#Podetail_currencyid\").val(\"$data->currencyid\");
		  "))',
          ),
	array('name'=>'currencyid', 'visible'=>false,'value'=>'$data->currencyid'),
        'currencyname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("curr-grid");$("#curr_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'currencyid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'ratevalue'); ?>
		<?php echo $form->textField($model,'ratevalue'); ?>
		<?php echo $form->error($model,'ratevalue'); ?>
	</div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'slocid'); ?>
<?php echo $form->hiddenField($model,'slocid'); ?>
	  <input type="text" name="sloccode" id="sloccode" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'sloc_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Storage Location'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$sloc=new Sloc('search');
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
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); $(\"#sloccode\").val(\"$data->sloccode\"); $(\"#Podetail_slocid\").val(\"$data->slocid\");
		  "))',
          ),
	array('name'=>'slocid', 'visible'=>false,'value'=>'$data->slocid'),
        'sloccode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("sloc-grid");$("#sloc_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'taxid'); ?>
<?php echo $form->hiddenField($model,'taxid'); ?>
	  <input type="text" name="product_name" id="taxcode" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'req_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Tax'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$tax=new Tax('search');
	  $tax->unsetAttributes();  // clear any default values
	  if(isset($_GET['Tax']))
		$tax->attributes=$_GET['Tax'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'tax-grid',
      'dataProvider'=>$tax->Searchwstatus(),
      'filter'=>$tax,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#req_dialog\").dialog(\"close\"); $(\"#taxcode\").val(\"$data->taxcode\"); $(\"#Podetail_taxid\").val(\"$data->taxid\");
		  "))',
          ),
	array('name'=>'taxid', 'visible'=>false,'value'=>'$data->taxid'),
        'taxcode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("tax-grid");$("#req_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'taxid'); ?>
	</div>
        </td>
		<td>
          <div class="row">
		<?php echo $form->labelEx($model,'delvdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'delvdate',
              'model'=>$model,
              // additional javascript options for the date picker plugin
              'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'-10:+10'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'15',
              ),
          ));?>
		<?php echo $form->error($model,'delvdate'); ?>
	</div>
        </td>
      </tr>
      <tr>        
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'itemtext'); ?>
		<?php echo $form->textArea($model,'itemtext',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'itemtext'); ?>
	</div>
        </td>
		<td>
          <div class="row">
		<?php echo $form->labelEx($model,'underdelvtol'); ?>
		<?php echo $form->textField($model,'underdelvtol'); ?>
		<?php echo $form->error($model,'underdelvtol'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'overdelvtol'); ?>
		<?php echo $form->textField($model,'overdelvtol'); ?>
		<?php echo $form->error($model,'overdelvtol'); ?>
	</div>
        </td>
      </tr>
    </table>
<?php $this->endWidget(); ?>
</div><!-- form -->
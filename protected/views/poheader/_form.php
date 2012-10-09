<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'genjournal-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'poheader/write',
	'isCancel'=>true,'UrlCancel'=>'poheader/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'poheaderid');?>
	<table>
	  <tr>
	  <td>
	   <div class="row">
		<?php echo $form->labelEx($model,'docdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'docdate',
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
		<?php echo $form->error($model,'docdate'); ?>
	</div>
	  </td>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'purchasinggroupid'); ?>
		<?php echo $form->hiddenField($model,'purchasinggroupid'); ?>
	  <input type="text" name="product_name" id="purchasinggroupcode" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'purchasinggroup_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Purchasing Group'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
		$purchasinggroup=new Purchasinggroup('search');
	  $purchasinggroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Purchasinggroup']))
		$purchasinggroup->attributes=$_GET['Purchasinggroup'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'purchasinggroup-grid',
      'dataProvider'=>$purchasinggroup->Searchwstatus(),
      'filter'=>$purchasinggroup,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#purchasinggroup_dialog\").dialog(\"close\"); $(\"#purchasinggroupcode\").val(\"$data->purchasinggroupcode\"); $(\"#Poheader_purchasinggroupid\").val(\"$data->purchasinggroupid\");
		  "))',
          ),
	array('name'=>'purchasinggroupid', 'visible'=>false,'value'=>'$data->purchasinggroupid'),
	array('name'=>'purchasingorgid', 'value'=>'$data->purchasingorg->description'),
        'purchasinggroupcode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("purchasinggroup-grid");$("#purchasinggroup_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'purchasinggroupid'); ?>
	</div>
		</td>
        <td>
		  <div class="row">
		<?php echo $form->labelEx($model,'addressbookid'); ?>
		<?php echo $form->hiddenField($model,'addressbookid'); ?>
	  <input type="text" name="product_name" id="fullname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'addressbook_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Supplier'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
		$supplier=new Supplier('search');
	  $supplier->unsetAttributes();  // clear any default values
	  if(isset($_GET['Supplier']))
		$supplier->attributes=$_GET['Supplier'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'addressbook-grid',
      'dataProvider'=>$supplier->Searchwstatus(),
      'filter'=>$supplier,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#addressbook_dialog\").dialog(\"close\"); $(\"#fullname\").val(\"$data->fullname\"); $(\"#Poheader_addressbookid\").val(\"$data->addressbookid\");
		  "))',
          ),
	array('name'=>'addressbookid', 'visible'=>false,'value'=>'$data->addressbookid'),
        'fullname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("addressbook-grid");$("#addressbook_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'addressbookid'); ?>
	</div>
		</td>
        	  </tr>
			  <tr>
			  <td>
		  <div class="row">
		<?php echo $form->labelEx($model,'paymentmethodid'); ?>
		<?php echo $form->hiddenField($model,'paymentmethodid'); ?>
	  <input type="text" name="product_name" id="paycode" readonly />
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'paymentmethod_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Payment Method'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
      $paymentmethod=new Paymentmethod('search');
	  $paymentmethod->unsetAttributes();  // clear any default values
	  if(isset($_GET['Paymentmethod']))
		$paymentmethod->attributes=$_GET['Paymentmethod'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'paymentmethod-grid',
      'dataProvider'=>$paymentmethod->Searchwstatus(),
      'filter'=>$paymentmethod,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#paymentmethod_dialog\").dialog(\"close\");$(\"#paycode\").val(\"$data->paycode\");$(\"#Poheader_paymentmethodid\").val(\"$data->paymentmethodid\");
		  "))',
          ),
	array('name'=>'paymentmethodid', 'visible'=>false,'value'=>'$data->paymentmethodid'),
        'paycode',
          'paydays',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("paymentmethod-grid");$("#paymentmethod_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'paymentmethodid'); ?>
	</div>
		</td>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'headernote'); ?>
		<?php echo $form->textArea($model,'headernote',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'headernote'); ?>
	</div>
		</td>
			  </tr>
			  
	</table>

<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'Detail' => array('content' => $this->renderPartial('indexdetail',
				  array('podetail'=>$podetail),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->
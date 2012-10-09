<div class="form">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'genjournal-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'prheader/write',
	'isCancel'=>true,'UrlCancel'=>'prheader/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'prheaderid');?>
	<table>
	  <tr>		
				<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'headernote'); ?>
		<?php echo $form->textArea($model,'headernote',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'headernote'); ?>
	</div>
		</td>
        
        <td>
           <div class="row">
		<?php echo $form->labelEx($model,'deliveryadviceid'); ?>
<?php echo $form->hiddenField($model,'deliveryadviceid'); ?>
        <input type="text" name="dano" id="dano" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'da_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Request Form'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$deliveryadvice=new Deliveryadvice('searchwfstatus');
	  $deliveryadvice->unsetAttributes();  // clear any default values
	  if(isset($_GET['Deliveryadvice']))
		$deliveryadvice->attributes=$_GET['Deliveryadvice'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'da-grid',
      'dataProvider'=>$deliveryadvice->searchwfstatus(),
      'filter'=>$deliveryadvice,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#da_dialog\").dialog(\"close\"); $(\"#dano\").val(\"$data->dano\");
          $(\"#Prheader_deliveryadviceid\").val(\"$data->deliveryadviceid\");
                generatedata2();
		  "))',
          ),
	array('name'=>'deliveryadviceid', 'visible'=>false, 'value'=>'$data->deliveryadviceid'),
        'dano',
                      'headernote',
          array(
      'name'=>'dadate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->dadate))',
     ),
                      	array('name'=>'useraccessid', 'value'=>'($data->useraccess!==null)?$data->useraccess->username:""'),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("da-grid");$("#da_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'productid'); ?>
	</div>
        </td>
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
$sloc=new Sloc('searchwfstatus');
	  $sloc->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sloc']))
		$sloc->attributes=$_GET['Sloc'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'sloc-grid',
      'dataProvider'=>$sloc->searchwstatus(),
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
          "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); $(\"#sloccode\").val(\"$data->description\"); $(\"#Prheader_slocid\").val(\"$data->slocid\");
		  "))',
          ),
	array('name'=>'slocid', 'visible'=>false, 'value'=>'$data->slocid'),
	array('name'=>'plantid','value'=>'($data->plant!==null)?$data->plant->description:""'),
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
	  </tr>
	</table>

<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'Detail' => array('content' => $this->renderPartial('indexdetail',
				  array('prmaterial'=>$prmaterial),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->
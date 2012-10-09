<div class="form">
<?php 
$gidetail->giheaderid= $model->giheaderid;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'giheader-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'giheader/write',
	'isCancel'=>true,'UrlCancel'=>'giheader/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'giheaderid'); ?>
	<table>
	  <tr>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'gidate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'gidate',
              'model'=>$model,
              // additional javascript options for the date picker plugin
              'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'1900:+0'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'20',
              ),
          ));?>
		<?php echo $form->error($model,'gidate'); ?>
	</div>
		</td>
		         <td>
		  <div class="row">
		<?php echo $form->labelEx($model,'deliveryadviceid'); ?>
    <?php echo $form->hiddenField($model,'deliveryadviceid'); ?>
    <input type="text" name="stat_name" id="dano" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'da_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Request Form'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
$deliveryadvice=new Deliveryadvice('searchwstatus');
	  $deliveryadvice->unsetAttributes();  // clear any default values
	  if(isset($_GET['Deliveryadvice']))
		$deliveryadvice->attributes=$_GET['Deliveryadvice'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'da-grid',
        'dataProvider'=>$deliveryadvice->searchwfqtystatus(),
        'filter'=>$deliveryadvice,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#da_dialog\").dialog(\"close\"); $(\"#dano\").val(\"$data->dano\");
          $(\"#Giheader_deliveryadviceid\").val(\"$data->deliveryadviceid\");
          $(\"#Giheader_gidate\").val(\"$data->dadate\");
          generatedatada();
                "))',
          ),
	array('name'=>'deliveryadviceid', 'visible'=>false,'value'=>'$data->deliveryadviceid:""'),
          'dano',
            'headernote',
                    array(
      'name'=>'dadate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->dadate))'
     ),
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("da-grid");$("#da_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'deliveryadviceid'); ?>
	</div>
		</td>
				         <td>
		  <div class="row">
		<?php echo $form->labelEx($model,'soheaderid'); ?>
    <?php echo $form->hiddenField($model,'soheaderid'); ?>
    <input type="text" name="stat_name" id="sono" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'so_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Sales Order'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
$soheader=new Soheader('searchwstatus');
	  $soheader->unsetAttributes();  // clear any default values
	  if(isset($_GET['Soheader']))
		$soheader->attributes=$_GET['Soheader'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'so-grid',
        'dataProvider'=>$soheader->searchwfqtystatus(),
        'filter'=>$soheader,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#so_dialog\").dialog(\"close\"); $(\"#sono\").val(\"$data->sono\");
          $(\"#Giheader_soheaderid\").val(\"$data->soheaderid\");
          $(\"#Giheader_gidate\").val(\"$data->sodate\");
          generatedataso();
                "))',
          ),
	array('name'=>'soheaderid', 'visible'=>false,'value'=>'$data->soheaderid:""'),
          'sono',
	array('name'=>'addressbookid','value'=>'($data->customer!==null)?$data->customer->fullname:""'),
            'headernote',
                    array(
      'name'=>'sodate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->sodate))'
     ),
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("so-grid");$("#so_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'deliveryadviceid'); ?>
	</div>
		</td>

	  </tr>
      <tr>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textArea($model,'location',array('cols'=>30,'rows'=>5)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>
        </td>
		<td>
          <div class="row">
		<?php echo $form->labelEx($model,'headernote'); ?>
		<?php echo $form->textArea($model,'headernote',array('cols'=>30,'rows'=>5)); ?>
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
			array('gidetail'=>$gidetail),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->
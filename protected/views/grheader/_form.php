<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'grheader-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'grheader/write',
	'isCancel'=>true,'UrlCancel'=>'grheader/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'grheaderid'); ?>
	<table>
	  <tr>
	  <td>
	  <div class="row">
          <?php echo $form->labelEx($model,'grdate'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'grdate',
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
                  'size'=>'10',
              ),
          ));?>          <?php echo $form->error($model,'grdate'); ?>
        </div>
	  </td>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'poheaderid'); ?>
    <?php echo $form->hiddenField($model,'poheaderid'); ?>
    <input type="text" name="pono" id="pono" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'poheader_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Purchase Order'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$poheader=new Poheader('searchwfqtystatus');
	  $poheader->unsetAttributes();  // clear any default values
	  if(isset($_GET['Poheader']))
		$poheader->attributes=$_GET['Poheader'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'poheader-grid',
        'dataProvider'=>$poheader->searchwfqtystatus(),
        'filter'=>$poheader,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#poheader_dialog\").dialog(\"close\");
          $(\"#pono\").val(\"$data->pono\");
          $(\"#Grheader_poheaderid\").val(\"$data->poheaderid\");
          $(\"#Grheader_grdate\").val(\"$data->docdate\");
          $(\"#Grheader_headernote\").val(\"$data->headernote\");
          generatedata1();"))',
          ),
	array('name'=>'poheaderid', 'visible'=>false, 'value'=>'$data->poheaderid'),
          'pono',
	array('name'=>'addressbookid', 'value'=>'$data->supplier!==null?$data->supplier->fullname:""'),
            array(
      'name'=>'docdate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->docdate))'
     ),		
     'headernote',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("poheader-grid");$("#poheader_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'poheaderid'); ?>
	</div>
		</td>
        <td>
		  <div class="row">
		<?php echo $form->labelEx($model,'giheaderid'); ?>
    <?php echo $form->hiddenField($model,'giheaderid'); ?>
    <input type="text" name="pono" id="gino" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'giheader_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Goods Issue'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $giheader=new Giheader('search');
	  $giheader->unsetAttributes();  // clear any default values
	  if(isset($_GET['Giheader']))
		$giheader->attributes=$_GET['Giheader'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'giheader-grid',
        'dataProvider'=>$giheader->searchwfgstatus(),
        'filter'=>$giheader,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#giheader_dialog\").dialog(\"close\");
          $(\"#gino\").val(\"$data->gino\");
          $(\"#Grheader_giheaderid\").val(\"$data->giheaderid\");
          generatedata2();"))',
          ),
          array('name'=>'giheaderid', 'visible'=>false, 'value'=>'$data->giheaderid'),
          'gino',
            array(
      'name'=>'gidate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->gidate))'
     ),		
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("giheader-grid");$("#giheader_dialog").dialog("open"); return false;',
                       ))
    ?>
		<?php echo $form->error($model,'poheaderid'); ?>
	</div>
		</td>
		<td>
		<div class="row">
          <?php echo $form->labelEx($model,'headernote'); ?>
          <?php echo $form->textArea($model,'headernote'); ?>
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
			array('grdetail'=>$grdetail),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materialgroup-form',
	'enableAjaxValidation'=>false,
)); ?>
      <div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'materialgroup/write',
	'isCancel'=>true,'UrlCancel'=>'materialgroup/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'materialgroupid'); ?>
	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'materialtypeid'); ?>
		<?php echo $form->hiddenField($model,'materialtypeid'); ?>
	  <input type="text" name="materialtypedescription" id="materialtypedescription" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'materialtype_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Type'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$materialtype=new Materialtype('searchwstatus');
	  $materialtype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialtype']))
		$materialtype->attributes=$_GET['Materialtype'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'materialtype-grid',
      'dataProvider'=>$materialtype->Searchwstatus(),
      'filter'=>$materialtype,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#materialtype_dialog\").dialog(\"close\"); $(\"#materialtypedescription\").val(\"$data->description\"); $(\"#Materialgroup_materialtypeid\").val(\"$data->materialtypeid\");
		  "))',
          ),
	array('name'=>'materialtypeid', 'visible'=>false,'value'=>'$data->materialtypeid','htmlOptions'=>array('width'=>'1%')),
        'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("materialtype-grid");$("#materialtype_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'materialtypeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'materialgroupcode'); ?>
		<?php echo $form->textField($model,'materialgroupcode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'materialgroupcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parentmatgroupid'); ?>
		<?php echo $form->hiddenField($model,'parentmatgroupid'); ?>
	  <input type="text" name="parentmatgroupcode" id="parentmatgroupcode" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'absschedule_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Group'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$parentmatgroup=new Materialgroup('searchwstatus');
	  $parentmatgroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Parentmatgroup']))
		$parentmatgroup->attributes=$_GET['Parentmatgroup'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'absschedule-grid',
      'dataProvider'=>$parentmatgroup->Searchwstatus(),
      'filter'=>$parentmatgroup,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#absschedule_dialog\").dialog(\"close\"); $(\"#parentmatgroupcode\").val(\"$data->materialgroupcode\"); $(\"#Materialgroup_parentmatgroupid\").val(\"$data->materialgroupid\");
		  "))',
          ),
        'materialgroupid',
        'materialgroupcode',
        'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("absschedule-grid");$("#absschedule_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'parentmatgroupid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menuauth-form'
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'menuauth/write',
	'isCancel'=>true,'UrlCancel'=>'menuauth/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'menuauthid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'menuaccessid'); ?>
    <?php echo $form->hiddenField($model,'menuaccessid'); ?>
    <input type="text" name="stat_name" id="menuname" readonly >
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'menuaccess_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Menu Access'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'menuaccess-grid',
        'dataProvider'=>$menuaccess->searchwstatus(),
        'filter'=>$menuaccess,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#menuaccess_dialog\").dialog(\"close\"); $(\"#menuname\").val(\"$data->menuname\"); $(\"#Menuauth_menuaccessid\").val(\"$data->menuaccessid\");"))',
          ),
	array('name'=>'menuaccessid', 'visible'=>false,'value'=>'$data->menuaccessid','htmlOptions'=>array('width'=>'1%')),
          'menuname',
            'description',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("menuaccess-grid");$("#menuaccess_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'menuaccessid'); ?>
	</div>

    	<div class="row">
		<?php echo $form->labelEx($model,'menuobject'); ?>
		<?php echo $form->textField($model,'menuobject'); ?>
		<?php echo $form->error($model,'menuobject'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupmenuauth-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'groupmenuauth/write',
	'isCancel'=>true,'UrlCancel'=>'groupmenuauth/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'groupmenuauthid'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'groupaccessid'); ?>
		<?php echo $form->hiddenField($model,'groupaccessid'); ?>
	  <input type="text" name="sched_name" id="groupname" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'groupaccess_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Group Access'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'groupaccess-grid',
      'dataProvider'=>$groupaccess->Searchwstatus(),
      'filter'=>$groupaccess,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#groupaccess_dialog\").dialog(\"close\"); $(\"#groupname\").val(\"$data->groupname\"); $(\"#groupmenuauth_groupaccessid\").val(\"$data->groupaccessid\");
		  "))',
          ),
	array('name'=>'groupaccessid', 'visible'=>false,'value'=>'$data->groupaccessid','htmlOptions'=>array('width'=>'1%')),
        'groupname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("groupaccess-grid");$("#groupaccess_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'groupaccessid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menuauthid'); ?>
		<?php echo $form->hiddenField($model,'menuauthid'); ?>
	  <input type="text" name="sched_name" id="menuobject" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'menuaccess_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Menu Object Authentication'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'menuaccess-grid',
      'dataProvider'=>$menuauth->Searchwstatus(),
      'filter'=>$menuauth,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#menuaccess_dialog\").dialog(\"close\"); 
		  $(\"#menuobject\").val(\"$data->menuobject\"); 
		  $(\"#Groupmenuauth_menuauthid\").val(\"$data->menuauthid\");
		  "))',
          ),
	array('name'=>'menuauthid', 'visible'=>false,'value'=>'$data->menuauthid','htmlOptions'=>array('width'=>'1%')),
        'menuobject',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("menuaccess-grid");$("#menuaccess_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'menuauthid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menuvalueid'); ?>
		<?php echo $form->checkBox($model,'menuvalueid'); ?>
		<?php echo $form->error($model,'menuvalueid'); ?>
	</div>

	

<?php $this->endWidget(); ?>
</div><!-- form -->

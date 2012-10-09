<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usergroup-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'usergroup/write',
	'isCancel'=>true,'UrlCancel'=>'usergroup/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'usergroupid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'useraccessid'); ?>
		<?php echo $form->hiddenField($model,'useraccessid'); ?>
	  <input type="text" name="username" id="username" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'useraccess_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','User Access'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$useraccess = new Useraccess('searchwstatus');
	  $useraccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Useraccess']))
		$useraccess->attributes=$_GET['Useraccess'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'useraccess-grid',
      'dataProvider'=>$useraccess->search(),
      'filter'=>$useraccess,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#useraccess_dialog\").dialog(\"close\"); $(\"#username\").val(\"$data->username\"); $(\"#Usergroup_useraccessid\").val(\"$data->useraccessid\");
		  "))',
          ),
	array('name'=>'useraccessid', 'visible'=>false,'value'=>'$data->useraccessid','htmlOptions'=>array('width'=>'1%')),
        'username',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("useraccess-grid");$("#useraccess_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'useraccessid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groupaccessid'); ?>
		<?php echo $form->hiddenField($model,'groupaccessid'); ?>
	  <input type="text" name="groupname" id="groupname" readonly >
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
$groupaccess = new Groupaccess('searchwstatus');
	  $groupaccess->unsetAttributes();  // clear any default values
	  if(isset($_GET['Groupaccess']))
		$groupaccess->attributes=$_GET['Groupaccess'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'groupaccess-grid',
      'dataProvider'=>$groupaccess->Search(),
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
          "onClick" => "$(\"#groupaccess_dialog\").dialog(\"close\"); $(\"#groupname\").val(\"$data->groupname\"); $(\"#Usergroup_groupaccessid\").val(\"$data->groupaccessid\");
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
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
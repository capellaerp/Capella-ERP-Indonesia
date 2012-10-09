<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useraccess-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="toolbarform">
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'useraccess/write',
	'isCancel'=>true,'UrlCancel'=>'useraccess/cancelwrite'
));
?>
</div> 
<?php echo $form->hiddenField($model,'useraccessid'); ?>
<table>
<tr>
<td>
  <div class="row">
		<?php echo $form->labelEx($model,'realname'); ?>
		<?php echo $form->textField($model,'realname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'realname'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
</td>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
	  <?php echo CHtml::hiddenField('passhide',''); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
</td>
</tr>
<tr>
<td>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	</td>
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'phoneno'); ?>
		<?php echo $form->textField($model,'phoneno',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'phoneno'); ?>
	</div>
	</td>
	<td>
	<div class="row">
		<?php echo $form->labelEx($model,'languageid'); ?>
<?php echo $form->hiddenField($model,'languageid'); ?>
	  <input type="text" name="languagename" id="languagename" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'language_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Language'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));
$language=new Language('searchwstatus');
	  $language->unsetAttributes();  // clear any default values
	  if(isset($_GET['Language']))
		$language->attributes=$_GET['Language'];
    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'product-grid',
      'dataProvider'=>$language->Searchwstatus(),
      'filter'=>$language,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#language_dialog\").dialog(\"close\"); $(\"#languagename\").val(\"$data->languagename\"); $(\"#Useraccess_languageid\").val(\"$data->languageid\");
		  "))',
          ),
	array('name'=>'languageid', 'visible'=>false,'value'=>'$data->languageid','htmlOptions'=>array('width'=>'1%')),
        'languagename',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#language_dialog").dialog("open"); return false;',
                       ))?>		<?php echo $form->error($model,'languageid'); ?>
	</div>
	</td>
</tr>
</table>
          	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
	

<?php $this->endWidget(); ?>
</div><!-- form -->
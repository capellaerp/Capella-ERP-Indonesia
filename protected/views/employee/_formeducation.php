<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
'DialogID'=>'createdialog2',
	'DialogGrid'=>'detail2datagrid',
	'isSave'=>true,'UrlSave'=>'employee/writeeducation',
	'isCancel'=>true,'UrlCancel'=>'employee/cancelwriteeducation'
));
?>
<?php echo $form->hiddenField($model,'employeeeducationid'); ?>
<?php echo $form->hiddenField($model,'employeeid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'educationid'); ?>
    <?php echo $form->hiddenField($model,'educationid'); ?>
    <input type="text" name="education_name" id="education_name" readonly value="<?php echo (Education::model()->findByPk($model->educationid)!==null)?Education::model()->findByPk($model->educationid)->educationname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'education_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Education'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$education = new Education('searchwstatus');
	  $education->unsetAttributes();  // clear any default values
	  if(isset($_GET['Education']))
		$education->attributes=$_GET['Education'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'education-grid',
            'dataProvider'=>$education->Searchwstatus(),
            'filter'=>$education,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_education",
                "id" => "send_education",
                "onClick" => "$(\"#education_dialog\").dialog(\"close\"); $(\"#education_name\").val(\"$data->educationname\"); $(\"#Employeeeducation_educationid\").val(\"$data->educationid\");"))',
                ),
	array('name'=>'educationid', 'visible'=>false,'value'=>'$data->educationid','htmlOptions'=>array('width'=>'1%')),
              'educationname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#education_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'educationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'schoolname'); ?>
		<?php echo $form->textField($model,'schoolname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'schoolname'); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->labelEx($model,'schooldegree'); ?>
		<?php echo $form->textField($model,'schooldegree',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'schooldegree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
    <?php echo $form->hiddenField($model,'cityid'); ?>
    <input type="text" name="educity_name" id="educity_name" readonly value="<?php echo (City::model()->findByPk($model->cityid)!==null)?City::model()->findByPk($model->cityid)->cityname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'educity_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','City'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$city = new City('searchwstatus');
	  $city->unsetAttributes();  // clear any default values
	  if(isset($_GET['City']))
		$city->attributes=$_GET['City'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'educity-grid',
            'dataProvider'=>$city->Searchwstatus(),
            'filter'=>$city,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_city",
                "id" => "send_city",
                "onClick" => "$(\"#educity_dialog\").dialog(\"close\"); $(\"#educity_name\").val(\"$data->cityname\"); $(\"#Employeeeducation_cityid\").val(\"$data->cityid\");"))',
                ),
	array('name'=>'cityid', 'visible'=>false,'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
              'cityname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#educity_dialog").dialog("open"); return false;',
                             ));?>
    <?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yeargraduate'); ?>
    <?php $this->Widget('CMaskedTextField',array(
      'attribute'=>'yeargraduate','model'=>$model,'mask'=>'9999','htmlOptions'=>array(
        'style'=>'width:60px;'
    ),
    )); ?>
		<?php echo $form->error($model,'yeargraduate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isdiploma'); ?>
		<?php echo $form->checkBox($model,'isdiploma'); ?>
		<?php echo $form->error($model,'isdiploma'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
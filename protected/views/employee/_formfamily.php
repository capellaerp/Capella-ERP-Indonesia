<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog5',
	'DialogGrid'=>'detail5datagrid',
	'isSave'=>true,'UrlSave'=>'employee/writefamily',
	'isCancel'=>true,'UrlCancel'=>'employee/cancelwritefamily'
));
?>
<?php echo $form->hiddenField($model,'employeefamilyid'); ?>
<?php echo $form->hiddenField($model,'employeeid'); ?>
  <table>
    <tr>
      <td>
          <div class="row">
              <?php echo $form->labelEx($model,'familyrelationid'); ?>
              <?php echo $form->hiddenField($model,'familyrelationid'); ?>
                    <input type="text" name="familyrelation_name" id="familyrelation_name" readonly value="<?php echo (Familyrelation::model()->findByPk($model->familyrelationid)!==null)?Familyrelation::model()->findByPk($model->familyrelationid)->familyrelationname:''; ?>">
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'familyrelation_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Family Relation'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$familyrelation = new Familyrelation('searchwstatus');
	  $familyrelation->unsetAttributes();  // clear any default values
	  if(isset($_GET['Familyrelation']))
		$familyrelation->attributes=$_GET['Familyrelation'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'familyrelation-grid',
                      'dataProvider'=>$familyrelation->Searchwstatus(),
                      'filter'=>$familyrelation,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_familyrelation",
                          "id" => "send_familyrelation",
                          "onClick" => "$(\"#familyrelation_dialog\").dialog(\"close\"); $(\"#familyrelation_name\").val(\"$data->familyrelationname\"); $(\"#Employeefamily_familyrelationid\").val(\"$data->familyrelationid\");"))',
                          ),
	array('name'=>'familyrelationid', 'visible'=>false,'value'=>'$data->familyrelationid','htmlOptions'=>array('width'=>'1%')),
                        'familyrelationname',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#familyrelation_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'familyrelationid'); ?>
            </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'familyname'); ?>
          <?php echo $form->textField($model,'familyname',array('size'=>20,'maxlength'=>50)); ?>
          <?php echo $form->error($model,'familyname'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
            <?php echo $form->labelEx($model,'sexid'); ?>
        <?php echo $form->hiddenField($model,'sexid'); ?>
                  <input type="text" name="sex_name" id="sex_name" readonly value="<?php echo (Sex::model()->findByPk($model->sexid)!==null)?Sex::model()->findByPk($model->sexid)->sexname:''; ?>">
                  <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                     array(   'id'=>'famsex_dialog',
                              // additional javascript options for the dialog plugin
                              'options'=>array(
                                              'title'=>Yii::t('app','Sex'),
                                              'width'=>'auto',
                                              'autoOpen'=>false,
                                              'modal'=>true,
                                              ),
                                      ));
$sex = new Sex('searchwstatus');
	  $sex->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sex']))
		$sex->attributes=$_GET['Sex'];
                  $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'famsex-grid',
                    'dataProvider'=>$sex->Searchwstatus(),
                    'filter'=>$sex,
                    'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                    'columns'=>array(
                      array(
                        'header'=>'',
                        'type'=>'raw',
                      /* Here is The Button that will send the Data to The MAIN FORM */
                        'value'=>'CHtml::Button("V",
                        array("name" => "send_sex",
                        "id" => "send_sex",
                        "onClick" => "$(\"#famsex_dialog\").dialog(\"close\"); $(\"#sex_name\").val(\"$data->sexname\"); $(\"#Employeefamily_sexid\").val(\"$data->sexid\");"))',
                        ),
	array('name'=>'sexid', 'visible'=>false,'value'=>'$data->sexid','htmlOptions'=>array('width'=>'1%')),
                      'sexname',
                      ),
                  ));

                  $this->endWidget('zii.widgets.jui.CJuiDialog');
                  echo CHtml::Button('...',
                                        array('onclick'=>'$("#famsex_dialog").dialog("open"); return false;',
                                     ));?>		<?php echo $form->error($model,'sexid'); ?>
          </div>
      </td>
      <td>
        <div class="row">
            <?php echo $form->labelEx($model,'cityid'); ?>
        <?php echo $form->hiddenField($model,'cityid'); ?>
                  <input type="text" name="city_name" id="city_name" readonly value="<?php echo (City::model()->findByPk($model->cityid)!==null)?City::model()->findByPk($model->cityid)->cityname:''; ?>">
                  <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                     array(   'id'=>'famcity_dialog',
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
                    'id'=>'famcity-grid',
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
                        "onClick" => "$(\"#famcity_dialog\").dialog(\"close\"); $(\"#city_name\").val(\"$data->cityname\"); $(\"#Employeefamily_cityid\").val(\"$data->cityid\");"))',
                        ),
	array('name'=>'cityid', 'visible'=>false,'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
                      'cityname',
                      ),
                  ));

                  $this->endWidget('zii.widgets.jui.CJuiDialog');
                  echo CHtml::Button('...',
                                        array('onclick'=>'$("#famcity_dialog").dialog("open"); return false;',
                                     ));?>		<?php echo $form->error($model,'cityid'); ?>
          </div>
      </td>
      <td>
              <div class="row">
          <?php echo $form->labelEx($model,'birthdate'); ?>
      <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'attribute'=>'birthdate',
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
                        'style'=>'height:20px;'
                    ),
                ));?>		<?php echo $form->error($model,'birthdate'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
            <?php echo $form->labelEx($model,'educationid'); ?>
        <?php echo $form->hiddenField($model,'educationid'); ?>
                  <input type="text" name="education_name" id="education_name" readonly value="<?php echo (Education::model()->findByPk($model->educationid)!==null)?Education::model()->findByPk($model->educationid)->educationname:''; ?>">
                  <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog',
                     array(   'id'=>'fameducation_dialog',
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
                    'id'=>'fameducation-grid',
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
                        "onClick" => "$(\"#fameducation_dialog\").dialog(\"close\"); $(\"#education_name\").val(\"$data->educationname\"); $(\"#Employeefamily_educationid\").val(\"$data->educationid\");"))',
                        ),
	array('name'=>'educationid', 'visible'=>false,'value'=>'$data->educationid','htmlOptions'=>array('width'=>'1%')),
                      'educationname',
                      ),
                  ));

                  $this->endWidget('zii.widgets.jui.CJuiDialog');
                  echo CHtml::Button('...',
                                        array('onclick'=>'$("#fameducation_dialog").dialog("open"); return false;',
                                     ));?>		<?php echo $form->error($model,'educationid'); ?>
          </div>
      </td>
      <td>
<div class="row">
		<?php echo $form->labelEx($model,'occupationid'); ?>
<?php echo $form->hiddenField($model,'occupationid'); ?>
          <input type="text" name="occupation_name" id="occupation_name" readonly value="<?php echo (Occupation::model()->findByPk($model->occupationid)!==null)?Occupation::model()->findByPk($model->occupationid)->occupationname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'occupation_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Occupation'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$occupation = new Occupation('searchwstatus');
	  $occupation->unsetAttributes();  // clear any default values
	  if(isset($_GET['Occupation']))
		$occupation->attributes=$_GET['Occupation'];

          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'occupation-grid',
            'dataProvider'=>$occupation->Searchwstatus(),
            'filter'=>$occupation,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_occupation",
                "id" => "send_occupation",
                "onClick" => "$(\"#occupation_dialog\").dialog(\"close\"); $(\"#occupation_name\").val(\"$data->occupationname\"); $(\"#Employeefamily_occupationid\").val(\"$data->occupationid\");"))',
                ),
	array('name'=>'occupationid', 'visible'=>false,'value'=>'$data->occupationid','htmlOptions'=>array('width'=>'1%')),
              'occupationname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#occupation_dialog").dialog("open"); return false;',
                             ));?>		<?php echo $form->error($model,'occupationid'); ?>
	</div>
      </td>
      <td>
        	<div class="row">
		<?php echo $form->labelEx($model,'recordstatus'); ?>
		<?php echo $form->checkBox($model,'recordstatus'); ?>
		<?php echo $form->error($model,'recordstatus'); ?>
	</div>
      </td>
    </tr>
  </table>

<?php $this->endWidget(); ?>
</div><!-- form -->

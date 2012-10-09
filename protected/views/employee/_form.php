<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'employee/write',
	'isCancel'=>true,'UrlCancel'=>'employee/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'employeeid'); ?>
     
	<table class="table-condensed" style="width:100%">
	<tr> 
		<td>
				<?php echo $form->labelEx($model,'fullname'); ?>
				<?php echo $form->textField($model,'fullname'); ?>
				<?php echo $form->error($model,'fullname'); ?>
		</td>
		<td>
				<?php echo $form->labelEx($model,'oldnik'); ?>
				<?php echo $form->textField($model,'oldnik'); ?>
				<?php echo $form->error($model,'oldnik'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'orgstructureid'); ?>
    <?php echo $form->hiddenField($model,'orgstructureid'); ?>
    <input type="text" name="structurename" id="structurename" readonly style="width:75%" value="<?php 
echo (Orgstructure::model()->findByPk($model->orgstructureid)!==null)?Orgstructure::model()->findByPk($model->orgstructureid)->structurename :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'orgstructure_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Organization Structure'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$orgstructure=new Orgstructure('searchwfstatus');
	  $orgstructure->unsetAttributes();  // clear any default values
	  if(isset($_GET['Orgstructure']))
		$orgstructure->attributes=$_GET['Orgstructure'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'orgstructure-grid',
        'dataProvider'=>$orgstructure->searchwstatus(),
        'filter'=>$orgstructure,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#orgstructure_dialog\").dialog(\"close\"); $(\"#structurename\").val(\"$data->structurename\"); 
		  $(\"#Employee_orgstructureid\").val(\"$data->orgstructureid\");"))',
          ),
	array('name'=>'orgstructureid', 'visible'=>false,
        'value'=>'$data->orgstructureid','htmlOptions'=>array('width'=>'1%')),
          'structurename',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#orgstructure_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'orgstructureid'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'positionid'); ?>
    <?php echo $form->hiddenField($model,'positionid'); ?>
    <input type="text" name="positionname" id="positionname" readonly style="width:75%" value="<?php 
echo (Position::model()->findByPk($model->positionid)!==null)?Position::model()->findByPk($model->positionid)->positionname :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'position_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Position'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$position=new Position('searchwstatus');
	  $position->unsetAttributes();  // clear any default values
	  if(isset($_GET['Position']))
		$position->attributes=$_GET['Position'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'position-grid',
        'dataProvider'=>$position->searchwstatus(),
        'filter'=>$position,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#position_dialog\").dialog(\"close\"); $(\"#positionname\").val(\"$data->positionname\"); 
		  $(\"#Employee_positionid\").val(\"$data->positionid\");"))',
          ),
	array('name'=>'positionid', 'visible'=>false,
        'value'=>'$data->positionid','htmlOptions'=>array('width'=>'1%')),
          'positionname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#position_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'positionid'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'levelorgid'); ?>
    <?php echo $form->hiddenField($model,'levelorgid'); ?>
    <input type="text" name="levelorgname" id="levelorgname" readonly style="width:75%" value="<?php 
echo (Position::model()->findByPk($model->levelorgid)!==null)?Position::model()->findByPk($model->levelorgid)->levelorgname :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'levelorg_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Level Organization'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$levelorg=new Levelorg('searchwstatus');
	  $levelorg->unsetAttributes();  // clear any default values
	  if(isset($_GET['Levelorg']))
		$levelorg->attributes=$_GET['Levelorg'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'levelorg-grid',
        'dataProvider'=>$levelorg->searchwstatus(),
        'filter'=>$levelorg,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#levelorg_dialog\").dialog(\"close\"); $(\"#levelorgname\").val(\"$data->levelorgname\"); 
		  $(\"#Employee_levelorgid\").val(\"$data->levelorgid\");"))',
          ),
	array('name'=>'levelorgid', 'visible'=>false,
        'value'=>'$data->levelorgid','htmlOptions'=>array('width'=>'1%')),
          'levelorgname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#levelorg_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'positionid'); ?>
		</td>
	</tr>
	<tr>
	<td>
		<?php echo $form->labelEx($model,'employeetypeid'); ?>
    <?php echo $form->hiddenField($model,'employeetypeid'); ?>
    <input type="text" name="employeetypename" id="employeetypename" readonly style="width:75%" value="<?php 
echo (Employeetype::model()->findByPk($model->employeetypeid)!==null)?Employeetype::model()->findByPk($model->employeetypeid)->employeetypename :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'employeetype_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Employee Type'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$employeetype=new Employeetype('searchwstatus');
	  $employeetype->unsetAttributes();  // clear any default values
	  if(isset($_GET['Employeetype']))
		$employeetype->attributes=$_GET['Employeetype'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'employeetype-grid',
        'dataProvider'=>$employeetype->searchwstatus(),
        'filter'=>$employeetype,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#employeetype_dialog\").dialog(\"close\"); $(\"#employeetypename\").val(\"$data->employeetypename\"); 
		  $(\"#Employee_employeetypeid\").val(\"$data->employeetypeid\");"))',
          ),
	array('name'=>'employeetypeid', 'visible'=>false,
        'value'=>'$data->levelorgid','htmlOptions'=>array('width'=>'1%')),
          'employeetypename',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#employeetype_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'employeetypeid'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'sexid'); ?>
    <?php echo $form->hiddenField($model,'sexid'); ?>
    <input type="text" name="sexname" id="sexname" readonly style="width:75%" value="<?php 
echo (Sex::model()->findByPk($model->sexid)!==null)?Sex::model()->findByPk($model->sexid)->sexname :'';?>">
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array('id'=>'sex_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Sex'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true
                                ),
                        ));
						$sex=new Sex('searchwstatus');
	  $sex->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sex']))
		$sex->attributes=$_GET['Sex'];
      $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'sex-grid',
        'dataProvider'=>$sex->searchwstatus(),
        'filter'=>$sex,
        'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
        'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("V",
          array("name" => "send_absstatus",
          "id" => "send_absstatus",
          "onClick" => "$(\"#sex_dialog\").dialog(\"close\"); $(\"#sexname\").val(\"$data->sexname\"); 
		  $(\"#Employee_sexid\").val(\"$data->sexid\");"))',
          ),
	array('name'=>'sexid', 'visible'=>false,
        'value'=>'$data->levelorgid','htmlOptions'=>array('width'=>'1%')),
          'sexname',
        ),
      ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#sex_dialog").dialog("open"); return false;',
                       ))?>
    <?php echo $form->error($model,'sexid'); ?>
		</td>
		<td>
		<div class="row">
          <?php echo $form->labelEx($model,'birthcityid'); ?>
          <?php echo $form->hiddenField($model,'birthcityid'); ?>
          <input type="text" name="birthcity_name" id="birthcity_name" style="width:75%" readonly value="<?php echo (City::model()->findByPk($model->birthcityid)!==null)?City::model()->findByPk($model->birthcityid)->cityname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'birthcity_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','City'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$birthcity=new City('searchwstatus');
	  $birthcity->unsetAttributes();  // clear any default values
	  if(isset($_GET['City']))
		$birthcity->attributes=$_GET['City'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'birthcity-grid',
            'dataProvider'=>$birthcity->Searchwstatus(),
            'filter'=>$birthcity,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_birthcity",
                "id" => "send_birthcity",
                "onClick" => "$(\"#birthcity_dialog\").dialog(\"close\"); $(\"#birthcity_name\").val(\"$data->cityname\"); $(\"#Employee_birthcityid\").val(\"$data->cityid\");"))',
                ),
	array('name'=>'cityid', 'visible'=>false,'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
              'cityname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#birthcity_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'birthcityid'); ?>
        </div>
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
                  'style'=>'height:20px',
                  'size'=>'10',
              ),
          ));?>
          <?php echo $form->error($model,'birthdate'); ?>
        </div>
		</td>
		<td>
        <div class="row">
          <?php echo $form->labelEx($model,'religionid'); ?>
          <?php echo $form->hiddenField($model,'religionid'); ?>
          <input type="text" name="religion_name" id="religion_name" style="width:75%" readonly value="<?php echo (Religion::model()->findByPk($model->religionid)!==null)?Religion::model()->findByPk($model->religionid)->religionname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'religion_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Religion'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$religion=new Religion('searchwstatus');
	  $religion->unsetAttributes();  // clear any default values
	  if(isset($_GET['Religion']))
		$religion->attributes=$_GET['Religion'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'religion-grid',
            'dataProvider'=>$religion->Searchwstatus(),
            'filter'=>$religion,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_religion",
                "id" => "send_religion",
                "onClick" => "$(\"#religion_dialog\").dialog(\"close\"); $(\"#religion_name\").val(\"$data->religionname\"); $(\"#Employee_religionid\").val(\"$data->religionid\");"))',
                ),
	array('name'=>'religionid', 'visible'=>false,'value'=>'$data->religionid','htmlOptions'=>array('width'=>'1%')),
              'religionname',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#religion_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'religionid'); ?>
        </div>
      </td>
	  <td>
        <div class="row">
          <?php echo $form->labelEx($model,'maritalstatusid'); ?>
          <?php echo $form->hiddenField($model,'maritalstatusid'); ?>
          <input type="text" name="maritalstatus_name" id="maritalstatus_name" style="width:75%" readonly value="<?php echo (Maritalstatus::model()->findByPk($model->maritalstatusid)!==null)?Maritalstatus::model()->findByPk($model->maritalstatusid)->maritalstatusname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'maritalstatus_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Marital Status'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
						$maritalstatus=new Maritalstatus('searchwfstatus');
	  $maritalstatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Maritalstatus']))
		$maritalstatus->attributes=$_GET['Maritalstatus'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'maritalstatus-grid',
            'dataProvider'=>$maritalstatus->Searchwstatus(),
            'filter'=>$maritalstatus,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_maritalstatus",
                "id" => "send_maritalstatus",
                "onClick" => "$(\"#maritalstatus_dialog\").dialog(\"close\"); $(\"#maritalstatus_name\").val(\"$data->maritalstatusname\"); $(\"#Employee_maritalstatusid\").val(\"$data->maritalstatusid\");"))',
                ),
	array('name'=>'maritalstatusid', 'visible'=>false,'value'=>'$data->maritalstatusid','htmlOptions'=>array('width'=>'1%')),
              'maritalstatusname',
              ),
          ));
          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#maritalstatus_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'maritalstatusid'); ?>
        </div>
      </td>
	</tr>
	<tr>
<td>
        <div class="row">
          <?php echo $form->labelEx($model,'referenceby'); ?>
          <?php echo $form->textField($model,'referenceby',array('size'=>10,'maxlength'=>50)); ?>
          <?php echo $form->error($model,'referenceby'); ?>
        </div>
      </td>	
	  <td>
	  <div class="row">
          <?php echo $form->labelEx($model,'joindate'); ?>
          <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'joindate',
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
                  'size'=>'10',
              ),
          ));?>
          <?php echo $form->error($model,'joindate'); ?>
        </div>
	  </td>
	   <td>
        <div class="row">
          <?php echo $form->labelEx($model,'employeestatusid'); ?>
          <?php echo $form->hiddenField($model,'employeestatusid'); ?>
          <input type="text" name="employeestatus_name" id="employeestatus_name" style="width:75%" readonly value="<?php echo (Employeestatus::model()->findByPk($model->employeestatusid)!==null)?Employeestatus::model()->findByPk($model->employeestatusid)->employeestatusname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'employeestatus_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Employee Status'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$employeestatus=new Employeestatus('searchwfstatus');
	  $employeestatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Employeestatus']))
		$employeestatus->attributes=$_GET['Employeestatus'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'employeestatus-grid',
            'dataProvider'=>$employeestatus->Searchwstatus(),
            'filter'=>$employeestatus,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_employeestatus",
                "id" => "send_employeestatus",
                "onClick" => "$(\"#employeestatus_dialog\").dialog(\"close\"); $(\"#employeestatus_name\").val(\"$data->employeestatusname\"); $(\"#Employee_employeestatusid\").val(\"$data->employeestatusid\");"))',
                ),
	array('name'=>'employeestatusid', 'visible'=>false,'value'=>'$data->employeestatusid','htmlOptions'=>array('width'=>'1%')),
              'employeestatusname',
              ),
          ));
          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#employeestatus_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'employeestatusid'); ?>
        </div>
		</td>
		<td>
        <div class="row">
          <?php echo $form->labelEx($model,'istrial'); ?>
          <?php echo $form->checkBox($model,'istrial'); ?>
          <?php echo $form->error($model,'istrial'); ?>
        </div>
      </td>
	  	   <td>
        <div class="row">
          <?php echo $form->labelEx($model,'accountno'); ?>
          <?php echo $form->textField($model,'accountno'); ?>
          <?php echo $form->error($model,'accountno'); ?>
        </div>
      </td>
	</tr>
	<tr>    
	  <td>
        <div class="row">
          <?php echo $form->labelEx($model,'taxno'); ?>
          <?php echo $form->textField($model,'taxno'); ?>
          <?php echo $form->error($model,'taxno'); ?>
        </div>
      </td>
	  </tr>
	</table>
<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
         'Address' => array('content' => $this->renderPartial('indexaddress',
			 array('employeeaddress'=>$employeeaddress),true)),
         'Education' => array('content' => $this->renderPartial('indexeducation',
			 array('employeeeducation'=>$employeeeducation),true)),
         'Informal' => array('content' => $this->renderPartial('indexinformal',
			 array('employeeinformal'=>$employeeinformal),true)),
         'Working Experience' => array('content' => $this->renderPartial('indexwo',
			 array('employeewo'=>$employeewo),true)),
         'Family' => array('content' => $this->renderPartial('indexfamily',
			 array('employeefamily'=>$employeefamily),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->

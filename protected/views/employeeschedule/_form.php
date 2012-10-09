<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employeeschedule-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isHelpForm'=>true,'OnClick'=>"{helpdata(2)}",
	'isSave'=>true,'UrlSave'=>'employeeschedule/write',
	'isCancel'=>true,'UrlCancel'=>'employeeschedule/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'employeescheduleid'); ?>
  <table>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'employeeid'); ?>
<?php echo $form->hiddenField($model,'employeeid'); ?>
          <input type="text" name="employee_name" id="employee_name" readonly value="<?php echo (Employee::model()->findByPk($model->employeeid)!==null)?Employee::model()->findByPk($model->employeeid)->fullname:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'employee_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Employee'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));

          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'employee-grid',
            'dataProvider'=>$employee->Searchwstatus(),
            'filter'=>$employee,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_employee",
                "id" => "send_employee",
                "onClick" => "$(\"#employee_dialog\").dialog(\"close\"); $(\"#employee_name\").val(\"$data->fullname\"); $(\"#Employeeschedule_employeeid\").val(\"$data->employeeid\");"))',
                ),
	array('name'=>'employeeid', 'visible'=>false,'value'=>'$data->employeeid','htmlOptions'=>array('width'=>'1%')),
              'fullname',
              ),
          ));
          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#employee_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'employeeid'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'month'); ?>
		 <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'month',
              'model'=>$model,
              // additional javascript options for the date picker plugin
             'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>'mm',
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'1900:+0'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'10',
              ),
          ));?>
          <?php echo $form->error($model,'month'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'year'); ?>
		  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'year',
              'model'=>$model,
              // additional javascript options for the date picker plugin
             'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>'yy',
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'1900:+0'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'10',
              ),
          ));?>
          <?php echo $form->error($model,'year'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d1'); ?>
		  <?php echo $form->hiddenField($model,'d1'); ?>
          <input type="text" name="d1_name" id="d1_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d1)!==null)?Absschedule::model()->findByPk($model->d1)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d1_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d1 = new Absschedule('searchwstatus');
	  $d1->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d1->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d1-grid',
            'dataProvider'=>$d1->Searchwstatus(),
            'filter'=>$d1,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d1",
                "id" => "send_d1",
                "onClick" => "$(\"#d1_dialog\").dialog(\"close\"); $(\"#d1_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d1\").val(\"$data->absscheduleid\");"))',
                ),
	array('name'=>array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')), 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d1_dialog").dialog("open"); return false;',
                             ));?>
          <?php echo $form->error($model,'d1'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d2'); ?>
<?php echo $form->hiddenField($model,'d2'); ?>
          <input type="text" name="d2_name" id="d2_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d2)!==null)?Absschedule::model()->findByPk($model->d2)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d2_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d2 = new Absschedule('searchwstatus');
	  $d2->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d2->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d2-grid',
            'dataProvider'=>$d2->Searchwstatus(),
            'filter'=>$d2,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d2",
                "id" => "send_d2",
                "onClick" => "$(\"#d2_dialog\").dialog(\"close\"); $(\"#d2_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d2\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d2_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d2'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d3'); ?>
<?php echo $form->hiddenField($model,'d3'); ?>
          <input type="text" name="d3_name" id="d3_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d3)!==null)?Absschedule::model()->findByPk($model->d3)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d3_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d3 = new Absschedule('searchwstatus');
	  $d3->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d3->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d3-grid',
            'dataProvider'=>$d3->Searchwstatus(),
            'filter'=>$d3,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d3",
                "id" => "send_d3",
                "onClick" => "$(\"#d3_dialog\").dialog(\"close\"); $(\"#d3_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d3\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d3_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d3'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d4'); ?>
<?php echo $form->hiddenField($model,'d4'); ?>
          <input type="text" name="d4_name" id="d4_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d4)!==null)?Absschedule::model()->findByPk($model->d4)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d4_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d4 = new Absschedule('searchwstatus');
	  $d4->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d4->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d4-grid',
            'dataProvider'=>$d4->Searchwstatus(),
            'filter'=>$d4,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d4",
                "id" => "send_d4",
                "onClick" => "$(\"#d4_dialog\").dialog(\"close\"); $(\"#d4_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d4\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d4_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d4'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d5'); ?>
<?php echo $form->hiddenField($model,'d5'); ?>
          <input type="text" name="d5_name" id="d5_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d5)!==null)?Absschedule::model()->findByPk($model->d5)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d5_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d5 = new Absschedule('searchwstatus');
	  $d5->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d5->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d5-grid',
            'dataProvider'=>$d5->Searchwstatus(),
            'filter'=>$d5,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d5",
                "id" => "send_d5",
                "onClick" => "$(\"#d5_dialog\").dialog(\"close\"); $(\"#d5_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d5\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d5_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d5'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d6'); ?>
<?php echo $form->hiddenField($model,'d6'); ?>
          <input type="text" name="d6_name" id="d6_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d6)!==null)?Absschedule::model()->findByPk($model->d6)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d6_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d6 = new Absschedule('searchwstatus');
	  $d6->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d6->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d6-grid',
            'dataProvider'=>$d6->Searchwstatus(),
            'filter'=>$d6,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d6",
                "id" => "send_d6",
                "onClick" => "$(\"#d6_dialog\").dialog(\"close\"); $(\"#d6_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d6\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d6_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d6'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d7'); ?>
<?php echo $form->hiddenField($model,'d7'); ?>
          <input type="text" name="d7_name" id="d7_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d7)!==null)?Absschedule::model()->findByPk($model->d7)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d7_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d7 = new Absschedule('searchwstatus');
	  $d7->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d7->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d7-grid',
            'dataProvider'=>$d7->Searchwstatus(),
            'filter'=>$d7,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d7",
                "id" => "send_d7",
                "onClick" => "$(\"#d7_dialog\").dialog(\"close\"); $(\"#d7_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d7\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d7_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d7'); ?>
        </div>  
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d8'); ?>
<?php echo $form->hiddenField($model,'d8'); ?>
          <input type="text" name="d8_name" id="d8_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d8)!==null)?Absschedule::model()->findByPk($model->d8)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d8_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d8 = new Absschedule('searchwstatus');
	  $d8->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d8->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d8-grid',
            'dataProvider'=>$d8->Searchwstatus(),
            'filter'=>$d8,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d8",
                "id" => "send_d8",
                "onClick" => "$(\"#d8_dialog\").dialog(\"close\"); $(\"#d8_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d8\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d8_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d8'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d9'); ?>
<?php echo $form->hiddenField($model,'d9'); ?>
          <input type="text" name="d9_name" id="d9_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d9)!==null)?Absschedule::model()->findByPk($model->d9)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d9_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d9 = new Absschedule('searchwstatus');
	  $d9->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d9->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d9-grid',
            'dataProvider'=>$d9->Searchwstatus(),
            'filter'=>$d9,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d9",
                "id" => "send_d9",
                "onClick" => "$(\"#d9_dialog\").dialog(\"close\"); $(\"#d9_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d9\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d9_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d9'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d10'); ?>
<?php echo $form->hiddenField($model,'d10'); ?>
          <input type="text" name="d10_name" id="d10_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d10)!==null)?Absschedule::model()->findByPk($model->d10)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d10_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d10 = new Absschedule('searchwstatus');
	  $d10->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d10->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d10-grid',
            'dataProvider'=>$d10->Searchwstatus(),
            'filter'=>$d10,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d10",
                "id" => "send_d10",
                "onClick" => "$(\"#d10_dialog\").dialog(\"close\"); $(\"#d10_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d10\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d10_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d10'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d11'); ?>
<?php echo $form->hiddenField($model,'d11'); ?>
          <input type="text" name="d11_name" id="d11_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d11)!==null)?Absschedule::model()->findByPk($model->d11)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d11_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d11 = new Absschedule('searchwstatus');
	  $d11->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d11->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d11-grid',
            'dataProvider'=>$d11->Searchwstatus(),
            'filter'=>$d11,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d11",
                "id" => "send_d11",
                "onClick" => "$(\"#d11_dialog\").dialog(\"close\"); $(\"#d11_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d11\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d11_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d11'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d12'); ?>
<?php echo $form->hiddenField($model,'d12'); ?>
          <input type="text" name="d12_name" id="d12_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d12)!==null)?Absschedule::model()->findByPk($model->d12)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d12_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d12 = new Absschedule('searchwstatus');
	  $d12->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d12->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d12-grid',
            'dataProvider'=>$d12->Searchwstatus(),
            'filter'=>$d12,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d12",
                "id" => "send_d12",
                "onClick" => "$(\"#d12_dialog\").dialog(\"close\"); $(\"#d12_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d12\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d12_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d12'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d13'); ?>
<?php echo $form->hiddenField($model,'d13'); ?>
          <input type="text" name="d13_name" id="d13_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d13)!==null)?Absschedule::model()->findByPk($model->d13)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d13_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d13 = new Absschedule('searchwstatus');
	  $d13->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d13->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d13-grid',
            'dataProvider'=>$d13->Searchwstatus(),
            'filter'=>$d13,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d13",
                "id" => "send_d13",
                "onClick" => "$(\"#d13_dialog\").dialog(\"close\"); $(\"#d13_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d13\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d13_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d13'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d14'); ?>
<?php echo $form->hiddenField($model,'d14'); ?>
          <input type="text" name="d14_name" id="d14_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d14)!==null)?Absschedule::model()->findByPk($model->d14)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d14_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d14 = new Absschedule('searchwstatus');
	  $d14->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d14->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d14-grid',
            'dataProvider'=>$d14->Searchwstatus(),
            'filter'=>$d14,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d14",
                "id" => "send_d14",
                "onClick" => "$(\"#d14_dialog\").dialog(\"close\"); $(\"#d14_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d14\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d14_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d14'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d15'); ?>
<?php echo $form->hiddenField($model,'d15'); ?>
          <input type="text" name="d15_name" id="d15_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d15)!==null)?Absschedule::model()->findByPk($model->d15)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d15_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d15 = new Absschedule('searchwstatus');
	  $d15->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d15->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d15-grid',
            'dataProvider'=>$d15->Searchwstatus(),
            'filter'=>$d15,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d15",
                "id" => "send_d15",
                "onClick" => "$(\"#d15_dialog\").dialog(\"close\"); $(\"#d15_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d15\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d15_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d15'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d16'); ?>
<?php echo $form->hiddenField($model,'d16'); ?>
          <input type="text" name="d16_name" id="d16_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d16)!==null)?Absschedule::model()->findByPk($model->d16)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d16_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d16 = new Absschedule('searchwstatus');
	  $d16->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d16->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d16-grid',
            'dataProvider'=>$d16->Searchwstatus(),
            'filter'=>$d16,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d16",
                "id" => "send_d16",
                "onClick" => "$(\"#d16_dialog\").dialog(\"close\"); $(\"#d16_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d16\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d16_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d16'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d17'); ?>
<?php echo $form->hiddenField($model,'d17'); ?>
          <input type="text" name="d17_name" id="d17_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d17)!==null)?Absschedule::model()->findByPk($model->d17)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d17_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d17 = new Absschedule('searchwstatus');
	  $d17->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d17->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d17-grid',
            'dataProvider'=>$d17->Searchwstatus(),
            'filter'=>$d17,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d17",
                "id" => "send_d17",
                "onClick" => "$(\"#d17_dialog\").dialog(\"close\"); $(\"#d17_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d17\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d17_dialog").dialog("open"); return false;',
                             ));?>        <?php echo $form->error($model,'d17'); ?>
      </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d18'); ?>
<?php echo $form->hiddenField($model,'d18'); ?>
          <input type="text" name="d18_name" id="d18_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d18)!==null)?Absschedule::model()->findByPk($model->d18)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d18_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d18 = new Absschedule('searchwstatus');
	  $d18->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d18->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d18-grid',
            'dataProvider'=>$d18->Searchwstatus(),
            'filter'=>$d18,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d18",
                "id" => "send_d18",
                "onClick" => "$(\"#d18_dialog\").dialog(\"close\"); $(\"#d18_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d18\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d18_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d18'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d19'); ?>
<?php echo $form->hiddenField($model,'d19'); ?>
          <input type="text" name="d19_name" id="d19_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d19)!==null)?Absschedule::model()->findByPk($model->d19)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d19_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d19 = new Absschedule('searchwstatus');
	  $d19->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d19->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d19-grid',
            'dataProvider'=>$d19->Searchwstatus(),
            'filter'=>$d19,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d19",
                "id" => "send_d19",
                "onClick" => "$(\"#d19_dialog\").dialog(\"close\"); $(\"#d19_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d19\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d19_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d19'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d20'); ?>
<?php echo $form->hiddenField($model,'d20'); ?>
          <input type="text" name="d20_name" id="d20_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d20)!==null)?Absschedule::model()->findByPk($model->d20)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d20_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d20 = new Absschedule('searchwstatus');
	  $d20->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d20->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d20-grid',
            'dataProvider'=>$d20->Searchwstatus(),
            'filter'=>$d20,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d20",
                "id" => "send_d20",
                "onClick" => "$(\"#d20_dialog\").dialog(\"close\"); $(\"#d20_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d20\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d20_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d20'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d21'); ?>
<?php echo $form->hiddenField($model,'d21'); ?>
          <input type="text" name="d21_name" id="d21_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d21)!==null)?Absschedule::model()->findByPk($model->d21)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d21_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d21 = new Absschedule('searchwstatus');
	  $d21->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d21->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d21-grid',
            'dataProvider'=>$d21->Searchwstatus(),
            'filter'=>$d21,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d21",
                "id" => "send_d21",
                "onClick" => "$(\"#d21_dialog\").dialog(\"close\"); $(\"#d21_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d21\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d21_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d21'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d22'); ?>
<?php echo $form->hiddenField($model,'d22'); ?>
          <input type="text" name="d22_name" id="d22_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d22)!==null)?Absschedule::model()->findByPk($model->d22)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d22_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d22 = new Absschedule('searchwstatus');
	  $d22->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d22->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d22-grid',
            'dataProvider'=>$d22->Searchwstatus(),
            'filter'=>$d22,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d22",
                "id" => "send_d22",
                "onClick" => "$(\"#d22_dialog\").dialog(\"close\"); $(\"#d22_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d22\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d22_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d22'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d23'); ?>
<?php echo $form->hiddenField($model,'d23'); ?>
          <input type="text" name="d23_name" id="d23_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d23)!==null)?Absschedule::model()->findByPk($model->d23)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d23_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d23 = new Absschedule('searchwstatus');
	  $d23->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d23->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d23-grid',
            'dataProvider'=>$d23->Searchwstatus(),
            'filter'=>$d23,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d23",
                "id" => "send_d23",
                "onClick" => "$(\"#d23_dialog\").dialog(\"close\"); $(\"#d23_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d23\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d23_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d23'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d24'); ?>
<?php echo $form->hiddenField($model,'d24'); ?>
          <input type="text" name="d24_name" id="d24_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d24)!==null)?Absschedule::model()->findByPk($model->d24)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d24_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d24 = new Absschedule('searchwstatus');
	  $d24->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d24->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d24-grid',
            'dataProvider'=>$d24->Searchwstatus(),
            'filter'=>$d24,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d24",
                "id" => "send_d24",
                "onClick" => "$(\"#d24_dialog\").dialog(\"close\"); $(\"#d24_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d24\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d24_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d24'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d25'); ?>
<?php echo $form->hiddenField($model,'d25'); ?>
          <input type="text" name="d25_name" id="d25_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d25)!==null)?Absschedule::model()->findByPk($model->d25)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d25_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d25 = new Absschedule('searchwstatus');
	  $d25->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d25->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d25-grid',
            'dataProvider'=>$d25->Searchwstatus(),
            'filter'=>$d25,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d25",
                "id" => "send_d25",
                "onClick" => "$(\"#d25_dialog\").dialog(\"close\"); $(\"#d25_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d25\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d25_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d25'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d26'); ?>
<?php echo $form->hiddenField($model,'d26'); ?>
          <input type="text" name="d26_name" id="d26_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d26)!==null)?Absschedule::model()->findByPk($model->d26)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d26_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d26 = new Absschedule('searchwstatus');
	  $d26->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d26->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d26-grid',
            'dataProvider'=>$d26->Searchwstatus(),
            'filter'=>$d26,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d26",
                "id" => "send_d26",
                "onClick" => "$(\"#d26_dialog\").dialog(\"close\"); $(\"#d26_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d26\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d26_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d26'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d27'); ?>
<?php echo $form->hiddenField($model,'d27'); ?>
          <input type="text" name="d27_name" id="d27_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d27)!==null)?Absschedule::model()->findByPk($model->d27)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d27_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d27 = new Absschedule('searchwstatus');
	  $d27->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d27->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d27-grid',
            'dataProvider'=>$d27->Searchwstatus(),
            'filter'=>$d27,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d27",
                "id" => "send_d27",
                "onClick" => "$(\"#d27_dialog\").dialog(\"close\"); $(\"#d27_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d27\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d27_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d27'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d28'); ?>
<?php echo $form->hiddenField($model,'d28'); ?>
          <input type="text" name="d28_name" id="d28_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d28)!==null)?Absschedule::model()->findByPk($model->d28)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d28_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d28 = new Absschedule('searchwstatus');
	  $d28->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d28->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d28-grid',
            'dataProvider'=>$d28->Searchwstatus(),
            'filter'=>$d28,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d28",
                "id" => "send_d28",
                "onClick" => "$(\"#d28_dialog\").dialog(\"close\"); $(\"#d28_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d28\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d28_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d28'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d29'); ?>
<?php echo $form->hiddenField($model,'d29'); ?>
          <input type="text" name="d29_name" id="d29_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d29)!==null)?Absschedule::model()->findByPk($model->d29)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d29_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d29 = new Absschedule('searchwstatus');
	  $d29->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d29->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d29-grid',
            'dataProvider'=>$d29->Searchwstatus(),
            'filter'=>$d29,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d29",
                "id" => "send_d29",
                "onClick" => "$(\"#d29_dialog\").dialog(\"close\"); $(\"#d29_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d29\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d29_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d29'); ?>
        </div>
      </td>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d30'); ?>
<?php echo $form->hiddenField($model,'d30'); ?>
          <input type="text" name="d30_name" id="d30_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d30)!==null)?Absschedule::model()->findByPk($model->d30)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d30_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d30 = new Absschedule('searchwstatus');
	  $d30->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d30->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d30-grid',
            'dataProvider'=>$d30->Searchwstatus(),
            'filter'=>$d30,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d30",
                "id" => "send_d30",
                "onClick" => "$(\"#d30_dialog\").dialog(\"close\"); $(\"#d30_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d30\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d30_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d30'); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <?php echo $form->labelEx($model,'d31'); ?>
<?php echo $form->hiddenField($model,'d31'); ?>
          <input type="text" name="d31_name" id="d31_name" readonly value="<?php echo (Absschedule::model()->findByPk($model->d31)!==null)?Absschedule::model()->findByPk($model->d31)->absschedulename:''; ?>">
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'d31_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Schedule'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$d31 = new Absschedule('searchwstatus');
	  $d31->unsetAttributes();  // clear any default values
	  if(isset($_GET['Absschedule']))
		$d31->attributes=$_GET['Absschedule'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'d31-grid',
            'dataProvider'=>$d31->Searchwstatus(),
            'filter'=>$d31,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("+",
                array("name" => "send_d31",
                "id" => "send_d31",
                "onClick" => "$(\"#d31_dialog\").dialog(\"close\"); $(\"#d31_name\").val(\"$data->absschedulename\"); $(\"#Employeeschedule_d31\").val(\"$data->absscheduleid\");"))',
                ),
              array('name'=>'absscheduleid', 'visible'=>false,'value'=>'$data->absscheduleid','htmlOptions'=>array('width'=>'1%')),
              'absschedulename',
              array(
                'class'=>'CCheckBoxColumn',
                'name'=>'recordstatus',
                'selectableRows'=>'0',
                'header'=>'Record Status',
                'checked'=>'$data->recordstatus'
              ),
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#d31_dialog").dialog("open"); return false;',
                             ));?>          <?php echo $form->error($model,'d31'); ?>
        </div>
      </td>
    </tr>
  </table>
	<table>
      <tr>
        <td colspan="2" align="center">
		<?php echo CHtml::ajaxSubmitButton('Save',
		array('employeeschedule/write'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			document.getElementById("messages").innerHTML = x.div;
			if (x.status == "success")
			{
			  $.fn.yiiGridView.update("datagrid");
			  $("#createdialog").dialog("close");
              document.getElementById("messages").innerHTML = "";
			}
        }')); ?>
		<?php echo CHtml::ajaxSubmitButton('Cancel',
		array('employeeschedule/cancelwrite'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			document.getElementById("messages").innerHTML = x.div;
			if (x.status == "success")
			{
			  $.fn.yiiGridView.update("datagrid");
			  $("#createdialog").dialog("close");
              document.getElementById("messages").innerHTML = "";
			}
        }')); ?>
        </td>
      </tr>
    </table>
<?php $this->endWidget(); ?>
</div><!-- form -->

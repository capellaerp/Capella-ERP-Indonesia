<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog3',
	'DialogGrid'=>'detailpurchasedatagrid',
	'isSave'=>true,'UrlSave'=>'product/writepurchase',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwritepurchase'
));
?>
<?php echo $form->hiddenField($model,'productpurchaseid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'plantid'); ?>
<?php echo $form->hiddenField($model,'plantid'); ?>
          <input type="text" name="plantcode" id="plantcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'plant_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Plant'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$plant = new Plant('searchwstatus');
	  $plant->unsetAttributes();  // clear any default values
	  if(isset($_GET['Plant']))
		$plant->attributes=$_GET['Plant'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'plant-grid',
            'dataProvider'=>$plant->Searchwstatus(),
            'filter'=>$plant,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#plant_dialog\").dialog(\"close\"); 
                $(\"#plantcode\").val(\"$data->plantcode\");
                $(\"#Productpurchase_plantid\").val(\"$data->plantid\");"))',
                ),
	array('name'=>'plantid', 'visible'=>false,'value'=>'$data->plantid','htmlOptions'=>array('width'=>'1%')),
              'plantcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#plant_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'plantid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orderunit'); ?>
<?php echo $form->hiddenField($model,'orderunit'); ?>
          <input type="text" name="orderunitcode" id="orderunitcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'orderunit_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Unit of Measure'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$orderunit = new Unitofmeasure('searchwstatus');
	  $orderunit->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$orderunit->attributes=$_GET['Unitofmeasure'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'orderunit-grid',
            'dataProvider'=>$orderunit->Searchwstatus(),
            'filter'=>$orderunit,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#orderunit_dialog\").dialog(\"close\"); 
                $(\"#orderunitcode\").val(\"$data->uomcode\");
                $(\"#Productpurchase_orderunit\").val(\"$data->unitofmeasureid\");"))',
                ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
              'uomcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#orderunit_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'orderunit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchasinggroupid'); ?>
<?php echo $form->hiddenField($model,'purchasinggroupid'); ?>
          <input type="text" name="purchasinggroupcode" id="purchasinggroupcode" readonly >
          <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog',
             array(   'id'=>'purchasinggroup_dialog',
                      // additional javascript options for the dialog plugin
                      'options'=>array(
                                      'title'=>Yii::t('app','Purchasing Group'),
                                      'width'=>'auto',
                                      'autoOpen'=>false,
                                      'modal'=>true,
                                      ),
                              ));
$purchasinggroup = new Purchasinggroup('searchwstatus');
	  $purchasinggroup->unsetAttributes();  // clear any default values
	  if(isset($_GET['Purchasinggroup']))
		$purchasinggroup->attributes=$_GET['Purchasinggroup'];
          $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'purchasinggroup-grid',
            'dataProvider'=>$purchasinggroup->Searchwstatus(),
            'filter'=>$purchasinggroup,
            'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
            'columns'=>array(
              array(
                'header'=>'',
                'type'=>'raw',
              /* Here is The Button that will send the Data to The MAIN FORM */
                'value'=>'CHtml::Button("V",
                array("name" => "send_addresstype",
                "id" => "send_addresstype",
                "onClick" => "$(\"#purchasinggroup_dialog\").dialog(\"close\"); 
                $(\"#purchasinggroupcode\").val(\"$data->purchasinggroupcode\");
                $(\"#Productpurchase_purchasinggroupid\").val(\"$data->purchasinggroupid\");"))',
                ),
	array('name'=>'purchasinggroupid', 'visible'=>false,'value'=>'$data->purchasinggroupid','htmlOptions'=>array('width'=>'1%')),
              'purchasinggroupcode',
              ),
          ));

          $this->endWidget('zii.widgets.jui.CJuiDialog');
          echo CHtml::Button('...',
                                array('onclick'=>'$("#purchasinggroup_dialog").dialog("open"); return false;',
                             ));?>
		<?php echo $form->error($model,'orderunit'); ?>
	</div>

	<div class="row">
          <?php echo $form->labelEx($model,'validfrom'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'validfrom',
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
          ));?>          <?php echo $form->error($model,'validfrom'); ?>
        </div>

	<div class="row">
          <?php echo $form->labelEx($model,'validto'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'validto',
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
          ));?>          <?php echo $form->error($model,'validto'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'isautoPO'); ?>
		<?php echo $form->CheckBox($model,'isautoPO'); ?>
		<?php echo $form->error($model,'isautoPO'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
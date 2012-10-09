<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'company/write',
	'isCancel'=>true,'UrlCancel'=>'company/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'companyid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'companyname'); ?>
		<?php echo $form->textField($model,'companyname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'companyname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>5, 'cols'=>30)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
				<?php echo $form->labelEx($model,'cityid'); ?>
				<?php echo $form->hiddenField($model,'cityid'); ?>
				<input type="text" name="cityname" id="cityname" style="width:100px" readonly value="<?php
				echo (City::model()->findByPk($model->cityid)!==null)?City::model()->findByPk($model->cityid)->cityname :'';?>">
					<?php
					  $this->beginWidget('zii.widgets.jui.CJuiDialog',
					   array(   'id'=>'city_dialog',
								// additional javascript options for the dialog plugin
								'options'=>array(
												'title'=>Yii::t('app','City'),
												'width'=>'auto',
												'autoOpen'=>false,
												'modal'=>true,
												),
										));

					$this->widget('zii.widgets.grid.CGridView', array(
					  'id'=>'city-grid',
					  'dataProvider'=>$city->Searchwstatus(),
					  'filter'=>$city,
					  'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
					  'columns'=>array(
						array(
						  'header'=>'',
						  'type'=>'raw',
						/* Here is The Button that will send the Data to The MAIN FORM */
						  'value'=>'CHtml::Button("+",
						  array("name" => "send_absschedule",
						  "id" => "send_absschedule",
						  "onClick" => "$(\"#city_dialog\").dialog(\"close\");
						  $(\"#cityname\").val(\"$data->cityname\");
						  $(\"#Company_cityid\").val(\"$data->cityid\");
						  "))',
						  ),
					array('name'=>'cityid', 'visible'=>false,
						'value'=>'$data->cityid','htmlOptions'=>array('width'=>'1%')),
						'cityname',
						),
					));

					$this->endWidget('zii.widgets.jui.CJuiDialog');
					echo CHtml::Button('...',
										  array('onclick'=>'$("#city_dialog").dialog("open"); return false;',
									   ))?>		
				<?php echo $form->error($model,'cityid'); ?>	
	</div>

	<div class="row">
				<?php echo $form->labelEx($model,'zipcode'); ?>
				<?php echo $form->textField($model,'zipcode',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
				<?php echo $form->labelEx($model,'taxno'); ?>
				<?php echo $form->textField($model,'taxno',array('size'=>10,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'taxno'); ?>
	</div>
	
	<div class="row">
				<?php echo $form->labelEx($model,'currencyid'); ?>
				<?php echo $form->hiddenField($model,'currencyid'); ?>
				<input type="text" name="currencyname" id="currencyname" style="width:100px" readonly value="<?php
				echo (Currency::model()->findByPk($model->currencyid)!==null)?Currency::model()->findByPk($model->currencyid)->currencyname :'';?>">
					<?php
					  $this->beginWidget('zii.widgets.jui.CJuiDialog',
					   array(   'id'=>'currency_dialog',
								// additional javascript options for the dialog plugin
								'options'=>array(
												'title'=>Yii::t('app','Currency'),
												'width'=>'auto',
												'autoOpen'=>false,
												'modal'=>true,
												),
										));

					$this->widget('zii.widgets.grid.CGridView', array(
					  'id'=>'currency-grid',
					  'dataProvider'=>$currency->Searchwstatus(),
					  'filter'=>$currency,
					  'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
					  'columns'=>array(
						array(
						  'header'=>'',
						  'type'=>'raw',
						/* Here is The Button that will send the Data to The MAIN FORM */
						  'value'=>'CHtml::Button("+",
						  array("name" => "send_absschedule",
						  "id" => "send_absschedule",
						  "onClick" => "$(\"#currency_dialog\").dialog(\"close\");
						  $(\"#currencyname\").val(\"$data->currencyname\");
						  $(\"#Company_currencyid\").val(\"$data->currencyid\");
						  "))',
						  ),
					array('name'=>'currencyid', 'visible'=>false,
						'value'=>'$data->currencyid','htmlOptions'=>array('width'=>'1%')),
						'currencyname',
						array(
						  'class'=>'CCheckBoxColumn',
						  'name'=>'recordstatus',
						  'selectableRows'=>'0',
						  'header'=>'Record Status',
						  'checked'=>'$data->recordstatus'
						),
						),
					));

					$this->endWidget('zii.widgets.jui.CJuiDialog');?>
					<input class="button" type="button" value="..." name="currency_button" onclick="$('#currency_dialog').dialog('open'); return false;">	
				<?php echo $form->error($model,'currencyid'); ?>			
	</div>
	
	<div class="row">
				<?php echo $form->labelEx($model,'recordstatus'); ?>
				<?php echo $form->checkBox($model,'recordstatus'); ?>
				<?php echo $form->error($model,'recordstatus'); ?>
	</div>
			

<?php $this->endWidget(); ?>
</div><!-- form -->

<div class="form">
<?php 
$journaldetail->genjournalid= $model->genjournalid;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'isSave'=>true,'UrlSave'=>'genjournal/write',
	'isCancel'=>true,'UrlCancel'=>'genjournal/cancelwrite'
));
?>
<?php echo $form->hiddenField($model,'genjournalid'); ?>
	<table>
	  <tr>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'journaldate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'journaldate',
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
                  'size'=>'20',
              ),
          ));?>
		<?php echo $form->error($model,'journaldate'); ?>
	</div>
		</td>
		<td>
		  		  <div class="row">
		<?php echo $form->labelEx($model,'postdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'postdate',
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
                  'size'=>'20',
              ),
          ));?>
		<?php echo $form->error($model,'postdate'); ?>
	</div>
		</td>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'referenceno'); ?>
		<?php echo $form->textfield($model,'referenceno',array('size'=>50, 'max'=>50)); ?>
		<?php echo $form->error($model,'referenceno'); ?>
	</div>
		</td>
		<td>
		  <div class="row">
		<?php echo $form->labelEx($model,'journalnote'); ?>
		<?php echo $form->textArea($model,'journalnote',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'journalnote'); ?>
	</div>
		</td>
	</table>
<?php $this->endWidget(); ?>
	<?php
	$this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs' => array(
		'Journal Detail' => array('content' => $this->renderPartial('indexdetail',
			array('journaldetail'=>$journaldetail),true)),
	),
	// additional javascript options for the tabs plugin
	'options' => array(
		'collapsible' => true,
	),
));?>
</div><!-- form -->
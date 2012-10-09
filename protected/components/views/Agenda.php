<div class="agendaform">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agenda-form',
	'enableAjaxValidation'=>true,
)); ?>
	<div class="rowheader">
		<div class="labelheader">Agenda</div>
	</div>
	<div class="rowagenda">
		<?php $this->widget('ext.calendar.SimpleCalendarWidget'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
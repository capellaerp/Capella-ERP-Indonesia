<?php
$this->breadcrumbs=array(
	'Employee',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata4()
{jQuery.ajax({'url':'/index.php?r=employee/createwo','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog4 div.divcreate').html(data.div);$('#Employeewo_employeewoid').val('');$('#Employeewo_informalname').val('');$('#Employeewo_organizer').val('');$('#Employeewo_period').val('');$('#Employeewo_sponsoredby').val('');$('#createdialog4').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata4()
{jQuery.ajax({'url':'/index.php?r=employee/updatewo','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Employeewo_employeeinformalid').val(data.employeeinformalid);$('#Employeewo_informalname').val(data.informalname);$('#Employeewo_organizer').val(data.organizer);$('#Employeewo_period').val(data.period);$('#Employeewo_isdiploma').val(data.isdiploma);$('#Employeewo_sponsoredby').val(data.sponsoredby);
if(data.recordstatus=='1')
{document.forms[4].elements[10].checked=true;}
else
{document.forms[4].elements[10].checked=false;}
$('#createdialog4').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata4()
{jQuery.ajax({'url':'/index.php?r=employee/deletewo','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata4()
{$.fn.yiiGridView.update('detail4datagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog4',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formwo', array('model'=>$employeewo)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata4()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata4()',
	'UrlDownload'=>'downloaddata4()',
	'isEdit'=>true,'UrlEdit'=>'editdata4()',
	'isDelete'=>true,'UrlDelete'=>'deletedata4()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail4datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail4datagrid',
	'dataProvider'=>$employeewo->search(),
	'filter'=>$employeewo,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeewoid', 'visible'=>false, 'header'=>'ID','value'=>'$data->employeewoid','htmlOptions'=>array('width'=>'1%')),
		'informalname',
		'organizer',
'sponsoredby',
        'period',
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Status',
      'checked'=>'$data->recordstatus'
    ),
	),
)); 
?>
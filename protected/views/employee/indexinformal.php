<?php
$this->breadcrumbs=array(
	'Employee',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata3()
{jQuery.ajax({'url':'/index.php?r=employee/createinformal','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog3 div.divcreate').html(data.div);$('#Employeeinformal_employeeinformalid').val('');$('#Employeeinformal_informalname').val('');$('#Employeeinformal_organizer').val('');$('#Employeeinformal_period').val('');$('#Employeeinformal_sponsoredby').val('');$('#createdialog3').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata3()
{jQuery.ajax({'url':'/index.php?r=employee/updateinformal','data':{'id':$.fn.yiiGridView.getSelection("detail3datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog3 div.divcreate').html(data.div);$('#Employeeinformal_employeeinformalid').val(data.employeeinformalid);$('#Employeeinformal_informalname').val(data.informalname);$('#Employeeinformal_organizer').val(data.organizer);$('#Employeeinformal_period').val(data.period);$('#Employeeinformal_isdiploma').val(data.isdiploma);$('#Employeeinformal_sponsoredby').val(data.sponsoredby);if(data.isdiploma=='1')
{document.forms[3].elements[10].checked=true;}
else
{document.forms[3].elements[10].checked=false;}
if(data.recordstatus=='1')
{document.forms[3].elements[13].checked=true;}
else
{document.forms[3].elements[13].checked=false;}
$('#createdialog3').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata3()
{jQuery.ajax({'url':'/index.php?r=employeeinformal/delete','data':{'id':$.fn.yiiGridView.getSelection("detail3datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata3()
{$.fn.yiiGridView.update('detail3datagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog3',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_forminformal', array('model'=>$employeeinformal)); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divhelp"></div>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata3()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata3()',
	'UrlDownload'=>'downloaddata3()',
	'isEdit'=>true,'UrlEdit'=>'editdata3()',
	'isDelete'=>true,'UrlDelete'=>'deletedata3()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail3datagrid',{data:{pageSize: $(this).val() }})"));
?><?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail3datagrid',
	'dataProvider'=>$employeeinformal->search(),
	'filter'=>$employeeinformal,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeeinformalid', 'visible'=>false, 'header'=>'ID','value'=>'$data->employeeinformalid','htmlOptions'=>array('width'=>'1%')),
		'informalname',
		'organizer',
		'period',
		array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Is Certificate',
      'checked'=>'$data->isdiploma'
    ),
		'sponsoredby',
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
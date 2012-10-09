<?php
$this->breadcrumbs=array(
	'Employee',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata2()
{jQuery.ajax({'url':'/index.php?r=employee/createeducation','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog2 div.divcreate').html(data.div);$('#Employeeeducation_employeeeducationid').val('');$('#Employeeeducation_educationid').val('');$('#education_name').val('');$('#Employeeeducation_schoolname').val('');$('#Employeeeducation_cityid').val('');$('#educity_name').val('');$('#Employeeeducation_yeargraduate').val('');$('#createdialog2').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata2()
{jQuery.ajax({'url':'/index.php?r=employee/updateeducation','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog2 div.divcreate').html(data.div);$('#Employeeeducation_employeeeducationid').val(data.employeeeducationid);$('#Employeeeducation_educationid').val(data.educationid);$('#education_name').val(data.educationname);$('#Employeeeducation_schoolname').val(data.schoolname);$('#Employeeeducation_cityid').val(data.cityid);$('#educity_name').val(data.cityname);$('#Employeeeducation_yeargraduate').val(data.yeargraduate);$('#Employeeeducation_isdiploma').val(data.isdiploma);if(data.isdiploma=='1')
{document.forms[2].elements[16].checked=true;}
else
{document.forms[2].elements[16].checked=false;}
if(data.recordstatus=='1')
{document.forms[2].elements[18].checked=true;}
else
{document.forms[2].elements[18].checked=false;}
$('#createdialog2').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=employee/deleteeducation','data':{'id':$.fn.yiiGridView.getSelection("detail2datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata2()
{$.fn.yiiGridView.update('detail2datagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog2',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formeducation', array('model'=>$employeeeducation)); ?>
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
	array('isCreate'=>true,'UrlCreate'=>'adddata2()','isRefresh'=>true,
	'isEdit'=>true,'UrlEdit'=>'editdata2()',
	'UrlRefresh'=>'refreshdata2()',
	'UrlDownload'=>'downloaddata2()',
	'isDelete'=>true,'UrlDelete'=>'deletedata2()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail2datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail2datagrid',
	'dataProvider'=>$employeeeducation->search(),
	'filter'=>$employeeeducation,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeeeducationid','visible'=>false, 'header'=>'ID','value'=>'$data->employeeeducationid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'educationid', 'value'=>'$data->education->educationname'),
		'schoolname',
		'schooldegree',
		array('name'=>'cityid', 'value'=>'$data->city->cityname'),
		'yeargraduate',
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isdiploma',
      'selectableRows'=>'0',
      'header'=>'Is Certificate',
      'checked'=>'$data->isdiploma'
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	),
)); 
?>


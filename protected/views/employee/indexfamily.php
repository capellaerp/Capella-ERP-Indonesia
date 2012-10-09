<?php
$this->breadcrumbs=array(
	'Employee',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata5()
{jQuery.ajax({'url':'/index.php?r=employee/createfamily','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog5 div.divcreate').html(data.div);$('#Employeefamily_employeefamilyid').val('');$('#Employeefamily_familyrelationid').val('');$('#familyrelation_name').val('');$('#Employeefamily_familyname').val('');$('#Employeefamily_sexid').val('');$('#sex_name').val('');$('#Employeefamily_cityid').val('');$('#city_name').val('');$('#Employeefamily_birthdate').val('');$('#Employeefamily_educationid').val('');$('#education_name').val('');$('#Employeefamily_occupationid').val('');$('#occupation_name').val('');$('#createdialog5').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata5()
{jQuery.ajax({'url':'/index.php?r=employee/updatefamily','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog5 div.divcreate').html(data.div);$('#Employeefamily_employeefamilyid').val(data.employeefamilyid);$('#Employeefamily_familyrelationid').val(data.familyrelationid);$('#familyrelation_name').val(data.familyrelationname);$('#Employeefamily_familyname').val(data.familyname);$('#Employeefamily_sexid').val(data.sexid);$('#sex_name').val(data.sexname);$('#Employeefamily_cityid').val(data.cityid);$('#city_name').val(data.cityname);$('#Employeefamily_birthdate').val(data.birthdate);$('#Employeefamily_educationid').val(data.educationid);$('#education_name').val(data.educationname);$('#Employeefamily_occupationid').val(data.occupationid);$('#occupation_name').val(data.occupationname);
  if(data.recordstatus=='1')
{document.forms[5].elements[22].checked=true;}
else
{document.forms[5].elements[22].checked=false;}
$('#createdialog5').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata5()
{jQuery.ajax({'url':'/index.php?r=employee/deletefamily','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata5()
{$.fn.yiiGridView.update('detail5datagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog5',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formfamily', array('model'=>$employeefamily)); ?>
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
	array('isCreate'=>true,'UrlCreate'=>'adddata5()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata5()',
	'UrlDownload'=>'downloaddata5()',
	'isEdit'=>true,'UrlEdit'=>'editdata5()',
	'isDelete'=>true,'UrlDelete'=>'deletedata5()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail5datagrid',{data:{pageSize: $(this).val() }})"));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail5datagrid',
	'dataProvider'=>$employeefamily->search(),
	'filter'=>$employeefamily,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeefamilyid', 'visible'=>false,'header'=>'ID','value'=>'$data->employeefamilyid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'familyrelationid', 'value'=>'($data->familyrelation!==null)?$data->familyrelation->familyrelationname:""'),
		'familyname',
		array('name'=>'sexid', 'value'=>'($data->sex!==null)?$data->sex->sexname:""'),
		array('name'=>'cityid', 'value'=>'($data->city!==null)?$data->city->cityname:""'),
		 array(
      'name'=>'birthdate',
      'type'=>'raw',
         'value'=>'($data->birthdate!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->birthdate)):""'
     ),
		array('name'=>'educationid', 'value'=>'($data->education!==null)?$data->education->educationname:""'),
		array('name'=>'occupationid', 'value'=>'($data->occupation!==null)?$data->occupation->occupationname:""'),
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

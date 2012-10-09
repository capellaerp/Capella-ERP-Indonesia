<?php
$this->breadcrumbs=array(
	'Wfgroups',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=wfgroup/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Wfgroup_wfgroupid').val('');
$('#Wfgroup_groupaccessid').val('');$('#groupname').val('');
$('#Wfgroup_workflowid').val('');$('#wfdesc').val('');
$('#Wfgroup_wfbefstat').val('');
$('#Wfgroup_wfrecstat').val('');$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=wfgroup/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Wfgroup_wfgroupid').val(data.wfgroupid);
$('#Wfgroup_groupaccessid').val(data.groupaccessid);$('#groupname').val(data.groupname);
$('#Wfgroup_workflowid').val(data.workflowid);$('#wfdesc').val(data.wfdesc);
$('#Wfgroup_wfbefstat').val(data.wfbefstat);
$('#Wfgroup_wfrecstat').val(data.wfrecstat);
if(data.recordstatus=='1')
{document.forms[1].elements[12].checked=true;}
else
{document.forms[1].elements[12].checked=false;}
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=wfgroup/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=wfgroup/help',
        'data': {
            'id': value
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if (data.status == 'success') {
				document.getElementById('divhelp').innerHTML = data.div;
                $('#helpdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#messages');
		new AjaxUpload(btnUpload, {
			action: 'index.php?r=wfgroup/upload',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (!(ext && /^(csv)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only CSV files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				status.text('');
				//Add uploaded file to list
				if(response==='success'){
					$.fn.yiiGridView.update('datagrid');
				} else{
					status.text(response);
				}
			}
		});		
	});
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=wfgroup/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#groupname','fallback' => Catalogsys::model()->getcatalog('enterpopgroupname'),'html'=>true),    
    array('id' => '#wfdesc','fallback' => Catalogsys::model()->getcatalog('enterpopwfdesc'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'groupaccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('entergroupaccessid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'workflowid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterworkflowid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'wfbefstat')
     ,'fallback' => Catalogsys::model()->getcatalog('enterwfbefstat'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'wfrecstat')
     ,'fallback' => Catalogsys::model()->getcatalog('enterwfrecstat'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'recordstatus')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrecordstatus'),'html'=>true),    
  ),  
));
?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,
				'workflow'=>$this->workflow,
				'groupaccess'=>$this->groupaccess)); ?>
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
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpmodifdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divhelpmodif"></div>
<?php $this->endWidget();?>
<h1><?php echo Catalogsys::model()->GetCatalog('wfgroup') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=wfgroup/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->Search(),
	'filter'=>$model,
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'wfgroupid',
    ),
	array('name'=>'wfgroupid', 'visible'=>false, 'value'=>'$data->wfgroupid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'workflowid', 'value'=>'$data->workflow->wfdesc'),
		array('name'=>'groupaccessid', 'value'=>'($data->groupaccess!==null)?$data->groupaccess->groupname:""'),
		'wfbefstat',
		'wfrecstat',
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
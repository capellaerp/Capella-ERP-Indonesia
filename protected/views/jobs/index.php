<?php
$this->breadcrumbs=array(
	'Jobss',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=jobs/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Jobs_jobsid').val('');$('#Jobs_orgstructureid').val('');
$('#structurename').val('');$('#Jobs_jobdesc').val('');$('#Jobs_jobqty').val('');$('#Jobs_qualification').val('');
$('#positionname').val('');$('#Jobs_positionid').val('');
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=jobs/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Jobs_jobsid').val(data.jobsid);$('#Jobs_orgstructureid').val(data.orgstructureid);
$('#structurename').val(data.structurename);
$('#Jobs_positionid').val(data.positionid);
$('#positionname').val(data.positionname);
$('#Jobs_jobdesc').val(data.jobdesc);$('#Jobs_jobqty').val(data.jobqty);
$('#positionname').val(data.positionname);$('#Jobs_positionid').val(data.positionid);
$('#Jobs_qualification').val(data.qualification);if(data.recordstatus=='1')
{document.forms[1].elements[10].checked=true;}
else
{document.forms[1].elements[10].checked=false;}
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=jobs/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=jobs/help',
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
			action: 'index.php?r=jobs/upload',
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
	window.open('/index.php?r=jobs/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#structurename'
     ,'fallback' => Catalogsys::model()->getcatalog('enterorgstructureid'),'html'=>true),    
    array('id' => '#positionname'
     ,'fallback' => Catalogsys::model()->getcatalog('enterpositionid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'orgstructureid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterorgstructureid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'positionid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpositionid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'jobdesc')
     ,'fallback' => Catalogsys::model()->getcatalog('enterjobdesc'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'qualification')
     ,'fallback' => Catalogsys::model()->getcatalog('enterqualification'),'html'=>true),    
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
      'orgstructure'=>$orgstructure,
    'position'=>$position)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('jobs') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=jobs/upload',
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
	'afterAjaxUpdate' => 'function(id,data){ initTipsy(); }',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'jobsid',
    ),
	array('name'=>'jobsid', 'visible'=>false,'value'=>'$data->jobsid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'orgstructureid', 'value'=>'($data->orgstructure!==null)?$data->orgstructure->structurename:""'),
		array('name'=>'positionid', 'value'=>'($data->position!==null)?$data->position->positionname:""'),
		'jobdesc',
		'qualification',
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

<?php
$this->breadcrumbs=array(
	'Usergroupes',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=usergroup/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML = '';if(data.status=='success')
{                $('#Usergroup_usergroupid').val('');
                $('#Usergroup_useraccessid').val('');
                $('#username').val('');
                $('#Usergroup_groupaccessid').val('');
                $('#groupname').val('');
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=usergroup/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML = '';if(data.status=='success')
{                $('#createdialog div.divcreate').html(data.div);
                $('#Usergroup_usergroupid').val(data.usergroupid);
                $('#Usergroup_useraccessid').val(data.useraccessid);
                $('#username').val(data.username);
                $('#Usergroup_groupaccessid').val(data.groupaccessid);
                $('#groupname').val(data.groupname);
                if (data.recordstatus == '1') {
                    document.forms[1].elements[10].checked = true;
                } else {
                    document.forms[1].elements[10].checked = false;
                }
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=usergroup/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML=data.div;},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=usergroup/help',
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
			action: 'index.php?r=usergroup/upload',
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
	window.open('/index.php?r=usergroup/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#username','fallback'=>Catalogsys::model()->getcatalog('enterpopusername'),'html'=>true),    
    array('id' => '#groupname','fallback'=>Catalogsys::model()->getcatalog('enterpopgroupname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'useraccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('enteruseraccessid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'realname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrealname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'groupaccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('entergroupaccessid'),'html'=>true),    
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
  'useraccess'=>$useraccess,
'groupaccess'=>$groupaccess));
?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('usergroup') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=usergroup/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
		'afterAjaxUpdate' => 'function(id,data){ initTipsy(); }',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	  array(
		'class'=>'CCheckBoxColumn',
		'id'=>'usergroupid',
	  ),
	  array('name'=>'usergroupid', 'visible'=>false,'value'=>'$data->usergroupid','htmlOptions'=>array('width'=>'1%')),
	  array('name'=>'useraccessid', 'value'=>'($data->useraccess!==null)?$data->useraccess->username:""'),
	  array('name'=>'realname', 'value'=>'($data->useraccess!==null)?$data->useraccess->realname:""'),
	  array('name'=>'groupaccessid', 'value'=>'$data->groupaccess->groupname'),
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

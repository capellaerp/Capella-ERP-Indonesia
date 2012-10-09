<?php
$this->breadcrumbs=array(
	'Useraccesses',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=useraccess/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML = '';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Useraccess_useraccessid').val('');
$('#Useraccess_username').val('');$('#Useraccess_realname').val('');$('#Useraccess_email').val('');$('#passhide').val('');$('#Useraccess_password').val('');
$('#Useraccess_languageid').val('');$('#Useraccess_phoneno').val('');
$('#languagename').val('');
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=useraccess/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML = '';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Useraccess_useraccessid').val(data.useraccessid);$('#Useraccess_username').val(data.username);
$('#Useraccess_realname').val(data.realname);$('#Useraccess_email').val(data.email);
$('#Useraccess_languageid').val(data.languageid);
$('#Useraccess_phoneno').val(data.phoneno);
$('#languagename').val(data.languagename);
$('#passhide').val(data.password);$('#Useraccess_password').val('');if(data.recordstatus=='1')
{document.forms[1].elements[13].checked=true;}
else
{document.forms[1].elements[13].checked=false;}
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=useraccess/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=useraccess/help',
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
			action: 'index.php?r=useraccess/upload',
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
	window.open('/index.php?r=useraccess/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#languagename','fallback'=>Catalogsys::model()->getcatalog('enterpoplanguagename'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'realname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrealname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'username')
     ,'fallback' => Catalogsys::model()->getcatalog('enterusername'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'password')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpassword'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'email')
     ,'fallback' => Catalogsys::model()->getcatalog('enteremail'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'phoneno')
     ,'fallback' => Catalogsys::model()->getcatalog('enterphoneno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'languageid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterlanguageid'),'html'=>true),    
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
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('useraccess') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=useraccess/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
'filter'=>$model,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'afterAjaxUpdate' => 'function(id,data){ initTipsy(); }',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'useraccessid',
    ),
	array('name'=>'useraccessid','visible'=>false, 'header'=>'ID','value'=>'$data->useraccessid','htmlOptions'=>array('width'=>'1%')),
		'username',
    'realname',
		'email',
		'phoneno',
	array('name'=>'languageid','value'=>'($data->language!==null)?$data->language->languagename:""'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	),
)); ?>

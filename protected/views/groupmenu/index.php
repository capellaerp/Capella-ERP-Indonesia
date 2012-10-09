<?php
$this->breadcrumbs=array(
	'Groupmenues',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=groupmenu/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Groupmenu_groupmenuid').val('');
                $('#Groupmenu_groupaccessid').val('');
                $('#groupname').val('');
                $('#Groupmenu_menuaccessid').val('');
                $('#menuname').val('');
                $('#createdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function editdata() {
    jQuery.ajax({
        'url': '/index.php?r=groupmenu/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Groupmenu_groupmenuid').val(data.groupmenuid);
                $('#Groupmenu_groupaccessid').val(data.groupaccessid);
                $('#groupname').val(data.groupname);
                $('#Groupmenu_menuaccessid').val(data.menuaccessid);
                $('#menuname').val(data.menuname);
                if (data.isread == '1') {
                    document.forms[1].elements[10].checked = true;
                } else {
                    document.forms[1].elements[10].checked = false;
                }
                if (data.iswrite == '1') {
                    document.forms[1].elements[12].checked = true;
                } else {
                    document.forms[1].elements[12].checked = false;
                }
                if (data.ispost == '1') {
                    document.forms[1].elements[14].checked = true;
                } else {
                    document.forms[1].elements[14].checked = false;
                }
                if (data.isreject == '1') {
                    document.forms[1].elements[16].checked = true;
                } else {
                    document.forms[1].elements[16].checked = false;
                }
                if (data.isupload == '1') {
                    document.forms[1].elements[18].checked = true;
                } else {
                    document.forms[1].elements[18].checked = false;
                }
                if (data.isdownload == '1') {
                    document.forms[1].elements[20].checked = true;
                } else {
                    document.forms[1].elements[20].checked = false;
                }
                $('#createdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=groupmenu/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML=data.div;},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=groupmenu/help',
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
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=groupmenu/help',
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
			action: 'index.php?r=groupmenu/upload',
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
	window.open('/index.php?r=groupmenu/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#groupname','fallback'=>Catalogsys::model()->getcatalog('enterpopgroupname'),'html'=>true),    
    array('id' => '#menuname','fallback'=>Catalogsys::model()->getcatalog('enterpopmenuname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'groupaccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('entergroupaccessid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'menuaccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermenuaccessid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'menudescription')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpopmenuname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isread')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisread'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'iswrite')
     ,'fallback' => Catalogsys::model()->getcatalog('enteriswrite'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'ispost')
     ,'fallback' => Catalogsys::model()->getcatalog('enterispost'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isreject')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisreject'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isupload')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisupload'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isdownload')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisdownload'),'html'=>true),    
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
'groupaccess'=>$groupaccess,
'menuaccess'=>$menuaccess));?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('groupmenu') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=groupmenu/upload',
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
	'template'=>'{pager}<br>{items}{pager}',
	'afterAjaxUpdate' => 'function(id,data){ initTipsy(); }',
	'columns'=>array(
	  array(
		'class'=>'CCheckBoxColumn',
		'id'=>'groupmenuid',
	  ),
	  array('name'=>'groupmenuid','visible'=>false, 'value'=>'$data->groupmenuid','htmlOptions'=>array('width'=>'1%')),
	  array('name'=>'groupaccessid', 'value'=>'($data->groupaccess!==null)?$data->groupaccess->groupname:""'),
	  array('name'=>'menuaccessid', 'value'=>'($data->menuaccess!==null)?$data->menuaccess->menuname:""'),
	  array('name'=>'menudescription', 'value'=>'($data->menuaccess!==null)?$data->menuaccess->description:""'),
	  array('class'=>'CCheckBoxColumn',
		'name'=>'isread',
		'header'=>'Is Read',
		'selectableRows'=>'0',
		'checked'=>'$data->isread'),
array('class'=>'CCheckBoxColumn',
		'name'=>'iswrite',
		'header'=>'Is Write',
		'selectableRows'=>'0',
		'checked'=>'$data->iswrite'),
array('class'=>'CCheckBoxColumn',
		'name'=>'ispost',
		'header'=>'Is Post',
		'selectableRows'=>'0',
		'checked'=>'$data->ispost'),
array('class'=>'CCheckBoxColumn',
		'name'=>'isreject',
		'header'=>'Is Reject',
		'selectableRows'=>'0',
		'checked'=>'$data->isreject'),
array('class'=>'CCheckBoxColumn',
		'name'=>'isupload',
		'header'=>'Is Upload',
		'selectableRows'=>'0',
		'checked'=>'$data->isupload'),
array('class'=>'CCheckBoxColumn',
		'name'=>'isdownload',
		'header'=>'Is Download',
		'selectableRows'=>'0',
		'checked'=>'$data->isdownload'),

	),
));
?>

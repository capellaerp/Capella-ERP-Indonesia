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
                $('#menuobject').val('');
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
                $('#Groupmenu_menuaccessid').val(data.menuauthid);
                $('#menuobject').val(data.menuobject);
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
'menuauth'=>$menuauth));?>
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
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#groupname','fallback'=>Catalogsys::model()->getcatalog('enterpopgroupname'),'html'=>true),    
    array('id' => '#menuobject','fallback'=>Catalogsys::model()->getcatalog('enterpopmenuauth'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'groupaccessid')
     ,'fallback' => Catalogsys::model()->getcatalog('entergroupaccessid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'menuauthid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpopmenuauth'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'menuvalueid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermenuvalueid'),'html'=>true),    
  ),  
));
?>
<h1><?php echo Catalogsys::model()->GetCatalog('groupmenuauth') ?></h1>
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
	'columns'=>array(
	  array(
		'class'=>'CCheckBoxColumn',
		'id'=>'groupmenuid',
	  ),
	  array('name'=>'groupmenuid','visible'=>false, 'value'=>'$data->groupmenuid','htmlOptions'=>array('width'=>'1%')),
	  array('name'=>'groupaccessid', 'value'=>'$data->groupaccess->groupname'),
	  array('name'=>'menuauthid', 'value'=>'$data->menuauth->menuobject'),
	  'menuvalueid'
	),
));
?>

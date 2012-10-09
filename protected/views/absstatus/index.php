<?php
$this->breadcrumbs=array(
	'Absstatuses',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=absstatus/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
				document.getElementById('divcreate').innerHTML = data.div;
                $('#Absstatus_absstatusid').val('');
                $('#Absstatus_shortstat').val('');
                $('#Absstatus_longstat').val('');
                $('#Absstatus_priority').val('');
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
        'url': '/index.php?r=absstatus/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
				document.getElementById('divcreate').innerHTML = data.div;
                $('#Absstatus_absstatusid').val(data.absstatusid);
                $('#Absstatus_shortstat').val(data.shortstat);
                $('#Absstatus_longstat').val(data.longstat);
                if (data.isin == '1') {
                    document.forms[1].elements[4].checked = true;
                } else {
                    document.forms[1].elements[4].checked = false;
                }
                $('#Absstatus_priority').val(data.priority);
                if (data.recordstatus == '1') {
                    document.forms[1].elements[7].checked = true;
                } else {
                    document.forms[1].elements[7].checked = false;
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
{jQuery.ajax({'url':'/index.php?r=absstatus/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML=data.div;},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=absstatus/help',
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
			action: 'index.php?r=absstatus/upload',
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
	window.open('/index.php?r=absstatus/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => array('model' => $model, 'attribute' => 'shortstat')
     ,'fallback' => Catalogsys::model()->getcatalog('entershortstat'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'longstat')
     ,'fallback' => Catalogsys::model()->getcatalog('enterlongstat'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isin')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisin'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'priority')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpriority'),'html'=>true),    
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
<?php $this->renderPartial('_form', array('model'=>$model), true);?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('absstatus') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=absstatus/upload',
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
		'id'=>'absstatusid',
	  ),
	  array('name'=>'absstatusid', 'visible'=>false,'value'=>'$data->absstatusid','htmlOptions'=>array('width'=>'1%')),
		  'shortstat',
		  'longstat',
	  array('class'=>'CCheckBoxColumn',
		'name'=>'isin',
		'header'=>'Is In',
		'selectableRows'=>'0',
		'checked'=>'$data->isin'),
		  'priority',
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

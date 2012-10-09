<?php
$this->breadcrumbs=array(
	'Employeetypes',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=employeetype/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Employeetype_employeetypeid').val('');
                $('#Employeetype_employeetypename').val('');
                $('#Employeetype_snroid').val('');
                $('#snro_name').val('');
                $('#sicksnro_name').val('');
                $('#sickstatus_name').val('');
                $('#Employeetype_sicksnroid').val('');
                $('#Employeetype_sickstatusid').val('');
                $('#stat_name').val('');
                $('#createdialog').dialog('open');
            }
            else {
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
        'url': '/index.php?r=employeetype/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Employeetype_employeetypeid').val(data.employeetypeid);
                $('#Employeetype_employeetypename').val(data.employeetypename);
                $('#Employeetype_snroid').val(data.snroid);
                $('#snro_name').val(data.snroname);
                $('#sicksnro_name').val(data.sicksnroname);
                $('#sickstatus_name').val(data.sickstatusname);
                $('#Employeetype_sicksnroid').val(data.sicksnroid);
                $('#Employeetype_sickstatusid').val(data.sickstatusid);
                if (data.recordstatus == '1') {
                    document.forms[1].elements[12].checked = true;
                }
                else {
                    document.forms[1].elements[12].checked = false;
                }
                $('#createdialog').dialog('open');
            }
            else {
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
{jQuery.ajax({'url':'/index.php?r=employeetype/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=employeetype/help',
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
			action: 'index.php?r=employeetype/upload',
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
	window.open('/index.php?r=employeetype/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#sicksnro_name'
     ,'fallback' => Catalogsys::model()->getcatalog('entersnroid'),'html'=>true),    
    array('id' => '#sickstatus_name'
     ,'fallback' => Catalogsys::model()->getcatalog('enterabsstatusid'),'html'=>true),    
    array('id' => '#snro_name'
     ,'fallback' => Catalogsys::model()->getcatalog('entersnroid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'employeetypename')
     ,'fallback' => Catalogsys::model()->getcatalog('enteremployeetypename'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'snroid')
     ,'fallback' => Catalogsys::model()->getcatalog('entersnroid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'sicksnroid')
     ,'fallback' => Catalogsys::model()->getcatalog('entersicksnroid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'sickstatusid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterabsstatusid'),'html'=>true),    
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
      'snro'=>$snro,
      'sicksnro'=>$sicksnro,
      'sickstatus'=>$sickstatus)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('employeetype') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=employeetype/upload',
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
      'id'=>'ids',
    ),
	array('name'=>'employeetypeid','visible'=>false, 'header'=>'ID','value'=>'$data->employeetypeid','htmlOptions'=>array('width'=>'1%')),
		'employeetypename',
		array('name'=>'snroid','header'=>'NIK Format','value'=>'$data->snro->formatdoc'),
		array('name'=>'sicksnroid','header'=>'Sick Format','value'=>'$data->sicksnro->formatdoc'),
		array('name'=>'sickstatusid','header'=>'Absence Status','value'=>'$data->sickstatus->shortstat'),
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

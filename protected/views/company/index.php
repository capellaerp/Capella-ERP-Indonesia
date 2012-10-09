<?php
$this->breadcrumbs=array(
	'Companys',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=company/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Company_companyid').val('');$('#Company_companyname').val('');$('#Company_address').val('');
$('#Company_cityid').val('');$('#cityname').val('');$('#Company_zipcode').val('');$('#Company_taxno').val('');
$('#Company_currencyid').val(data.currencyid);
$('#currencyname').val(data.currencyname);
    $('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=company/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Company_companyid').val(data.companyid);$('#Company_companyname').val(data.companyname);
$('#Company_address').val(data.address);$('#Company_cityid').val(data.cityid);$('#cityname').val(data.cityname);
$('#Company_zipcode').val(data.zipcode);
$('#Company_taxno').val(data.taxno);if(data.recordstatus=='1')
{document.forms[1].elements[10].checked=true;}
else
{document.forms[1].elements[10].checked=false;}
$('#Company_currencyid').val(data.currencyid);
$('#currencyname').val(data.currencyname);
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=company/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=company/help',
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
			action: 'index.php?r=company/upload',
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
	window.open('/index.php?r=company/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
        'currency'=>$currency,
		'city'=>$city)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('company') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=company/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#currencyname','fallback'=>Catalogsys::model()->getcatalog('enterpopcurrencyname'),'html'=>true),    
    array('id' => '#cityname','fallback'=>Catalogsys::model()->getcatalog('enterpopcityname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'companyname')
     ,'fallback' => Catalogsys::model()->getcatalog('entercompanyname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'cityid')
     ,'fallback' => Catalogsys::model()->getcatalog('entercityid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'currencyid')
     ,'fallback' => Catalogsys::model()->getcatalog('entercurrencyid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'address')
     ,'fallback' => Catalogsys::model()->getcatalog('enteraddress'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'zipcode')
     ,'fallback' => Catalogsys::model()->getcatalog('enterzipcode'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'recordstatus')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrecordstatus'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'taxno')
     ,'fallback' => Catalogsys::model()->getcatalog('entertaxno'),'html'=>true),    
  ),  
));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'companyid',
    ),
	array('name'=>'companyid','visible'=>false, 'value'=>'$data->companyid','htmlOptions'=>array('width'=>'1%')),
		'companyname',
		'address',
	array('name'=>'cityid', 'value'=>'$data->city->cityname','htmlOptions'=>array('width'=>'1%')),
		'zipcode',
		'taxno',
	array('name'=>'currencyid', 'value'=>'$data->currency->currencyname','htmlOptions'=>array('width'=>'1%')),
		array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	), 
)); ?>

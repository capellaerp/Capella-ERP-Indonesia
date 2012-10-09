<?php
$this->breadcrumbs=array(
	'Addressbooks',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=addressbook/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Addressbook_addressbookid').val('');$('#Addressbook_fullname').val('');$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=addressbook/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Addressbook_addressbookid').val(data.addressbookid);$('#Addressbook_fullname').val(data.fullname);if(data.iscustomer=='1')
{document.forms[1].elements[5].checked=true;}
else
{document.forms[1].elements[5].checked=false;}
if(data.isemployee=='1')
{document.forms[1].elements[7].checked=true;}
else
{document.forms[1].elements[7].checked=false;}
if(data.isapplicant=='1')
{document.forms[1].elements[9].checked=true;}
else
{document.forms[1].elements[9].checked=false;}
if(data.isvendor=='1')
{document.forms[1].elements[11].checked=true;}
else
{document.forms[1].elements[11].checked=false;}
if(data.isinsurance=='1')
{document.forms[1].elements[13].checked=true;}
else
{document.forms[1].elements[13].checked=false;}
if(data.isbank=='1')
{document.forms[1].elements[15].checked=true;}
else
{document.forms[1].elements[15].checked=false;}
if(data.ishospital=='1')
{document.forms[1].elements[17].checked=true;}
else
{document.forms[1].elements[17].checked=false;}
if(data.iscatering=='1')
{document.forms[1].elements[19].checked=true;}
else
{document.forms[1].elements[19].checked=false;}
if(data.isstudent=='1')
{document.forms[1].elements[21].checked=true;}
else
{document.forms[1].elements[21].checked=false;}
if(data.recordstatus=='1')
{document.forms[1].elements[25].checked=true;}
else
{document.forms[1].elements[25].checked=false;}
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=addressbook/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=addressbook/help',
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
			action: 'index.php?r=addressbook/upload',
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
	window.open('/index.php?r=addressbook/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => array('model' => $model, 'attribute' => 'fullname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfullname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'taxno')
     ,'fallback' => Catalogsys::model()->getcatalog('entertaxno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'abno')
     ,'fallback' => Catalogsys::model()->getcatalog('enterabno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'iscustomer')
     ,'fallback' => Catalogsys::model()->getcatalog('enteriscustomer'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isemployee')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisemployee'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isapplicant')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisapplicant'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isvendor')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisvendor'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isinsurance')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisinsurance'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isbank')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisbank'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'ishospital')
     ,'fallback' => Catalogsys::model()->getcatalog('enterishospital'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'iscatering')
     ,'fallback' => Catalogsys::model()->getcatalog('enteriscatering'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'isstudent')
     ,'fallback' => Catalogsys::model()->getcatalog('enterisstudent'),'html'=>true),    
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
<h1><?php echo Catalogsys::model()->GetCatalog('addressbook') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=addressbook/upload',
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
	array('name'=>'addressbookid','visible'=>false, 'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
	'fullname',
        'taxno',
        'abno',
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'iscustomer',
      'selectableRows'=>'0',
      'header'=>'Is Customer',
      'checked'=>'$data->iscustomer',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isemployee',
      'selectableRows'=>'0',
      'header'=>'Is Employee',
      'checked'=>'$data->isemployee',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isapplicant',
      'selectableRows'=>'0',
      'header'=>'Is Applicant',
      'checked'=>'$data->isapplicant',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isvendor',
      'selectableRows'=>'0',
      'header'=>'Is Vendor',
      'checked'=>'$data->isvendor',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isinsurance',
      'selectableRows'=>'0',
      'header'=>'Is Insurance',
      'checked'=>'$data->isinsurance',
    ),
	array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isbank',
      'selectableRows'=>'0',
      'header'=>'Is Bank',
      'checked'=>'$data->isbank',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'ishospital',
      'selectableRows'=>'0',
      'header'=>'Is Hospital',
      'checked'=>'$data->ishospital',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'iscatering',
      'selectableRows'=>'0',
      'header'=>'Is Catering',
      'checked'=>'$data->iscatering',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isstudent',
      'selectableRows'=>'0',
      'header'=>'Is Student',
      'checked'=>'$data->recordstatus',
    ),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus',
    ),
  ),
));
?>

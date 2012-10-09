<?php
$this->breadcrumbs=array(
	'Suppliers',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=supplier/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Supplier_addressbookid').val(data.addressbookid);
$('#Supplier_taxno').val('');$('#Supplier_fullname').val('');$('#Supplier_acchutangid').val('');$('#acchutangname').val('');
document.forms[2].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Supplieraddress[addressbookid]': data.addressbookid
                    }});
                                        document.forms[3].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Suppliercontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=supplier/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Supplier_addressbookid').val(data.addressbookid);
$('#Supplier_acchutangid').val(data.acchutangid);$('#acchutangname').val(data.acchutangname);
$('#Supplier_taxno').val(data.taxno);$('#Supplier_fullname').val(data.fullname);if(data.recordstatus=='1')
{document.forms[1].elements[9].checked=true;}
else
{document.forms[1].elements[9].checked=false;}
document.forms[2].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Supplieraddress[addressbookid]': data.addressbookid
                    }});
                    document.forms[3].elements[3].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Suppliercontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=supplier/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=supplier/help',
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
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        'Supplieraddress[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    $.fn.yiiGridView.update('incontactdatagrid', {
                    data: {
                        'Suppliercontact[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=supplier/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
'supplieraddress'=>$supplieraddress,
'suppliercontact'=>$suppliercontact,
                    'acchutang'=>$acchutang)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('supplier') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=supplier/upload',
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
    'selectionChanged'=>'showdetail',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'addressbookid',
    ),
	array('name'=>'addressbookid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
		'fullname',
        'taxno',
		array('name'=>'acchutangid','value'=>'($data->acchutang!==null)?$data->acchutang->accountname:""'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	),
)); 
?><?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>$supplieraddress->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
array('name'=>'addresstypeid', 'value'=>'($data->addresstype!==null)?$data->addresstype->addresstypename:""'),
		'addressname',
		'rt',
    'rw',
		array('name'=>'cityid','header'=>'City','value'=>'($data->city!==null)?$data->city->cityname:""'),
		array('name'=>'kelurahanid','header'=>'Sub Subdistrict','value'=>'($data->kelurahan!==null)?$data->kelurahan->kelurahanname:""'),
		array('name'=>'subdistrictid','header'=>'Subdistrict','value'=>'($data->subdistrict!==null)?$data->subdistrict->subdistrictname:""'),
				'phoneno'
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'incontactdatagrid',
	'dataProvider'=>$suppliercontact->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
array('name'=>'contacttypeid', 'value'=>'($data->contacttype!==null)?$data->contacttype->contacttypename:""'),
		'addresscontactname',
				'phoneno',
		'mobilephone',
		'emailaddress',
  ),
));
?>

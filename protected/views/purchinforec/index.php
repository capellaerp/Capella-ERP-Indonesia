<?php
$this->breadcrumbs=array(
	'Purchinforecs',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=purchinforec/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);					$('#Purchinforec_purchinforecid').val('');
					$('#Purchinforec_addressbookid').val('');
					$('#addressbook_name').val('');
					$('#Purchinforec_productid').val('');
					$('#productname').val('');
					$('#Purchinforec_materialgroupid').val('');
					$('#materialgroupcode').val('');
					$('#Purchinforec_purchasingorgid').val('');
					$('#purchasingorgcode').val('');
					$('#Purchinforec_deliverytime').val('');
					$('#Purchinforec_purchasinggroupid').val('');
					$('#purchasinggroupcode').val('');
					$('#Purchinforec_underdelvtol').val('');
					$('#Purchinforec_overdelvtol').val('');
					$('#Purchinforec_price').val('');
					$('#Purchinforec_currencyid').val('');
					$('#currencyname').val('');
					$('#Purchinforec_biddate').val('');
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=purchinforec/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);					$('#Purchinforec_purchinforecid').val(data.purchinforecid);
					$('#Purchinforec_addressbookid').val(data.addressbookid);
					$('#addressbook_name').val(data.suppliername);
					$('#Purchinforec_productid').val(data.productid);
					$('#productname').val(data.productname);
					$('#Purchinforec_materialgroupid').val(data.materialgroupid);
					$('#materialgroupcode').val(data.materialgroupcode);
					$('#Purchinforec_purchasingorgid').val(data.purchasingorgid);
					$('#purchasingorgcode').val(data.purchasingorgcode);
					$('#Purchinforec_deliverytime').val(data.deliverytime);
					$('#Purchinforec_purchasinggroupid').val(data.purchasinggroupid);
					$('#purchasinggroupcode').val(data.purchasinggroupcode);
					$('#Purchinforec_underdelvtol').val(data.underdelvtol);
					$('#Purchinforec_overdelvtol').val(data.overdelvtol);
					$('#Purchinforec_price').val(data.price);
					$('#Purchinforec_currencyid').val(data.currencyid);
					$('#currencyname').val(data.currencyname);
					$('#Purchinforec_biddate').val(data.biddate);
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=purchinforec/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{
    $.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=purchinforec/help',
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
function downloaddata() {
	window.open('/index.php?r=purchinforec/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
				  'supplier'=>$supplier,
				  'product'=>$product,
				  'purchasinggroup'=>$purchasinggroup,
    'currency'=>$currency)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('purchinforec') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
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
      'id'=>'ids',
    ),
	array('name'=>'purchinforecid', 'visible'=>false,'value'=>'$data->purchinforecid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid', 'value'=>'($data->addressbook!==null)?$data->addressbook->fullname:""'),
	array('name'=>'productid', 'value'=>'($data->product!==null)?$data->product->productname:""'),
	array('name'=>'purchasinggroupid', 'value'=>'($data->purchasinggroup!==null)?$data->purchasinggroup->purchasinggroupcode:""'),
array(
      'name'=>'price',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->price)',
     ),	
    array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
        'deliverytime',
	'underdelvtol',
	'overdelvtol',
                array(
      'name'=>'biddate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->biddate))'
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
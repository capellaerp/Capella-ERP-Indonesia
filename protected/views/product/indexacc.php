<?php
$this->breadcrumbs=array(
	'Product',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata4()
{jQuery.ajax({'url':'/index.php?r=product/createacc','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog4 div.divcreate').html(data.div);$('#Productacc_productaccid').val('');
$('#Productacc_inventoryaccid').val('');$('#inventoryacccode').val('');
$('#Productacc_salesaccid').val('');$('#salesacccode').val('');
$('#Productacc_salesretaccid').val('');$('#salesretacccode').val('');
$('#Productacc_itemdiscaccid').val('');$('#itemdiscacccode').val('');
$('#Productacc_cogsaccid').val('');$('#cogsacccode').val('');
$('#Productacc_purchaseretaccid').val('');$('#purchaseretacccode').val('');
$('#Productacc_expenseaccid').val('');$('#expenseacccode').val('');
$('#Productacc_unbilledgoodsaccid').val('');$('#unbilledgoodsacccode').val('');
$('#createdialog4').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata4()
{jQuery.ajax({'url':'/index.php?r=product/updateacc','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Productacc_productaccid').val(data.productaccid);
$('#Productacc_inventoryaccid').val(data.inventoryaccid);$('#inventoryacccode').val(data.inventoryacccode);
$('#Productacc_salesaccid').val(data.salesaccid);$('#salesacccode').val(data.salesacccode);
$('#Productacc_salesretaccid').val(data.salesretaccid);$('#salesretacccode').val(data.salesretacccode);
$('#Productacc_itemdiscaccid').val(data.itemdiscaccid);$('#itemdiscacccode').val(data.itemdiscacccode);
$('#Productacc_cogsaccid').val(data.cogsaccid);$('#cogsacccode').val(data.cogsacccode);
$('#Productacc_purchaseretaccid').val(data.purchaseretaccid);$('#purchaseretacccode').val(data.purchaseretacccode);
$('#Productacc_expenseaccid').val(data.expenseaccid);$('#expenseacccode').val(data.expenseacccode);
$('#Productacc_unbilledgoodsaccid').val(data.unbilledgoodsaccid);$('#unbilledgoodsacccode').val(data.unbilledgoodsacccode);
$('#createdialog4').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata4()
{jQuery.ajax({'url':'/index.php?r=product/deleteacc','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata4()
{$.fn.yiiGridView.update('detailaccdatagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog4',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formacc', array('model'=>$productacc)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata4()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata4()',
	'UrlDownload'=>'downloaddata4()',
	'isEdit'=>true,'UrlEdit'=>'editdata4()',
	'isDelete'=>true,'UrlDelete'=>'deletedata4()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detailaccdatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detailaccdatagrid',
	'dataProvider'=>$productacc->search(),
	'filter'=>$productacc,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productaccid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productaccid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'inventoryaccid', 'value'=>'($data->inventoryacc!==null)?$data->inventoryacc->accountcode:""'),
	array('name'=>'salesaccid', 'value'=>'($data->salesacc!==null)?$data->salesacc->accountcode:""'),
	array('name'=>'salesretaccid', 'value'=>'($data->salesretacc!==null)?$data->salesretacc->accountcode:""'),
	array('name'=>'itemdiscaccid', 'value'=>'($data->itemdiscacc!==null)?$data->itemdiscacc->accountcode:""'),
	array('name'=>'cogsaccid', 'value'=>'($data->cogsacc!==null)?$data->cogsacc->accountcode:""'),
	array('name'=>'purchaseretaccid', 'value'=>'($data->purchaseretacc!==null)?$data->purchaseretacc->accountcode:""'),
	array('name'=>'expenseaccid', 'value'=>'($data->expenseacc!==null)?$data->expenseacc->accountcode:""'),
	array('name'=>'unbilledgoodsaccid', 'value'=>'($data->unbilledgoodsacc!==null)?$data->unbilledgoodsacc->accountcode:""'),
	),
)); 
?>
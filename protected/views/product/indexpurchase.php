<?php
$this->breadcrumbs=array(
	'Product',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata3()
{jQuery.ajax({'url':'/index.php?r=product/createpurchase','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog3 div.divcreate').html(data.div);
$('#Productpurchase_productpurchaseid').val('');$('#Productpurchase_plantid').val('');
$('#plantcode').val('');$('#Productpurchase_orderunit').val('');
$('#Productpurchase_purchasinggroupid').val('');$('#purchasinggroupcode').val('');
$('#Productpurchase_validfrom').val('');$('#Productpurchase_validto').val('');$('#orderunitcode').val('');
$('#createdialog3').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata3()
{jQuery.ajax({'url':'/index.php?r=product/updatepurchase','data':{'id':$.fn.yiiGridView.getSelection("detailpurchasedatagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog3 div.divcreate').html(data.div);$('#Productpurchase_productpurchaseid').val(data.productpurchaseid);
$('#Productpurchase_plantid').val(data.plantid);
$('#plantcode').val(data.plantcode);$('#Productpurchase_orderunit').val(data.orderunit);$('#orderunitcode').val(data.uomcode);
$('#Productpurchase_purchasinggroupid').val(data.purchasinggroupid);$('#purchasinggroupcode').val(data.purchasinggroupcode);
$('#Productpurchase_validfrom').val(data.validfrom);$('#Productpurchase_validto').val(data.validto);
if(data.isautoPO=='1')
{document.forms[4].elements[13].checked=true;}
else
{document.forms[4].elements[13].checked=false;}
$('#createdialog3').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata3()
{jQuery.ajax({'url':'/index.php?r=productpurchase/delete','data':{'id':$.fn.yiiGridView.getSelection("detailpurchasedatagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata3()
{$.fn.yiiGridView.update('detailpurchasedatagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog3',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formpurchase', array('model'=>$productpurchase)); ?>
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
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata3()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata3()',
	'UrlDownload'=>'downloaddata3()',
	'isEdit'=>true,'UrlEdit'=>'editdata3()',
	'isDelete'=>true,'UrlDelete'=>'deletedata3()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detailpurchasedatagrid',{data:{pageSize: $(this).val() }})"));
?><?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detailpurchasedatagrid',
	'dataProvider'=>$productpurchase->search(),
	'filter'=>$productpurchase,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productpurchaseid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productpurchaseid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'plantid', 'value'=>'($data->plant!==null)?$data->plant->plantcode:""'),
		array('name'=>'orderunit', 'value'=>'($data->orderunit0!==null)?$data->orderunit0->uomcode:""'),
		array('name'=>'purchasinggroupid', 'value'=>'($data->purchasinggroup!==null)?$data->purchasinggroup->purchasinggroupcode:""'),
	array(
      'name'=>'validfrom',
      'type'=>'raw',
         'value'=>'($data->validfrom!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->validfrom)):""'
     ),
	array(
      'name'=>'validto',
      'type'=>'raw',
         'value'=>'($data->validto!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->validto)):""'
     ),
		array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isautoPO',
      'selectableRows'=>'0',
      'header'=>'Auto PR',
      'checked'=>'$data->isautoPO',
    ),
	),
)); 
?>
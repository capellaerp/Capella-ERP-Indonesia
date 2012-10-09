<?php
$this->breadcrumbs=array(
	'Product',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata6()
{jQuery.ajax({'url':'/index.php?r=product/createconversion','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog6 div.divcreate').html(data.div);$('#Productconversion_productconversionid').val('');
$('#Productconversion_fromuom').val('');$('#fromuomcode').val('');
$('#Productconversion_touom').val('');$('#touomcode').val('');
$('#createdialog6').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata6()
{jQuery.ajax({'url':'/index.php?r=product/updateconversion','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Productconversion_productconversionid').val(data.productconversionid);
$('#Productconversion_fromuom').val(data.fromuom);$('#fromuomcode').val(data.fromuomcode);
$('#Productconversion_touom').val(data.touom);$('#touomcode').val(data.touomcode);
$('#createdialog6').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata6()
{jQuery.ajax({'url':'/index.php?r=product/deleteconversion','data':{'id':$.fn.yiiGridView.getSelection("detailconversiondatagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('detailconversiondatagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata6()
{$.fn.yiiGridView.update('detailconversiondatagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog6',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formconversion', array('model'=>$productconversion)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata6()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata6()',
	'UrlDownload'=>'downloaddata6()',
	'isEdit'=>true,'UrlEdit'=>'editdata6()',
	'isDelete'=>true,'UrlDelete'=>'deletedata6()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detailconversiondatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detailconversiondatagrid',
	'dataProvider'=>$productconversion->search(),
	'filter'=>$productconversion,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productconversionid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productconversionid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'fromuom', 'value'=>'($data->fromuom0!==null)?$data->fromuom0->uomcode:""'),
	'fromvalue',
	array('name'=>'touom', 'value'=>'($data->touom0!==null)?$data->touom0->uomcode:""'),
	'tovalue'
	),
)); 
?>
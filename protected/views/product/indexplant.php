<?php
$this->breadcrumbs=array(
	'Product',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata2()
{jQuery.ajax({'url':'/index.php?r=product/createplant','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog2 div.divcreate').html(data.div);$('#Productplant_productplantid').val('');
$('#Productplant_slocid').val('');$('#sloccode').val('');$('#Productplant_unitofissue').val('');
$('#unitofissuecode').val('');$('#Productplant_storagebin').val('');
$('#Productplant_pickingarea').val('');$('#Productplant_sled').val('');$('#Productplant_snroid').val('');
$('#description').val('');
$('#createdialog2').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata2()
{jQuery.ajax({'url':'/index.php?r=product/updateplant','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog2 div.divcreate').html(data.div);$('#Productplant_productplantid').val(data.productplantid);
$('#Productplant_slocid').val(data.slocid);$('#sloccode').val(data.sloccode);$('#Productplant_unitofissue').val(data.unitofissue);
$('#unitofissuecode').val(data.unitofissuecode);
if (data.isautolot == '1')
				{
                 document.forms[3].elements[6].checked = true;
				} else
				{
                 document.forms[3].elements[6].checked = false;
				}
$('#Productplant_storagebin').val(data.storagebin);$('#Productplant_pickingarea').val(data.pickingarea);
$('#Productplant_sled').val(data.sled);$('#Productplant_snroid').val(data.snroid);
$('#description').val(data.description);
$('#createdialog2').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata2()
{jQuery.ajax({'url':'/index.php?r=product/deleteplant','data':{'id':$.fn.yiiGridView.getSelection("detailplantdatagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('detailplantdatagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata2()
{$.fn.yiiGridView.update('detailplantdatagrid');return false;}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog2',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_formplant', array('model'=>$productplant)); ?>
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
	array('isCreate'=>true,'UrlCreate'=>'adddata2()','isRefresh'=>true,
	'isEdit'=>true,'UrlEdit'=>'editdata2()',
	'UrlRefresh'=>'refreshdata2()',
	'UrlDownload'=>'downloaddata2()',
	'isDelete'=>true,'UrlDelete'=>'deletedata2()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail2datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detailplantdatagrid',
	'dataProvider'=>$productplant->search(),
	'filter'=>$productplant,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productplantid','visible'=>false, 'header'=>'ID','value'=>'$data->productplantid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'slocid', 'value'=>'($data->sloc!==null)?$data->sloc->sloccode:""'),
array('name'=>'unitofissue', 'value'=>'($data->unitofissue0!==null)?$data->unitofissue0->uomcode:""'),
	array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isautolot',
      'selectableRows'=>'0',
      'header'=>'Auto LOT',
      'checked'=>'$data->isautolot',
    ),
	'storagebin',
	'pickingarea',
	'sled',
array('name'=>'snroid', 'value'=>'($data->snro!==null)?$data->snro->description:""'),
	),
)); 
?>


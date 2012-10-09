<?php
$this->breadcrumbs=array(
	'Product',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$headerid=Yii::app()->user->getState('headerid',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata1()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('product/createbasic'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Productbasic_productbasicid').val('');
					$('#Productbasic_baseuom').val('');
					$('#baseuomcode').val('');
					$('#Productbasic_materialgroupid').val('');
					$('#materialgroupcode').val('');
					$('#Productbasic_oldmatno').val('');
					$('#Productbasic_grossweight').val('0');
					$('#Productbasic_weightunit').val('');
					$('#weightunitcode').val('');
					$('#Productbasic_netweight').val('');
					$('#Productbasic_volume').val('');
					$('#Productbasic_volumeunit').val('');
					$('#volumeunitcode').val('');
					$('#Productbasic_sizedimension').val('');
					$('#Productbasic_materialpackage').val('');
					$('#materialpackagename').val('');
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog1').dialog('open');
                }
            else {
                document.getElementById('messages').innerHTML = data.div;
            }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function editdata1()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('product/updatebasic'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detailbasicdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Productbasic_productbasicid').val(data.productbasicid);
					$('#Productbasic_baseuom').val(data.baseuom);
					$('#baseuomcode').val(data.baseuomcode);
					$('#Productbasic_materialgroupid').val(data.materialgroupid);
					$('#materialgroupcode').val(data.materialgroupcode);
					$('#Productbasic_oldmatno').val(data.oldmatno);
					$('#Productbasic_grossweight').val(data.grossweight);
					$('#Productbasic_weightunit').val(data.weightunit);
					$('#weightunitcode').val(data.weightunitcode);
					$('#Productbasic_netweight').val(data.netweight);
					$('#Productbasic_volume').val(data.volume);
					$('#Productbasic_volumeunit').val(data.volumeunit);
					$('#volumeunitcode').val(data.volumeunitcode);
					$('#Productbasic_sizedimension').val(data.sizedimension);
					$('#Productbasic_materialpackage').val(data.materialpackage);
					$('#materialpackagename').val(data.materialpackagename);
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog1').dialog('open');
                }
            else {
                document.getElementById('messages').innerHTML = data.div;
            }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function deletedata1()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('product/deletebasic'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detailbasicdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('detail1datagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata1()
{
    $.fn.yiiGridView.update('detailbasicdatagrid');
    return false;
}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog1',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate1"></div>
<?php echo $this->renderPartial('_formbasic', array('model'=>$productbasic)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata1()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata1()',
	'UrlDownload'=>'downloaddata1()',
	'isEdit'=>true,'UrlEdit'=>'editdata1()',
	'isDelete'=>true,'UrlDelete'=>'deletedata1()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detailbasicdatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detailbasicdatagrid',
	'dataProvider'=>$productbasic->search(),
  'selectableRows'=>1,
  'filter'=>$productbasic,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productbasicid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productbasicid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'baseuom', 'value'=>'($data->baseuom0!==null)?$data->baseuom0->uomcode:""'),
array('name'=>'materialgroupid', 'value'=>'($data->materialgroup!==null)?$data->materialgroup->description:""'),
'oldmatno',
'grossweight',
array('name'=>'weightunit', 'value'=>'($data->baseuom1!==null)?$data->baseuom1->uomcode:""'),
'netweight',
'volume',
array('name'=>'volumeunit', 'value'=>'($data->baseuom2!==null)?$data->baseuom2->uomcode:""'),
'sizedimension',
array('name'=>'materialpackage', 'value'=>'($data->materialpackage0!==null)?$data->materialpackage0->productname:""'),
  ),
));
?>

<?php
$this->breadcrumbs=array(
	'Supplieraddresss',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata1()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('supplier/createaddress'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Supplieraddress_addressid').val('');$('#addressbook_name').val('');$('#Supplieraddress_addresstypeid').val('');$('#addresstype_name').val('');$('#Supplieraddress_addressname').val('');$('#Supplieraddress_rt').val('');$('#Supplieraddress_rw').val('');$('#Supplieraddress_cityid').val('');$('#city_name').val('');$('#Supplieraddress_kelurahanid').val('');$('#kelurahan_name').val('');$('#Supplieraddress_subdistrictid').val('');$('#subdistrict_name').val('');
                    $('#Supplieraddress_phoneno').val('');
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog1').dialog('open');
                }
                else
                {
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
			'url'=>array('supplier/updateaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("addressdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Supplieraddress_addressid').val(data.addressid);
                    $('#addressbook_name').val(data.fullname);
                    $('#Supplieraddress_addresstypeid').val(data.addresstypeid);
                    $('#addresstype_name').val(data.addresstypename);
                    $('#Supplieraddress_addressname').val(data.addressname);
                    $('#Supplieraddress_rt').val(data.rt);
                    $('#Supplieraddress_rw').val(data.rw);
                    $('#Supplieraddress_cityid').val(data.cityid);
                    $('#city_name').val(data.cityname);
                    $('#Supplieraddress_kelurahanid').val(data.kelurahanid);
                    $('#kelurahan_name').val(data.kelurahanname);
                    $('#Supplieraddress_subdistrictid').val(data.subdistrictid);
                    $('#subdistrict_name').val(data.subdistrictname);
                    $('#Supplieraddress_phoneno').val(data.phoneno);
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog1').dialog('open');
                }
                else
                {
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
			'url'=>array('supplier/deleteaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("addressdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('addressdatagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata1()
{
    $.fn.yiiGridView.update('addressdatagrid');
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
<?php echo $this->renderPartial('_formaddress', array('model'=>$supplieraddress)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata1()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata1()',
	'isEdit'=>true,'UrlEdit'=>'editdata1()',
	'isDelete'=>true,'UrlDelete'=>'deletedata1()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('addressdatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'addressdatagrid',
	'dataProvider'=>$supplieraddress->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'addressid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid', 'visible'=>false,'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'addresstypeid', 'header'=>'Address Type Name','value'=>'$data->addresstype->addresstypename'),
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
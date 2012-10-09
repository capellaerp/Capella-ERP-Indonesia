<?php
$this->breadcrumbs=array(
	'Products',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=productdetail/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
				$('#Productdetail_productid').val('');
				$('#productname').val('');
				$('#Productdetail_slocid').val('');
				$('#slocdesc').val('');
				$('#Productdetail_qty').val('');
				$('#Productdetail_unitofmeasureid').val('');
				$('#uomcode').val('');
				$('#Productdetail_buyprice').val('');
				$('#Productdetail_buydate').val('');
				$('#Productdetail_currencyid').val('');
				$('#currencyname').val('');
				$('#Productdetail_materialstatusid').val('');
				$('#materialstatusname').val('');
				$('#Productdetail_ownershipid').val('');
				$('#ownershipname').val('');
                $('#createdialog').dialog('open');
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
function editdata() {
    jQuery.ajax({
        'url': '/index.php?r=productdetail/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Productdetail_productdetailid').val(data.productdetailid);
				$('#Productdetail_productid').val(data.productid);
				$('#productname').val(data.productname);
				$('#Productdetail_slocid').val(data.slocid);
				$('#slocdesc').val(data.slocdesc);
				$('#Productdetail_qty').val(data.qty);
				$('#Productdetail_unitofmeasureid').val(data.unitofmeasureid);
				$('#uomcode').val(data.uomcode);
				$('#Productdetail_buyprice').val(data.buyprice);
				$('#Productdetail_buydate').val(data.buydate);
				$('#Productdetail_currencyid').val(data.currencyid);
				$('#currencyname').val(data.currencyname);
				$('#Productdetail_materialstatusid').val(data.materialstatusid);
				$('#materialstatusname').val(data.materialstatusname);
				$('#Productdetail_ownershipid').val(data.ownershipid);
				$('#ownershipname').val(data.ownershipname);
                if (data.recordstatus == '1') {
                    document.forms[1].elements[6].checked = true;
                } else {
                    document.forms[1].elements[6].checked = false;
                }
                $('#createdialog').dialog('open');
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
function deletedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('productdetail/delete'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML=data.div;
            } ",
            ))?>;
	$.fn.yiiGridView.update('datagrid');
    return false;
}
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
        'url': '/index.php?r=productdetail/help',
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
function generatedata() {
	jQuery.ajax({
        'url': '/index.php?r=productdetail/generatedata',
        'data': {
            'id': $('#Productdetail_grdetailid').val()
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if (data.status == 'success') {
				$('#grno').val(data.grno);
				$('#Productdetail_productid').val(data.productid);
				$('#productname').val(data.productname);
				$('#Productdetail_slocid').val(data.slocid);
				$('#slocdesc').val(data.slocdesc);
				$('#Productdetail_qty').val(data.qty);
				$('#Productdetail_unitofmeasureid').val(data.unitofmeasureid);
				$('#uomcode').val(data.uomcode);
				$('#Productdetail_buyprice').val(data.buyprice);
				$('#Productdetail_buydate').val(data.buydate);
				$('#Productdetail_currencyid').val(data.currencyid);
				$('#currencyname').val(data.currencyname);
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
	window.open('/index.php?r=productdetail/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function approvedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('productdetail/approve'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				if (data.status == 'failure')
                {
					document.getElementById('messages').innerHTML = data.div;
				}
				else
				{
					refreshdata();
				}
            } ",
            ))?>;
	$.fn.yiiGridView.update('datagrid');
    return false;
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
                    'product'=>$this->product,
                    'currency'=>$this->currency,
                    'unitofmeasure'=>$this->unitofmeasure,
                    'ownership'=>$this->ownership,
    'sloc'=>$this->sloc,
	'materialstatus'=>$this->materialstatus)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('productdetail') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isApprove'=>true,
	'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>2,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productdetailid','visible'=>false, 'header'=>'ID','value'=>'$data->productdetailid','htmlOptions'=>array('width'=>'1%')),
	 'materialcode',
	array('name'=>'productid','value'=>'($data->product!==null)?$data->product->productname:""'),
	array('name'=>'slocid','value'=>'($data->sloc!==null)?$data->sloc->description:""'),
    'serialno',
        array(
      'name'=>'expiredate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->expiredate))'
     ),
   array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty)',
     ),
	array('name'=>'unitofmeasureid','value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
        array(
      'name'=>'buydate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->buydate))'
     ),array(
      'name'=>'buyprice',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->buyprice)',
     ),
	array('name'=>'currencyid','value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
        'location',
        array(
      'name'=>'locationdate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->locationdate))'
     ),
	 array('name'=>'materialstatusid','value'=>'($data->materialstatus!==null)?$data->materialstatus->materialstatusname:""'),
	 array('name'=>'ownershipid','value'=>'($data->ownership!==null)?$data->ownership->ownershipname:""'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus',
    ),
  ),
));?>


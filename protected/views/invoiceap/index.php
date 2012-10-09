<?php
$this->breadcrumbs=array(
	'Invoiceaps',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
var inputConfig = {aSep:',', aNeg:'-', mDec:2, mRound:'S', mNum:30};
$(function() {
            $('#Invoice_amount').autoNumeric(inputConfig);
            $('#Invoice_rate').autoNumeric(inputConfig);
            $('#Invoicedetail_price').autoNumeric(inputConfig);
            $('#Invoicedetail_qty').autoNumeric(inputConfig);
            $('#Invoicedetail_rate').autoNumeric(inputConfig);
            $('#Invoiceacc_debit').autoNumeric(inputConfig);
            $('#Invoiceacc_credit').autoNumeric(inputConfig);
            $('#Invoiceacc_currencyrate').autoNumeric(inputConfig);
        });	
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=invoiceap/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Invoice_invoiceid').val(data.invoiceid);
                $('#Invoice_invoicedate').val('');
                $('#Invoice_addressbookid').val('');
                $('#customername').val('');
                $('#Invoice_invoiceno').val('');
                $('#Invoice_pono').val('');
                $('#Invoice_amount').val('');
                $('#Invoice_currencyid').val('');
                $('#currencyname').val('');
                $('#Invoice_rate').val('');
                $('#Invoice_taxid').val('');
                $('#taxcode').val('');
                $('#Invoice_paymentmethodid').val('');
                $('#paycode').val('');
                $('#Invoice_headernote').val('');
                document.forms[2].elements[3].value = data.invoiceid;
                document.forms[3].elements[3].value = data.invoiceid;
                $.fn.yiiGridView.update('detail1datagrid', {
                    data: {
                        'Invoicedet[invoiceid]': data.invoiceid
                    }
                });
                $.fn.yiiGridView.update('detail2datagrid', {
                    data: {
                        'Invoiceacc[invoiceid]': data.invoiceid
                    }
                });
                $('#createdialog').dialog('open');
            }
            else {
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
        'url': '/index.php?r=invoiceap/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Invoice_invoiceid').val(data.invoiceid);
                $('#Invoice_invoicedate').val(data.invoicedate);
                $('#Invoice_addressbookid').val(data.addressbookid);
                $('#customername').val(data.fullname);
                $('#Invoice_invoiceno').val(data.invoiceno);
                $('#Invoice_pono').val(data.pono);
                $('#Invoice_amount').val($.fn.autoNumeric.Format(data.amount,inputConfig));
                $('#Invoice_currencyid').val(data.currencyid);
                $('#currencyname').val(data.currencyname);
                $('#Invoice_rate').val(data.rate);
                $('#Invoice_taxid').val(data.taxid);
                $('#taxcode').val(data.taxcode);
                $('#Invoice_paymentmethodid').val(data.paymentmethodid);
                $('#paycode').val(data.paycode);
                $('#Invoice_headernote').val(data.headernote);
                 document.forms[2].elements[3].value = data.invoiceid;
                 document.forms[3].elements[3].value = data.invoiceid;
               $.fn.yiiGridView.update('detail1datagrid', {
                    data: {
                        'Invoicedet[invoiceid]': data.invoiceid
                    }
                });
               $.fn.yiiGridView.update('detail2datagrid', {
                    data: {
                        'Invoiceacc[invoiceid]': data.invoiceid
                    }
                });
                $('#createdialog').dialog('open');
            }
            else {
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
{jQuery.ajax({'url':'/index.php?r=invoiceap/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function approvedata()
{jQuery.ajax({'url':'/index.php?r=invoiceap/approve','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json',
'success':function(data)
{
if (data.status == 'failure')
                {
                document.getElementById('messages').innerHTML = data.div;
            }},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=invoiceap/help',
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
	window.open('/index.php?r=invoiceap/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('indetaildatagrid', {
                    data: {
                        'Invoicedet[invoiceid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    $.fn.yiiGridView.update('indetailaccdatagrid', {
                    data: {
                        'Invoiceacc[invoiceid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
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
'invoiceacc'=>$invoiceacc,
'invoicedet'=>$invoicedet
)); ?>
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
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
 
  ),  
));
?>
<h1><?php echo Catalogsys::model()->GetCatalog('invoiceap') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
'isApprove'=>true,
	'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->Searchwfapstatus(),
	'filter'=>$model,
    'selectableRows'=>1,
	'selectionChanged'=>'showdetail',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'invoicearid', 'visible'=>false,'header'=>'ID','value'=>'$data->invoicearid','htmlOptions'=>array('width'=>'1%')),
	array(
      'name'=>'invoicedate',
      'type'=>'raw',
         'value'=>'($data->invoicedate!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->invoicedate)):""'
     ),
	array('name'=>'addressbookid', 'header'=>'Supplier','value'=>'($data->customer!==null)?$data->customer->fullname:""'),
	'pono',
        array(
      'name'=>'amount',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->amount)',
     ),
	array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
        array(
      'name'=>'rate',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->rate)',
     ),
	 array(
      'class'=>'ext.TotalColumn',
      'name'=>'amount',
	  'header'=>'Total',
      'value'=>'$data->amount*$data->rate',
      'output'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$value)',
      'type'=>'raw',
     ),
	array('name'=>'taxid', 'value'=>'($data->tax!==null)?$data->tax->taxcode:""'),
	'headernote',
		array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("appinvap",$data->recordstatus)')
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetaildatagrid',
	'dataProvider'=>$invoicedet->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'invoicedetid', 'visible'=>false, 'header'=>'ID','value'=>'$data->invoicedetid','htmlOptions'=>array('width'=>'1%')),
	'itemname',
        array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty)',
     ),
array('name'=>'unitofmeasureid', 'value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
        array(
      'name'=>'price',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->price)',
     ),
array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
        array(
      'name'=>'rate',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->rate)',
     ),
		 array(
      'class'=>'ext.TotalColumn',
      'name'=>'price',
	  'header'=>'Total',
      'value'=>'$data->qty*$data->rate*$data->price',
      'output'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$value)',
      'type'=>'raw',
      'footer'=>true,
     ),
    'description',
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailaccdatagrid',
	'dataProvider'=>$invoiceacc->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'invoiceaccid', 'visible'=>false, 'header'=>'ID','value'=>'$data->invoiceaccid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'accountid', 'value'=>'($data->account!==null)?$data->account->accountname:""'),
array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
         array(
      'class'=>'ext.TotalColumn',
      'name'=>'debit',
	  'header'=>'Debit',
      'value'=>'$data->debit*$data->currencyrate',
      'output'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$value)',
      'type'=>'raw',
      'footer'=>true,
     ),
	  array(
      'class'=>'ext.TotalColumn',
      'name'=>'credit',
	  'header'=>'Credit',
      'value'=>'$data->credit*$data->currencyrate',
      'output'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$value)',
      'type'=>'raw',
      'footer'=>true,
     ),
        array(
      'name'=>'currencyrate',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->currencyrate)',
     ),
	 'description'
  ),
));
?>
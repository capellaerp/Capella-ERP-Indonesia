<?php
$this->breadcrumbs=array(
	'Invoicears',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
$(function() {
            var inputConfig = {aSep:',', aNeg:'-', mDec:2, mRound:'S', mNum:30};
            $('#Invoice_amount').autoNumeric(inputConfig);
            $('#Invoice_rate').autoNumeric(inputConfig);
            $('#Invoicedet_price').autoNumeric(inputConfig);
            $('#Invoicedet_qty').autoNumeric(inputConfig);
            $('#Invoicedet_rate').autoNumeric(inputConfig);
            $('#Invoiceacc_debit').autoNumeric(inputConfig);
            $('#Invoiceacc_credit').autoNumeric(inputConfig);
            $('#Invoiceacc_currencyrate').autoNumeric(inputConfig);
        });	
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=invoicear/create',
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
                $('#Invoice_sono').val('');
                $('#Invoice_amount').val('');
                $('#Invoice_currencyid').val('');
                $('#currencyname').val('');
                $('#Invoice_rate').val('');
                $('#Invoice_headernote').val('');
                $('#Invoice_taxid').val('');
                $('#taxcode').val('');
                $('#Invoice_paymentmethodid').val('');
                $('#paycode').val('');
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
        'url': '/index.php?r=invoicear/update',
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
                $('#Invoice_sono').val(data.sono);
                $('#Invoice_amount').val(data.amount);
                $('#Invoice_currencyid').val(data.currencyid);
                $('#currencyname').val(data.currencyname);
                $('#Invoice_rate').val(data.rate);
                $('#Invoice_headernote').val(data.headernote);
                $('#Invoice_taxid').val(data.taxid);
                $('#taxcode').val(data.taxcode);
                $('#Invoice_paymentmethodid').val(data.paymentmethodid);
                $('#paycode').val(data.paycode);
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
{jQuery.ajax({'url':'/index.php?r=invoicear/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function approvedata()
{jQuery.ajax({'url':'/index.php?r=invoicear/approve','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json',
'success':function(data) {
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
        'url': '/index.php?r=invoicear/help',
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
	window.open('/index.php?r=invoicear/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
<h1><?php echo Catalogsys::model()->GetCatalog('invoicear') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
'isApprove'=>true,
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->Searchwfarstatus(),
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
	'invoiceno',
	array(
      'name'=>'invoicedate',
      'type'=>'raw',
         'value'=>'($data->invoicedate!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->invoicedate)):""'
     ),
	array('name'=>'addressbookid', 'header'=>'Customer','value'=>'($data->customer!==null)?$data->customer->fullname:""'),
	'sono',
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
	'headernote',
		array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("appinvar",$data->recordstatus)')
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
	  'header'=>'Total',
      'value'=>'$data->debit*$data->currencyrate',
      'output'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$value)',
      'type'=>'raw',
      'footer'=>true,
     ),
        array(
      'class'=>'ext.TotalColumn',
      'name'=>'debit',
	  'header'=>'Total',
      'value'=>'$data->debit*$data->currencyrate',
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
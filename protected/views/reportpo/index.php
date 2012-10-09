<?php
$this->breadcrumbs=array(
	'Reportpos',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=reportpo/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');$.fn.yiiGridView.update('indatagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=reportpo/help',
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
	window.open('/index.php?r=reportpo/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        'Podetail[poheaderid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
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
<h1><?php echo Catalogsys::model()->GetCatalog('reportpo') ?></h1>
<?php
$this->widget('ToolbarButton',array(
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectionChanged'=>'showdetail',
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'poheaderid', 'visible'=>false,'header'=>'ID','value'=>'$data->poheaderid','htmlOptions'=>array('width'=>'1%')),
		'pono',
	array('name'=>'addressbookid', 'value'=>'($data->supplier!==null)?$data->supplier->fullname:""'),
		'headernote',
		'docdate',
		'postdate',
	array('name'=>'paymentmethodid', 'value'=>'($data->paymentmethod!==null)?$data->paymentmethod->paycode:""'),
	array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("apppo",$data->recordstatus)')
  ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>$podetail->search(),
	'columns'=>array(
	array('name'=>'podetailid','visible'=>false, 'header'=>'ID','value'=>'$data->podetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'prdetailid', 'value'=>'($data->prdetail!==null)?(($data->prdetail->prheader!==null)?$data->prdetail->prheader->prno:""):""'),
	array('name'=>'productid', 'value'=>'($data->product!==null)?$data->product->productname:""'),
        array(
      'name'=>'poqty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->poqty)',
     ),
	array('name'=>'unitofmeasureid', 'value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
        array(
      'name'=>'netprice',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->netprice)',
     ),
	array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
	array('name'=>'slocid', 'value'=>'($data->sloc!==null)?$data->sloc->sloccode:""'),
	array('name'=>'taxid', 'value'=>'($data->tax!==null)?$data->tax->taxcode:""'),
            'underdelvtol',
            'overdelvtol',
       array(
      'name'=>'qtyres',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qtyres)',
     ),
	array('name'=>'prdetailid', 'header'=>'Req By', 'value'=>'($data->prdetail!==null)?(($data->prdetail->requestedby!==null)?$data->prdetail->requestedby->description:""):""'),
  ),
));
?>

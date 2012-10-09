<?php
$this->breadcrumbs=array(
	'Poheaders',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$headerid=Yii::app()->user->getState('headerid',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata1()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('poheader/createdetail'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Podetail_podetailid').val('');
					$('#Podetail_productid').val('');
					$('#productname').val('');
					$('#Podetail_poqty').val('1');
					$('#Podetail_unitofmeasureid').val('');
					$('#uomcode').val('');
					$('#Podetail_netprice').val('0');
					$('#Podetail_currencyid').val(data.currencyid);
					$('#Podetail_ratevalue').val('1');
					$('#currencyname').val(data.currencyname);
					$('#Podetail_slocid').val('');
					$('#sloccode').val('');
					$('#Podetail_taxid').val('');
					$('#taxcode').val('');
					$('#Podetail_delvdate').val($('#Poheader_docdate').val());
					$('#Podetail_itemtext').val('');
					$('#Podetail_underdelvtol').val('0');
					$('#Podetail_overdelvtol').val('0');
					$('#Podetail_prdetailid').val('');
					$('#prno').val('');
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
			'url'=>array('poheader/updatedetail'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detaildatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Podetail_podetailid').val(data.podetailid);
					$('#Podetail_productid').val(data.productid);
					$('#productname').val(data.productname);
					$('#Podetail_poqty').val(data.poqty);
					$('#Podetail_unitofmeasureid').val(data.unitofmeasureid);
					$('#uomcode').val(data.uomcode);
					$('#Podetail_netprice').val(data.netprice);
					$('#Podetail_currencyid').val(data.currencyid);
					$('#Podetail_ratevalue').val(data.ratevalue);
					$('#currencyname').val(data.currencyname);
					$('#Podetail_slocid').val(data.slocid);
					$('#sloccode').val(data.description);
					$('#Podetail_taxid').val(data.taxid);
					$('#taxcode').val(data.taxcode);
					$('#Podetail_delvdate').val(data.delvdate);
					$('#Podetail_itemtext').val(data.itemtext);
					$('#Podetail_underdelvtol').val(data.underdelvtol);
					$('#Podetail_overdelvtol').val(data.overdelvtol);
					$('#Podetail_prdetailid').val(data.prdetailid);
					$('#prno').val(data.prno);
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
			'url'=>array('poheader/deletedetail'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detaildatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('detaildatagrid');
    return false;
}
</script>
<script type="text/javascript">
function generatedata() {
	jQuery.ajax({
        'url': '/index.php?r=poheader/generatedetail',
        'data': {
            'productid': $('#Podetail_productid').val(),
            'supplierid': $('#Poheader_addressbookid').val(),
            'prmaterialid': $('#Podetail_prdetailid').val()
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if(data.status=='failure') {
            document.getElementById('messages').innerHTML = data.div;
            } else {
                $('#Podetail_productid').val(data.productid);
                $('#productname').val(data.productname);
                $('#Podetail_poqty').val(data.poqty);
                $('#Podetail_unitofmeasureid').val(data.unitofmeasureid);
                $('#uomcode').val(data.uomcode);
                $('#Podetail_slocid').val(data.slocid);
                $('#sloccode').val(data.description);
                $('#Podetail_underdelvtol').val(data.underdelvtol);
                $('#Podetail_overdelvtol').val(data.overdelvtol);
                $('#Podetail_prdetailid').val(data.prdetailid);
                $('#prno').val(data.prno);
                $('#Podetail_itemtext').val(data.itemtext);
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function refreshdata1()
{
    $.fn.yiiGridView.update('detaildatagrid');
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
<?php echo $this->renderPartial('_formdetail', array('model'=>$podetail)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'UrlCreate'=>'adddata1()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata1()',
	'UrlDownload'=>'downloaddata1()',
	'isEdit'=>true,'UrlEdit'=>'editdata1()',
	'isDelete'=>true,'UrlDelete'=>'deletedata1()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detaildatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detaildatagrid',
	'dataProvider'=>$podetail->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'podetailid','visible'=>false, 'header'=>'ID','value'=>'$data->podetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'prdetailid', 'value'=>'($data->prdetail!==null)?(($data->prdetail->prheader!==null)?$data->prdetail->prheader->prno:""):""','htmlOptions'=>array('width'=>'1%')),
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
	array(
      'name'=>'ratevalue',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->ratevalue)',
     ),
	array('name'=>'taxid', 'value'=>'($data->tax!==null)?$data->tax->taxcode:""'),
            'itemtext',
			'underdelvtol',
			'overdelvtol',
			array(
	  'header'=>'Total',
      'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->poqty*$data->ratevalue*$data->netprice)',
      'type'=>'raw',	 'footer'=>Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$podetail->getTotals())     
      ),
  ),
));
?>

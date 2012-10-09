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
			'url'=>array('soheader/createdetail'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Sodetail_sodetailid').val('');
					$('#Sodetail_productid').val('');
					$('#productname').val('');
					$('#Sodetail_qty').val('1');
					$('#Sodetail_unitofmeasureid').val('');
					$('#uomcode').val('');
					$('#Sodetail_price').val('0');
					$('#Sodetail_currencyid').val(data.currencyid);
					$('#currencyname').val(data.currencyname);
					$('#Sodetail_slocid').val('');
					$('#sloccode').val('');
					$('#Sodetail_taxid').val('');
					$('#taxcode').val('');
					$('#Sodetail_currencyrate').val('1');
					$('#Sodetail_itemnote').val('');
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
			'url'=>array('soheader/updatedetail'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detaildatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Sodetail_sodetailid').val(data.sodetailid);
					$('#Sodetail_productid').val(data.productid);
					$('#productname').val(data.productname);
					$('#Sodetail_qty').val(data.qty);
					$('#Sodetail_unitofmeasureid').val(data.unitofmeasureid);
					$('#uomcode').val(data.uomcode);
					$('#Sodetail_price').val(data.price);
					$('#Sodetail_currencyid').val(data.currencyid);
					$('#currencyname').val(data.currencyname);
					$('#Sodetail_slocid').val(data.slocid);
					$('#sloccode').val(data.description);
					$('#Sodetail_taxid').val(data.taxid);
					$('#taxcode').val(data.taxcode);
					$('#Sodetail_currencyrate').val(data.currencyrate);
					$('#Sodetail_itemnote').val(data.itemnote);
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
			'url'=>array('soheader/deletedetail'),
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
        'url': '/index.php?r=soheader/generatedetail',
        'data': {
            'productid': $('#Sodetail_productid').val(),
            'supplierid': $('#Poheader_addressbookid').val(),
            'prmaterialid': $('#Sodetail_prdetailid').val()
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if(data.status=='failure') {
            document.getElementById('messages').innerHTML = data.div;
            } else {
                $('#Sodetail_productid').val(data.productid);
                $('#productname').val(data.productname);
                $('#Sodetail_qty').val(data.qty);
                $('#Sodetail_unitofmeasureid').val(data.unitofmeasureid);
                $('#uomcode').val(data.uomcode);
                $('#Sodetail_slocid').val(data.slocid);
                $('#sloccode').val(data.description);
                $('#Sodetail_itemtext').val(data.itemnote);
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
<?php echo $this->renderPartial('_formdetail', array('model'=>$sodetail)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'UrlCreate'=>'adddata1()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata1()',
	'isEdit'=>true,'UrlEdit'=>'editdata1()',
	'isDelete'=>true,'UrlDelete'=>'deletedata1()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detaildatagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detaildatagrid',
	'dataProvider'=>$sodetail->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'sodetailid','visible'=>false, 'header'=>'ID','value'=>'$data->sodetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'productid', 'value'=>'($data->product!==null)?$data->product->productname:""'),
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
      'name'=>'currencyrate',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->currencyrate)',
     ),
	array('name'=>'taxid', 'value'=>'($data->tax!==null)?$data->tax->taxcode:""'),
            'itemnote',
			array(
	  'header'=>'Total',
      'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->qty*$data->currencyrate*$data->price)',
      'type'=>'raw',	 'footer'=>Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$sodetail->getTotals())     
      ),
  ),
));
?>

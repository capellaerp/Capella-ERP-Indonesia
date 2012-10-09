<?php
$this->breadcrumbs=array(
	'invoicears',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$headerid=Yii::app()->user->getState('headerid',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata2()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('invoicear/createinvoiceacc'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog2 div.divcreate2').html(data.div);
					$('#Invoiceacc_invoiceaccid').val('');
					$('#Invoiceacc_accountid').val('');
					$('#account_name').val('');
					$('#Invoiceacc_debit').val('0');
					$('#Invoiceacc_credit').val('0');
					$('#invacccurrencyname').val('');
					$('#Invoiceacc_currencyrate').val('');
					$('#Invoiceacc_description').val('');
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog2').dialog('open');
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
function editdata2()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('invoicear/updateinvoiceacc'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detail2datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog2 div.divcreate2').html(data.div);
					$('#Invoiceacc_invoiceaccid').val(data.invoiceaccid);
					$('#Invoiceacc_accountid').val(data.accountid);
					$('#account_name').val(data.accountname);
					$('#Invoiceacc_debit').val(data.debit);
					$('#Invoiceacc_credit').val(data.credit);
					$('#invacccurrencyname').val(data.currencyname);
					$('#Invoiceacc_currencyrate').val(data.currencyrate);
					$('#Invoiceacc_description').val(data.description);
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog2').dialog('open');
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
function deletedata2()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('invoicear/deleteinvoiceacc'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detail2datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('detail2datagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata2()
{
    $.fn.yiiGridView.update('detail2datagrid');
    return false;
}
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
<div id="divcreate2"></div>
<?php echo $this->renderPartial('_forminvoiceacc', array('model'=>$invoiceacc)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata2()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata2()',
	'UrlDownload'=>'downloaddata2()',
	'isEdit'=>true,'UrlEdit'=>'editdata2()',
	'isDelete'=>true,'UrlDelete'=>'deletedata2()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail2datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail2datagrid',
	'dataProvider'=>$invoiceacc->search(),
  'selectableRows'=>1,
  'filter'=>$invoiceacc,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
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
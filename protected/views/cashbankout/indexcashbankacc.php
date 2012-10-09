<?php
$this->breadcrumbs=array(
	'cashbankouts',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$headerid=Yii::app()->user->getState('headerid',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata2()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('cashbankout/createcashbankacc'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog2 div.divcreate2').html(data.div);
					$('#Cashbankacc_cashbankaccid').val('');
					$('#Cashbankacc_accountid').val('');
					$('#account_name').val('');
					$('#Cashbankacc_debit').val('0');
					$('#Cashbankacc_credit').val('0');
					$('#invacccurrencyname').val('');
					$('#Cashbankacc_currencyrate').val('');
					$('#Cashbankacc_description').val('');
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
			'url'=>array('cashbankout/updatecashbankacc'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detail2datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog2 div.divcreate2').html(data.div);
					$('#Cashbankacc_cashbankaccid').val(data.cashbankaccid);
					$('#Cashbankacc_accountid').val(data.accountid);
					$('#account_name').val(data.accountname);
					$('#Cashbankacc_debit').val(data.debit);
					$('#Cashbankacc_credit').val(data.credit);
					$('#invacccurrencyname').val(data.currencyname);
					$('#Cashbankacc_currencyrate').val(data.currencyrate);
					$('#Cashbankacc_description').val(data.description);
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
			'url'=>array('cashbankout/deletecashbankacc'),
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
<?php echo $this->renderPartial('_formcashbankacc', array('model'=>$cashbankacc)); ?>
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
	'dataProvider'=>$cashbankacc->search(),
  'selectableRows'=>1,
  'filter'=>$cashbankacc,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'cashbankaccid', 'visible'=>false, 'header'=>'ID','value'=>'$data->cashbankaccid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'accountid', 'value'=>'($data->account!==null)?$data->account->accountname:""'),
array('name'=>'currencyid', 'value'=>'($data->currency!==null)?$data->currency->currencyname:""'),
        array(
      'name'=>'debit',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->debit)',
     ),
        array(
      'name'=>'credit',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberprice"],$data->credit)',
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

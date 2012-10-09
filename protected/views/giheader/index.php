<?php
$this->breadcrumbs=array(
	'Giheaders',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('giheader/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Giheader_giheaderid').val(data.giheaderid);
					$('#Giheader_gino').val('');
					$('#Giheader_gidate').val('');
					$('#Giheader_postdate').val('');
					$('#Giheader_soheaderid').val('');
					$('#sono').val('');
					$('#Giheader_deliveryadviceid').val('');
					$('#dano').val('');
document.forms[2].elements[3].value=data.giheaderid;
$.fn.yiiGridView.update('detaildatagrid',{data:{'Gidetail[giheaderid]':data.giheaderid}});
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog').dialog('open');
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
function editdata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('giheader/update'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Giheader_giheaderid').val(data.giheaderid);
					$('#Giheader_gino').val(data.gino);
					$('#Giheader_gidate').val(data.gidate);
					$('#Giheader_postdate').val(data.postdate);
					$('#Giheader_soheaderid').val(data.soheaderid);
					$('#sono').val(data.sono);
					$('#Giheader_deliveryadviceid').val(data.deliveryadviceid);
					$('#dano').val(data.dano);
document.forms[2].elements[3].value=data.giheaderid;
$.fn.yiiGridView.update('detaildatagrid',{data:{'Gidetail[giheaderid]':data.giheaderid}});
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog').dialog('open');
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
function deletedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('giheader/delete'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function approvedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('giheader/approve'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
if (data.status == 'failure') {
				document.getElementById('messages').innerHTML = data.div;}
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
function generatedataso() {
	jQuery.ajax({
        'url': '/index.php?r=giheader/generateso',
        'data': {
            'id': $('#Giheader_soheaderid').val(),
            'hid': $('#Giheader_giheaderid').val()
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if(data.status=='failure') {
            document.getElementById('messages').innerHTML = data.div;
            } else {
                
            }
            $.fn.yiiGridView.update("detaildatagrid");
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function generatedatada() {
	jQuery.ajax({
        'url': '/index.php?r=giheader/generateda',
        'data': {
            'id': $('#Giheader_deliveryadviceid').val(),
            'hid': $('#Giheader_giheaderid').val()
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if(data.status=='failure') {
            document.getElementById('messages').innerHTML = data.div;
            } else {
                
            }
            $.fn.yiiGridView.update("detaildatagrid");
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=giheader/help',
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
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        'Gidetail[giheaderid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=giheader/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
					'gidetail'=>$gidetail)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('giheader') ?></h1>
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
	'dataProvider'=>$model->Searchwfstatus(),
	'filter'=>$model,
    'selectionChanged'=>'showdetail',
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'giheaderid','visible'=>false, 'header'=>'ID','value'=>'$data->giheaderid','htmlOptions'=>array('width'=>'1%')),
        array(
      'name'=>'gidate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->gidate))'
     ),
		'gino',
	array('name'=>'deliveryadviceid', 'value'=>'($data->deliveryadvice!==null)?$data->deliveryadvice->dano:""'),
	array('name'=>'soheaderid', 'value'=>'($data->soheader!==null)?$data->soheader->sono:""'),
        'location',
        'headernote',
	array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("appgi",$data->recordstatus)')
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>$gidetail->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'gidetailid','visible'=>false, 'header'=>'ID','value'=>'$data->gidetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'productid','value'=>'($data->product!==null)?$data->product->productname:""'),
	 array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty)',
     ),
	array('name'=>'unitofmeasureid','value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
	array('name'=>'slocid','value'=>'($data->sloc!==null)?$data->sloc->description:""'),
        'itemnote',
        'serialno'
  ),
));
?>
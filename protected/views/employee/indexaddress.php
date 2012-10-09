<?php
$this->breadcrumbs=array(
	'Employee',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$headerid=Yii::app()->user->getState('headerid',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata1()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('employee/createaddress'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Employeeaddress_addressid').val('');
					$('#Employeeaddress_addresstypeid').val('');
					$('#addresstypename').val('');
					$('#Employeeaddress_addressname').val('');
					$('#Employeeaddress_rt').val('');
					$('#Employeeaddress_rw').val('');
					$('#Employeeaddress_cityid').val('');
					$('#cityname').val('');
					$('#Employeeaddress_kelurahanid').val('');
					$('#kelurahanname').val('');
					$('#Employeeaddress_subdistrictid').val('');
					$('#subdistrict_name').val('');
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog1').dialog('open');
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
function editdata1()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('employee/updateaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detail1datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Employeeaddress_addressid').val(data.addressid);
					$('#Employeeaddress_addresstypeid').val(data.addresstypeid);
					$('#addresstypename').val(data.addresstypename);
					$('#Employeeaddress_addressname').val(data.addressname);
					$('#Employeeaddress_rt').val(data.rt);
					$('#Employeeaddress_rw').val(data.rw);
					$('#Employeeaddress_cityid').val(data.cityid);
					$('#cityname').val(data.cityname);
					$('#Employeeaddress_kelurahanid').val(data.kelurahanid);
					$('#kelurahanname').val(data.kelurahanname);
					$('#Employeeaddress_subdistrictid').val(data.subdistrictid);
					$('#subdistrict_name').val(data.subdistrictname);
					if(data.recordstatus=='1')
{document.forms[1].elements[18].checked=true;}
else
{document.forms[1].elements[18].checked=false;}
                          // Here is the trick: on submit-> once again this function!
                $('#createdialog1').dialog('open');
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
function deletedata1()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('employee/deletedetail'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("detaildatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('detail1datagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata1()
{
    $.fn.yiiGridView.update('detail1datagrid');
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
<?php echo $this->renderPartial('_formaddress', array('model'=>$employeeaddress)); ?>
<?php $this->endWidget();?>
<?php
$this->widget('ToolbarButton',
	array('isCreate'=>true,'UrlCreate'=>'adddata1()',
	'isRefresh'=>true,'UrlRefresh'=>'refreshdata1()',
	'UrlDownload'=>'downloaddata1()',
	'isEdit'=>true,'UrlEdit'=>'editdata1()',
	'isDelete'=>true,'UrlDelete'=>'deletedata1()',
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('detail1datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detail1datagrid',
	'dataProvider'=>$employeeaddress->search(),
  'selectableRows'=>1,
  'filter'=>$employeeaddress,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'addressid', 'visible'=>false, 'header'=>'ID','value'=>'$data->addressid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'addresstypeid', 'value'=>'($data->addresstype!==null)?$data->addresstype->addresstypename:""'),
		'addressname',
		'rt',
    'rw',
		array('name'=>'cityid','value'=>'($data->city!==null)?$data->city->cityname:""'),
		array('name'=>'kelurahanid','value'=>'($data->kelurahan!==null)?$data->kelurahan->kelurahanname:""'),
		array('name'=>'subdistrictid','value'=>'($data->subdistrict!==null)?$data->subdistrict->subdistrictname:""'),
      array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Status',
      'checked'=>'$data->recordstatus',
    ),
  ),
));
?>

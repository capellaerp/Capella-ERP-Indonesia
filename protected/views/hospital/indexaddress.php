<?php
$this->breadcrumbs=array(
	'Hospital',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata1()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('hospital/createaddress'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Hospitaladdress_addressid').val('');$('#addressbook_name').val('');$('#Hospitaladdress_addresstypeid').val('');$('#addresstype_name').val('');$('#Hospitaladdress_addressname').val('');$('#Hospitaladdress_rt').val('');$('#Hospitaladdress_rw').val('');$('#Hospitaladdress_cityid').val('');$('#city_name').val('');$('#Hospitaladdress_kelurahanid').val('');$('#kelurahan_name').val('');$('#Hospitaladdress_subdistrictid').val('');$('#subdistrict_name').val('');
                    $('#Hospitaladdress_phoneno').val('');
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog1 div.divcreate1 form').submit(adddata1);
                }
                else
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
                    setTimeout(\"$('#createdialog1').dialog('close') \",3000);
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
			'url'=>array('hospital/updateaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("addressdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
					$('#Hospitaladdress_addressid').val(data.addressid);
                    $('#addressbook_name').val(data.fullname);
                    $('#Hospitaladdress_addresstypeid').val(data.addresstypeid);
                    $('#addresstype_name').val(data.addresstypename);
                    $('#Hospitaladdress_addressname').val(data.addressname);
                    $('#Hospitaladdress_rt').val(data.rt);
                    $('#Hospitaladdress_rw').val(data.rw);
                    $('#Hospitaladdress_cityid').val(data.cityid);
                    $('#city_name').val(data.cityname);
                    $('#Hospitaladdress_kelurahanid').val(data.kelurahanid);
                    $('#kelurahan_name').val(data.kelurahanname);
                    $('#Hospitaladdress_subdistrictid').val(data.subdistrictid);
                    $('#subdistrict_name').val(data.subdistrictname);
                    $('#Hospitaladdress_phoneno').val(data.phoneno);
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog1 div.divcreate1 form').submit(editdata1);
                }
                else
                {
                    $('#createdialog1 div.divcreate1').html(data.div);
                    setTimeout(\"$('#createdialog1').dialog('close') \",3000);
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
			'url'=>array('hospital/deleteaddress'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("addressdatagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	$.fn.yiiGridView.update('addressdatagrid');
    return false;
}
</script>
<script type="text/javascript">
function refreshdata1()
{
    $.fn.yiiGridView.update('addressdatagrid');
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
<?php echo $this->renderPartial('_formaddress', array('model'=>$hospitaladdress)); ?>
<?php $this->endWidget();?>
<?php
$img1create=CHtml::image(Yii::app()->request->baseUrl.'/images/create.png');
echo CHtml::link($img1create,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{adddata1(); $('#createdialog1').dialog('open');}",
));
$img1edit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
echo CHtml::link($img1edit,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata1(); $('#createdialog1').dialog('open');}",
));
$img1delete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
echo CHtml::link($img1delete,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{deletedata1()}",
));
$img1help=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
echo CHtml::link($img1help,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{helpdata(3)}",
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'addressdatagrid',
	'dataProvider'=>$hospitaladdress->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'addressid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid', 'visible'=>false,'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'addresstypeid', 'header'=>'Address Type Name','value'=>'$data->addresstype->addresstypename'),
		'addressname',
		'rt',
    'rw',
		array('name'=>'cityid','header'=>'City','value'=>'($data->city!==null)?$data->city->cityname:""'),
		array('name'=>'kelurahanid','header'=>'Sub Subdistrict','value'=>'($data->kelurahan!==null)?$data->kelurahan->kelurahanname:""'),
		array('name'=>'subdistrictid','header'=>'Subdistrict','value'=>'($data->subdistrict!==null)?$data->subdistrict->subdistrictname:""'),
        'phoneno'
  ),
));
?>

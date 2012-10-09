<?php
$this->breadcrumbs=array(
	'Insurances',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata()
{jQuery.ajax({'url':'/index.php?r=insurance/create','data':$(this).serialize(),'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Insurance_addressbookid').val(data.addressbookid);$('#Insurance_fullname').val('');
document.forms[2].elements[1].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Insuranceaddress[addressbookid]': data.addressbookid
                    }});
                                        document.forms[3].elements[1].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Insurancecontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function editdata()
{jQuery.ajax({'url':'/index.php?r=insurance/update','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{document.getElementById('messages').innerHTML='';if(data.status=='success')
{$('#createdialog div.divcreate').html(data.div);$('#Insurance_addressbookid').val(data.addressbookid);$('#Insurance_fullname').val(data.fullname);if(data.recordstatus=='1')
{document.forms[1].elements[7].checked=true;}
else
{document.forms[1].elements[7].checked=false;}
document.forms[2].elements[1].value = data.addressbookid;
$.fn.yiiGridView.update('addressdatagrid', {
                    data: {
                        'Insuranceaddress[addressbookid]': data.addressbookid
                    }});
                    document.forms[3].elements[1].value = data.addressbookid;
$.fn.yiiGridView.update('contactdatagrid', {
                    data: {
                        'Insurancecontact[addressbookid]': data.addressbookid
                    }
                });
$('#createdialog').dialog('open');}
else
{document.getElementById('messages').innerHTML = data.div;}},'cache':false});;return false;}
</script>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'/index.php?r=insurance/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=insurance/help',
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
    $.fn.yiiGridView.update('inaddressdatagrid', {
                    data: {
                        'Insuranceaddress[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
                   $.fn.yiiGridView.update('incontactdatagrid', {
                    data: {
                        'Insurancecontact[addressbookid]': $.fn.yiiGridView.getSelection("datagrid")[0]
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
'insuranceaddress'=>$insuranceaddress,
'insurancecontact'=>$insurancecontact,
        'accpiutang'=>$accpiutang)); ?>
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
<h1>Transaction: Insurance</h1><div id="toolbardoublegrid">
<?php
$imgcreate=CHtml::image(Yii::app()->request->baseUrl.'/images/create.png');
echo CHtml::link($imgcreate,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{adddata()}",
	'title'=>Yii::t('app','create data')
));
$imgedit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
echo CHtml::link($imgedit,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata()}",
	'title'=>Yii::t('app','edit data')
));
$imgdelete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
echo CHtml::link($imgdelete,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{deletedata()}",
   'title'=>Yii::t('app','delete data')
));
$imgdown=CHtml::image(Yii::app()->request->baseUrl.'/images/down.png');
echo CHtml::link($imgdown,array('/insurance/download'),array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'title'=>Yii::t('app','download data')
));
$imgrefresh=CHtml::image(Yii::app()->request->baseUrl.'/images/refresh.png');
echo CHtml::link($imgrefresh,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{refreshdata()}",
   'title'=>Yii::t('app','refresh data')
));
$imghelp=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
echo CHtml::link($imghelp,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{helpdata(1)}",
   'title'=>Yii::t('app','help')
));
?><div class="recordpage">Record/page<?php echo CHtml::textField($pageSize,'',array('size'=>'5',
        // change 'user-grid' to the actual id of your grid!!
        'onchange'=>"$.fn.yiiGridView.update('datagrid',{ data:{pageSize: $(this).val() }})",
	  ));  ?></div><?php
// $this->widget('ext.EAjaxUpload.EAjaxUpload',
                 // array(
                       // 'id'=>'uploadFile',
                       // 'config'=>array(
                                       // 'action'=>'index.php?r=insurance/upload',
                                       // 'allowedExtensions'=>array("csv"),
                                       // 'sizeLimit'=>(int)Yii::app()->params['sizeLimit'],
									   // 'onComplete'=>"js:function(id, fileName, responseJSON){ $.fn.yiiGridView.update('datagrid');  }",
                                       // 'messages'=>array(
                                                         // 'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                         // 'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                         // 'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                         // 'emptyError'=>"{file} is empty, please select files again without it.",
                                                         // 'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                        // ),
                                       // 'showMessage'=>"js:function(message){ alert(message); }"
                                      // )
                      // ));
?></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
  'selectableRows'=>1,
    'selectionChanged'=>'showdetail',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'addressbookid',
    ),
	array('name'=>'addressbookid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
		'fullname',
        'taxno',
		array('name'=>'accpiutangid','value'=>'($data->accpiutang!==null)?$data->accpiutang->accountname:""'),
    array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus'
    ),
	),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inaddressdatagrid',
	'dataProvider'=>$insuranceaddress->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'addressid', 'visible'=>false,'header'=>'ID','value'=>'$data->addressid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid', 'visible'=>false,'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'addresstypeid', 'header'=>'Address Type Name','value'=>'$data->addresstype->addresstypename'),
		'addressname',
		'rt',
    'rw',
		array('name'=>'cityid','header'=>'City','value'=>'($data->city!==null)?$data->city->cityname:""'),
		array('name'=>'kelurahanid','header'=>'Sub Subdistrict','value'=>'($data->kelurahan!==null)?$data->kelurahan->kelurahanname:""'),
		array('name'=>'subdistrictid','header'=>'Subdistrict','value'=>'($data->subdistrict!==null)?$data->subdistrict->subdistrictname:""'),
        'phoneno',
  ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'incontactdatagrid',
	'dataProvider'=>$insurancecontact->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'addresscontactid','visible'=>false, 'header'=>'ID','value'=>'$data->addresscontactid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'addressbookid','visible'=>false, 'value'=>'$data->addressbookid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'contacttypeid', 'value'=>'($data->contacttype!==null)?$data->contacttype->contacttypename:""'),
		'addresscontactname',
		'phoneno',
		'mobilephone',
		'emailaddress',
  ),
));
?>
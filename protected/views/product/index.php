<?php
$this->breadcrumbs=array(
	'Products',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=product/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Product_productid').val(data.productid);
                $('#Product_productname').val('');
                document.forms[2].elements[3].value = data.productid;
                document.forms[3].elements[3].value = data.productid;
                document.forms[4].elements[3].value = data.productid;
                document.forms[5].elements[3].value = data.productid;
                document.forms[6].elements[3].value = data.productid;
                $.fn.yiiGridView.update('detailbasicdatagrid', {
                    data: {
                        'Productbasic[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailplantdatagrid', {
                    data: {
                        'Productplant[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailpurchasedatagrid', {
                    data: {
                        'Productpurchase[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailaccdatagrid', {
                    data: {
                        'Productacc[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailconversiondatagrid', {
                    data: {
                        'Productconversion[productid]': data.productid
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
        'url': '/index.php?r=product/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Product_productid').val(data.productid);
                $('#Product_productname').val(data.productname);
				if (data.isstock == '1')
				{
                 document.forms[1].elements[5].checked = true;
				} else
				{
                 document.forms[1].elements[5].checked = false;
				}
				if (data.recordstatus == '1')
				{
                 document.forms[1].elements[7].checked = true;
				} else
				{
                 document.forms[1].elements[7].checked = false;
				}
                 document.forms[2].elements[3].value = data.productid;
                document.forms[3].elements[3].value = data.productid;
                document.forms[4].elements[3].value = data.productid;
                document.forms[5].elements[3].value = data.productid;
                document.forms[6].elements[3].value = data.productid;
               $.fn.yiiGridView.update('detailbasicdatagrid', {
                    data: {
                        'Productbasic[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailplantdatagrid', {
                    data: {
                        'Productplant[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailpurchasedatagrid', {
                    data: {
                        'Productpurchase[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailaccdatagrid', {
                    data: {
                        'Productacc[productid]': data.productid
                    }
                });
                $.fn.yiiGridView.update('detailconversiondatagrid', {
                    data: {
                        'Productconversion[productid]': data.productid
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
{jQuery.ajax({'url':'/index.php?r=product/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function approvedata()
{jQuery.ajax({'url':'/index.php?r=product/approve','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=product/help',
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
	window.open('/index.php?r=product/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('indetailbasicdatagrid', {
                    data: {
                        'Productbasic[productid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
	    $.fn.yiiGridView.update('indetailplantdatagrid', {
                    data: {
                        'Productplant[productid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
				$.fn.yiiGridView.update('indetailpurchasedatagrid', {
                    data: {
                        'Productpurchase[productid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
				$.fn.yiiGridView.update('indetailaccdatagrid', {
                    data: {
                        'Productacc[productid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
								$.fn.yiiGridView.update('indetailconversiondatagrid', {
                    data: {
                        'Productconversion[productid]': $.fn.yiiGridView.getSelection("datagrid")[0]
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
'productbasic'=>$productbasic,
'productacc'=>$productacc,
'productplant'=>$productplant,
'productpurchase'=>$productpurchase,
'productconversion'=>$productconversion
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
    array('id' => '#baseuomcode','fallback'=>Catalogsys::model()->getcatalog('enteruomcode'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'productname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterproductname'),'html'=>true),       
    array('id' => array('model' => $model, 'attribute' => 'recordstatus')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrecordstatus'),'html'=>true),   
  ),  
));
?>
<h1><?php echo Catalogsys::model()->GetCatalog('product') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=product/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->Search(),
	'filter'=>$model,
    'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'selectionChanged'=>'showdetail',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'productid', 'visible'=>false,'header'=>'ID','value'=>'$data->productid','htmlOptions'=>array('width'=>'1%')),
        	/*array(
            'name'=>'productid',
			'header'=>'Picture',
             'type'=>'image',
             'value'=>'"images/product/" . $data->productname . ".jpg"',
        ),*/
	'productname',
	array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isstock',
      'selectableRows'=>'0',
      'header'=>'Is Stock',
      'checked'=>'$data->isstock',
    ),
	array(
      'class'=>'CCheckBoxColumn',
      'name'=>'recordstatus',
      'selectableRows'=>'0',
      'header'=>'Record Status',
      'checked'=>'$data->recordstatus',
    ),
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailbasicdatagrid',
	'dataProvider'=>$productbasic->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'productbasicid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productbasicid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'baseuom', 'value'=>'($data->baseuom0!==null)?$data->baseuom0->uomcode:""'),
array('name'=>'materialgroupid', 'value'=>'($data->materialgroup!==null)?$data->materialgroup->description:""'),
'oldmatno',
'grossweight',
array('name'=>'weightunit', 'value'=>'($data->baseuom1!==null)?$data->baseuom1->uomcode:""'),
'netweight',
'volume',
array('name'=>'volumeunit', 'value'=>'($data->baseuom2!==null)?$data->baseuom2->uomcode:""'),
'sizedimension',
array('name'=>'materialpackage', 'value'=>'($data->materialpackage0!==null)?$data->materialpackage0->productname:""'),
  ),
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailplantdatagrid',
	'dataProvider'=>$productplant->search(),
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'productplantid','visible'=>false, 'header'=>'ID','value'=>'$data->productplantid','htmlOptions'=>array('width'=>'1%')),
array('name'=>'slocid', 'value'=>'($data->sloc!==null)?$data->sloc->sloccode:""'),
array('name'=>'unitofissue', 'value'=>'($data->unitofissue0!==null)?$data->unitofissue0->uomcode:""'),
	array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isautolot',
      'selectableRows'=>'0',
      'header'=>'Auto LOT',
      'checked'=>'$data->isautolot',
    ),
	'storagebin',
	'pickingarea',
	'sled',
array('name'=>'snroid', 'value'=>'($data->snro!==null)?$data->snro->description:""'),
	),
)); 
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailpurchasedatagrid',
	'dataProvider'=>$productpurchase->search(),
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'productpurchaseid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productpurchaseid','htmlOptions'=>array('width'=>'1%')),
		array('name'=>'plantid', 'value'=>'($data->plant!==null)?$data->plant->plantcode:""'),
		array('name'=>'orderunit', 'value'=>'($data->orderunit0!==null)?$data->orderunit0->uomcode:""'),
		array('name'=>'purchasinggroupid', 'value'=>'($data->purchasinggroup!==null)?$data->purchasinggroup->purchasinggroupcode:""'),
	array(
      'name'=>'validfrom',
      'type'=>'raw',
         'value'=>'($data->validfrom!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->validfrom)):""'
     ),
	array(
      'name'=>'validto',
      'type'=>'raw',
         'value'=>'($data->validto!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->validto)):""'
     ),
		array(
      'class'=>'CCheckBoxColumn',
      'name'=>'isautoPO',
      'selectableRows'=>'0',
      'header'=>'Auto PO',
      'checked'=>'$data->isautoPO',
    ),
	),
)); 
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailaccdatagrid',
	'dataProvider'=>$productacc->search(),
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'productaccid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productaccid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'inventoryaccid', 'value'=>'($data->inventoryacc!==null)?$data->inventoryacc->accountcode:""'),
	array('name'=>'salesaccid', 'value'=>'($data->salesacc!==null)?$data->salesacc->accountcode:""'),
	array('name'=>'salesretaccid', 'value'=>'($data->salesretacc!==null)?$data->salesretacc->accountcode:""'),
	array('name'=>'itemdiscaccid', 'value'=>'($data->itemdiscacc!==null)?$data->itemdiscacc->accountcode:""'),
	array('name'=>'cogsaccid', 'value'=>'($data->cogsacc!==null)?$data->cogsacc->accountcode:""'),
	array('name'=>'purchaseretaccid', 'value'=>'($data->purchaseretacc!==null)?$data->purchaseretacc->accountcode:""'),
	array('name'=>'expenseaccid', 'value'=>'($data->expenseacc!==null)?$data->expenseacc->accountcode:""'),
	array('name'=>'unbilledgoodsaccid', 'value'=>'($data->unbilledgoodsacc!==null)?$data->unbilledgoodsacc->accountcode:""'),
	),
)); 
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indetailconversiondatagrid',
	'dataProvider'=>$productconversion->search(),
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'productconversionid', 'visible'=>false, 'header'=>'ID','value'=>'$data->productconversionid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'fromuom', 'value'=>'($data->fromuom0!==null)?$data->fromuom0->uomcode:""'),
	'fromvalue',
	array('name'=>'touom', 'value'=>'($data->touom0!==null)?$data->touom0->uomcode:""'),
	'tovalue'
	),
)); 
?>
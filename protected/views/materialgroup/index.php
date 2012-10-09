<?php
$this->breadcrumbs=array(
	'Materialgroups',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
// here is the magic
function adddata()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('materialgroup/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Materialgroup_materialgroupid').val('');
					$('#Materialgroup_materialgroupcode').val('');
					$('#Materialgroup_parentmatgroupid').val('');
					$('#parentmatgroupcode').val('');
					$('#Materialgroup_materialtypeid').val('');
					$('#materialtypedescription').val('');
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
			'url'=>array('materialgroup/update'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Materialgroup_materialgroupid').val(data.materialgroupid);
					$('#Materialgroup_materialgroupcode').val(data.materialgroupcode);
					$('#Materialgroup_parentmatgroupid').val(data.parentmatgroupid);
					$('#parentmatgroupcode').val(data.parentmatgroupcode);
					$('#Materialgroup_materialtypeid').val(data.materialtypeid);
					$('#materialtypedescription').val(data.materialtypename);
					if (data.recordstatus == '1')
					{
					  document.forms[1].elements[12].checked=true;
					}
					else
					{
					  document.forms[1].elements[12].checked=false;
					}
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
			'url'=>array('materialgroup/delete'),
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
function refreshdata()
{
    $.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=materialgroup/help',
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
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
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
<h1><?php echo Catalogsys::model()->GetCatalog('materialgroup') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=materialgroup/upload',
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => '#parentmatgroupcode','fallback'=>Catalogsys::model()->getcatalog('entermaterialgroupid'),'html'=>true),    
    array('id' => '#materialtypedescription','fallback'=>Catalogsys::model()->getcatalog('entermaterialtypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'materialtypeid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermaterialtypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'materialgroupcode')
     ,'fallback' => Catalogsys::model()->getcatalog('entermaterialgroupcode'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'description')
     ,'fallback' => Catalogsys::model()->getcatalog('enterdescription'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'parentmatgroupid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermaterialgroupid'),'html'=>true),    
  ),  
));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'materialgroupid','visible'=>false, 'value'=>'$data->materialgroupid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'materialtypeid', 'value'=>'($data->materialtype!==null)?$data->materialtype->description:""'),
	array('name'=>'materialgroupcode', 'value'=>'$data->materialgroupcode','htmlOptions'=>array('width'=>'1%')),
	'description',
	array('name'=>'parentmatgroupid','value'=>'($data->parentmatgroup!==null)?$data->parentmatgroup->description:""'),
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


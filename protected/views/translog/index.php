<?php
$this->breadcrumbs=array(
	'Translogs',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'index.php?r=translog/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=translog/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => array('model' => $model, 'attribute' => 'useraction')
     ,'fallback' => Catalogsys::model()->getcatalog('enteruseraction'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'username')
     ,'fallback' => Catalogsys::model()->getcatalog('enterusername'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'model')
     ,'fallback' => Catalogsys::model()->getcatalog('entermodel'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'fieldname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfieldname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'fieldnewvalue')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfieldnewvalue'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'createddate')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfcreateddate'),'html'=>true),    
  ),  
));
?>
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
<?php echo $this->renderPartial('_help'); ?>
<?php $this->endWidget();?>
<h1><?php echo Catalogsys::model()->GetCatalog('translog') ?></h1>
<?php
$this->widget('ToolbarButton',array('isDelete'=>true,
	'isDownload'=>true,'isRefresh'=>true,
	'isHelp'=>true,'OnClick'=>"{helpdata(1)}",
	'isRecordPage'=>true,'PageSize'=>$pageSize,'OnChange'=>"$.fn.yiiGridView.update('datagrid',{data:{pageSize: $(this).val() }})"));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>2,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'translogid',
    ),
	array('name'=>'translogid', 'visible'=>false,'header'=>'ID','value'=>'$data->translogid','htmlOptions'=>array('width'=>'1%')),
    'useraction',
    'model',
    'fieldname',
            'fieldnewvalue',
    'createddate',
	),
));?>
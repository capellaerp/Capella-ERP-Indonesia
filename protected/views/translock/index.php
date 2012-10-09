<?php
$this->breadcrumbs=array(
	'Translocks',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function deletedata()
{jQuery.ajax({'url':'index.php?r=translock/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/index.php?r=translock/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php
$this->widget('application.extensions.tipsy.Tipsy', array(
  'fade' => false,
  'gravity' => 'n',
  'items' => array(
    array('id' => array('model' => $model, 'attribute' => 'menuname')
     ,'fallback' => Catalogsys::model()->getcatalog('entermenuname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'tableid')
     ,'fallback' => Catalogsys::model()->getcatalog('entertableid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'lockedby')
     ,'fallback' => Catalogsys::model()->getcatalog('enterlockedby'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'lockeddate')
     ,'fallback' => Catalogsys::model()->getcatalog('enterlockeddate'),'html'=>true),    
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
<h1><?php echo Catalogsys::model()->GetCatalog('translock') ?></h1>
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
      'id'=>'translockid',
    ),
	array('name'=>'translockid', 'visible'=>false,'header'=>'ID','value'=>'$data->translockid','htmlOptions'=>array('width'=>'1%')),
    'menuname',
    'tableid',
    'lockedby',
            'lockeddate',
	),
));?>
<?php
$this->breadcrumbs=array(
	'Genjournals',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function refreshdata()
{
    $.fn.yiiGridView.update('datagrid');
    return false;
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        'Journaldetail[genjournalid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/index.php?r=genjournal/help',
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
    array('id' => '#structurename','fallback'=>Catalogsys::model()->getcatalog('enterorgstructureid'),'html'=>true),    
    array('id' => '#positionname','fallback'=>Catalogsys::model()->getcatalog('enterpositionid'),'html'=>true),    
    array('id' => '#levelorgname','fallback'=>Catalogsys::model()->getcatalog('enterlevelorgid'),'html'=>true),    
    array('id' => '#employeetypename','fallback'=>Catalogsys::model()->getcatalog('enteremployeetypeid'),'html'=>true),    
    array('id' => '#sexname','fallback'=>Catalogsys::model()->getcatalog('entersexid'),'html'=>true),    
    array('id' => '#birthcity_name','fallback'=>Catalogsys::model()->getcatalog('entercityid'),'html'=>true),    
    array('id' => '#religion_name','fallback'=>Catalogsys::model()->getcatalog('enterreligionid'),'html'=>true),    
    array('id' => '#maritalstatus_name','fallback'=>Catalogsys::model()->getcatalog('entermaritalstatusid'),'html'=>true),    
    array('id' => '#employeestatus_name','fallback'=>Catalogsys::model()->getcatalog('enteremployeestatusid'),'html'=>true),    
    array('id' => '#subdistrict_name','fallback'=>Catalogsys::model()->getcatalog('entersubdistrictid'),'html'=>true),    
    array('id' => '#kelurahanname','fallback'=>Catalogsys::model()->getcatalog('enterkelurahanid'),'html'=>true),    
    array('id' => '#cityname','fallback'=>Catalogsys::model()->getcatalog('entercityid'),'html'=>true),    
    array('id' => '#addresstypename','fallback'=>Catalogsys::model()->getcatalog('enteraddresstypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'fullname')
     ,'fallback' => Catalogsys::model()->getcatalog('enterfullname'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'oldnik')
     ,'fallback' => Catalogsys::model()->getcatalog('enteroldnik'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'orgstructureid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterorgstructureid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'positionid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterpositionid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'levelorgid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterlevelorgid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'employeetypeid')
     ,'fallback' => Catalogsys::model()->getcatalog('enteremployeetypeid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'sexid')
     ,'fallback' => Catalogsys::model()->getcatalog('entersexid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'birthcityid')
     ,'fallback' => Catalogsys::model()->getcatalog('entercityid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'birthdate')
     ,'fallback' => Catalogsys::model()->getcatalog('enterbirthdate'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'religionid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterreligionid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'maritalstatusid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermaritalstatusid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'maritalstatusid')
     ,'fallback' => Catalogsys::model()->getcatalog('entermaritalstatusid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'referenceby')
     ,'fallback' => Catalogsys::model()->getcatalog('enterreferenceby'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'employeestatusid')
     ,'fallback' => Catalogsys::model()->getcatalog('enteremployeestatusid'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'istrial')
     ,'fallback' => Catalogsys::model()->getcatalog('enteristrial'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'accountno')
     ,'fallback' => Catalogsys::model()->getcatalog('enteraccountno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'taxno')
     ,'fallback' => Catalogsys::model()->getcatalog('entertaxno'),'html'=>true),    
    array('id' => array('model' => $model, 'attribute' => 'joindate')
     ,'fallback' => Catalogsys::model()->getcatalog('enterjoindate'),'html'=>true),      
  ),  
));
?>
<h1><?php echo Catalogsys::model()->GetCatalog('genjournal') ?></h1>
<?php
$this->widget('ToolbarButton',array(
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
    'selectionChanged'=>'showdetail',
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'genjournalid','visible'=>false, 'header'=>'ID','value'=>'$data->genjournalid','htmlOptions'=>array('width'=>'1%')),
		'referenceno',
		array(
      'name'=>'journaldate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->journaldate))'
     ),
array(
      'name'=>'postdate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->postdate))'
     ),		
		'journalnote',
	array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("appjournal",$data->recordstatus)')
  ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>$journaldetail->search(),
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'journaldetailid','visible'=>false, 'header'=>'ID','value'=>'$data->journaldetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'accountid', 'header'=>'Account Code','value'=>'$data->account->accountcode'),
	array('name'=>'accountid', 'header'=>'Account Name','value'=>'$data->account->accountname'),
            array(
      'name'=>'debit',
      'type'=>'raw',
'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->debit)'
        ),
            array(
      'name'=>'credit',
      'type'=>'raw',
                'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->credit)',
     ),
	array('name'=>'currencyid', 'value'=>'$data->currency->currencyname'),
        'detailnote'
  ),
));
?>

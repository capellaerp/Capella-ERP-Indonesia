<?php
$this->breadcrumbs=array(
	'Employees',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript">
function adddata() {
    jQuery.ajax({
        'url': '/index.php?r=employee/create',
        'data': $(this).serialize(),
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Employee_employeeid').val(data.employeeid);
                $('#Employee_fullname').val('');
                $('#Employee_oldnik').val('');
                $('#Employee_orgstructureid').val('');
                $('#structurename').val('');
                $('#Employee_positionid').val('');
                $('#positionname').val('');
                $('#Employee_levelorgid').val('');
                $('#levelorgname').val('');
                $('#Employee_employeetypeid').val('');
                $('#employeetypename').val('');
                $('#Employee_sexid').val('');
                $('#sexname').val('');
                $('#Employee_religionid').val('');
                $('#religion_name').val('');
                $('#Employee_birthcityid').val('');
                $('#birthcity_name').val('');
                $('#Employee_birthdate').val('');
                $('#Employee_employeestatusid').val('');
                $('#employeestatus_name').val('');
                $('#Employee_maritalstatusid').val('');
                $('#maritalstatus_name').val('');
                $('#Employee_referenceby').val('');
                $('#Employee_joindate').val('');
                $('#Employee_taxno').val('');
                $('#Employee_accountno').val('');
                document.forms[2].elements[3].value = data.addressbookid;
                document.forms[3].elements[3].value = data.employeeid;
                document.forms[4].elements[3].value = data.employeeid;
                document.forms[5].elements[3].value = data.employeeid;
                document.forms[6].elements[3].value = data.employeeid;
                /*document.forms[7].elements[1].value = data.employeeid;*/
                $.fn.yiiGridView.update('detail1datagrid', {
                    data: {
                        'Employeeaddress[addressbookid]': data.addressbookid
                    }
                });
                $.fn.yiiGridView.update('detail2datagrid', {
                    data: {
                        'Employeeeducation[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail3datagrid', {
                    data: {
                        'Employeeinformal[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail4datagrid', {
                    data: {
                        'Employeewo[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail5datagrid', {
                    data: {
                        'Employeefamily[employeeid]': data.employeeid
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
        'url': '/index.php?r=employee/update',
        'data': {
            'id': $.fn.yiiGridView.getSelection("datagrid")
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            document.getElementById('messages').innerHTML = '';
            if (data.status == 'success') {
                $('#createdialog div.divcreate').html(data.div);
                $('#Employee_employeeid').val(data.employeeid);
                $('#Employee_fullname').val(data.fullname);
                $('#Employee_oldnik').val(data.oldnik);
                $('#Employee_orgstructureid').val(data.orgstructureid);
                $('#structurename').val(data.structurename);
                $('#Employee_positionid').val(data.positionid);
                $('#positionname').val(data.positionname);
                $('#Employee_levelorgid').val(data.levelorgid);
                $('#levelorgname').val(data.levelorgname);
                $('#Employee_employeetypeid').val(data.employeetypeid);
                $('#employeetypename').val(data.employeetypename);
                $('#Employee_sexid').val(data.sexid);
                $('#sexname').val(data.sexname);
               $('#Employee_religionid').val(data.religionid);
                $('#religion_name').val(data.religionname);
                $('#Employee_birthcityid').val(data.birthcityid);
                $('#birthcity_name').val(data.birthcityname);
                $('#Employee_birthdate').val(data.birthdate);
                $('#Employee_employeestatusid').val(data.employeestatusid);
                $('#employeestatus_name').val(data.employeestatusname);
                $('#Employee_maritalstatusid').val(data.maritalstatusid);
                $('#maritalstatus_name').val(data.maritalstatusname);
                $('#Employee_referenceby').val(data.referenceby);
                $('#Employee_joindate').val(data.joindate);
                $('#Employee_taxno').val(data.taxno);
                $('#Employee_accountno').val(data.accountno);
                 document.forms[2].elements[3].value = data.addressbookid;
                document.forms[3].elements[3].value = data.employeeid;
                document.forms[4].elements[3].value = data.employeeid;
                document.forms[5].elements[3].value = data.employeeid;
                document.forms[6].elements[3].value = data.employeeid;
               $.fn.yiiGridView.update('detail1datagrid', {
                    data: {
                        'Employeeaddress[addressbookid]': data.addressbookid
                    }
                });
                $.fn.yiiGridView.update('detail2datagrid', {
                    data: {
                        'Employeeeducation[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail3datagrid', {
                    data: {
                        'Employeeinformal[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail4datagrid', {
                    data: {
                        'Employeewo[employeeid]': data.employeeid
                    }
                });
                $.fn.yiiGridView.update('detail5datagrid', {
                    data: {
                        'Employeefamily[employeeid]': data.employeeid
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
{jQuery.ajax({'url':'/index.php?r=employee/delete','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function approvedata()
{jQuery.ajax({'url':'/index.php?r=employee/approve','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json','success':function(data)
{},'cache':false});;$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function refreshdata()
{$.fn.yiiGridView.update('datagrid');return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
    jQuery.ajax({
        'url': '/index.php?r=employee/help',
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
	window.open('/index.php?r=employee/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
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
'employeeaddress'=>$employeeaddress,
'employeeeducation'=>$employeeeducation,
'employeeinformal'=>$employeeinformal,
'employeewo'=>$employeewo,
'employeefamily'=>$employeefamily
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
    array('id' => array('model' => $employeeaddress, 'attribute' => 'addresstypeid')
     ,'fallback' => Catalogsys::model()->getcatalog('enteraddresstypeid'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'addressname')
     ,'fallback' => Catalogsys::model()->getcatalog('enteraddressname'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'rt')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrt'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'rw')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrw'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'cityid')
     ,'fallback' => Catalogsys::model()->getcatalog('entercityid'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'kelurahanid')
     ,'fallback' => Catalogsys::model()->getcatalog('enterkelurahanid'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'subdistrictid')
     ,'fallback' => Catalogsys::model()->getcatalog('entersubdistrictid'),'html'=>true),    
    array('id' => array('model' => $employeeaddress, 'attribute' => 'recordstatus')
     ,'fallback' => Catalogsys::model()->getcatalog('enterrecordstatus'),'html'=>true),   
  ),  
));
?>
<h1><?php echo Catalogsys::model()->GetCatalog('employee') ?></h1>
<?php
$this->widget('ToolbarButton',array('isCreate'=>true,'isEdit'=>true,'isDelete'=>true,
	'isUpload'=>true,'UrlUpload'=>'index.php?r=employee/upload',
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
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'employeeid', 'visible'=>false,'header'=>'ID','value'=>'$data->employeeid','htmlOptions'=>array('width'=>'1%')),
        	array(
            'name'=>'employeeid',
			'header'=>'Picture',
             'type'=>'image',
             'value'=>'"images/employee/photo-" . $data->oldnik . ".jpg"',
        ),
	'fullname',
	'oldnik',
	array('name'=>'orgstructureid', 'value'=>'($data->orgstructure!==null)?$data->orgstructure->structurename:""'),
	array('name'=>'positionid', 'value'=>'($data->position!==null)?$data->position->positionname:""'),
	array('name'=>'levelorgid', 'value'=>'($data->levelorg!==null)?$data->levelorg->levelorgname:""'),
  ),
));
?>

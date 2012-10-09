<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
$this->widget('ToolbarButton',array(
	'DialogID'=>'createdialog5',
	'DialogGrid'=>'detailaccdatagrid',
	'isSave'=>true,'UrlSave'=>'product/writeacc',
	'isCancel'=>true,'UrlCancel'=>'product/cancelwriteacc'
));
?>
<?php echo $form->hiddenField($model,'productaccid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
          <div class="row">
              <?php echo $form->labelEx($model,'inventoryaccid'); ?>
              <?php echo $form->hiddenField($model,'inventoryaccid'); ?>
                    <input type="text" name="inventoryacccode" id="inventoryacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'inventoryacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'inventoryacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#inventoryacc_dialog\").dialog(\"close\"); 
						  $(\"#inventoryacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#inventoryacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'inventoryaccid'); ?>
            </div>
			
			 <div class="row">
              <?php echo $form->labelEx($model,'salesaccid'); ?>
              <?php echo $form->hiddenField($model,'salesaccid'); ?>
                    <input type="text" name="salesacccode" id="salesacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'salesacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'salesacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#salesacc_dialog\").dialog(\"close\"); 
						  $(\"#salesacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#salesacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'salesaccid'); ?>
            </div>
			
			<div class="row">
              <?php echo $form->labelEx($model,'salesretaccid'); ?>
              <?php echo $form->hiddenField($model,'salesretaccid'); ?>
                    <input type="text" name="salesretacccode" id="salesretacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'salesretacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'salesretacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#salesretacc_dialog\").dialog(\"close\"); 
						  $(\"#salesretacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#salesretacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'salesretaccid'); ?>
            </div>
			
			<div class="row">
              <?php echo $form->labelEx($model,'itemdiscaccid'); ?>
              <?php echo $form->hiddenField($model,'itemdiscaccid'); ?>
                    <input type="text" name="itemdiscacccode" id="itemdiscacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'itemdiscacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'itemdiscacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#itemdiscacc_dialog\").dialog(\"close\"); 
						  $(\"#itemdiscacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#itemdiscacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'itemdiscaccid'); ?>
            </div>

			<div class="row">
              <?php echo $form->labelEx($model,'cogsaccid'); ?>
              <?php echo $form->hiddenField($model,'cogsaccid'); ?>
                    <input type="text" name="cogsacccode" id="cogsacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'cogsacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'cogsacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#cogsacc_dialog\").dialog(\"close\"); 
						  $(\"#cogsacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#cogsacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'cogsaccid'); ?>
            </div>
			
			<div class="row">
              <?php echo $form->labelEx($model,'purchaseretaccid'); ?>
              <?php echo $form->hiddenField($model,'purchaseretaccid'); ?>
                    <input type="text" name="purchaseretacccode" id="purchaseretacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'purchaseretacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'purchaseretacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#purchaseretacc_dialog\").dialog(\"close\"); 
						  $(\"#purchaseretacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#purchaseretacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'purchaseretaccid'); ?>
            </div>
			
			<div class="row">
              <?php echo $form->labelEx($model,'expenseaccid'); ?>
              <?php echo $form->hiddenField($model,'expenseaccid'); ?>
                    <input type="text" name="expenseacccode" id="expenseacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'expenseacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'expenseacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#expenseacc_dialog\").dialog(\"close\"); 
						  $(\"#expenseacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#expenseacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'expenseaccid'); ?>
            </div>
			
			<div class="row">
              <?php echo $form->labelEx($model,'unbilledgoodsaccid'); ?>
              <?php echo $form->hiddenField($model,'unbilledgoodsaccid'); ?>
                    <input type="text" name="unbilledgoodsacccode" id="unbilledgoodsacccode" readonly >
                    <?php
                      $this->beginWidget('zii.widgets.jui.CJuiDialog',
                       array(   'id'=>'unbilledgoodsacc_dialog',
                                // additional javascript options for the dialog plugin
                                'options'=>array(
                                                'title'=>Yii::t('app','Chart of Account'),
                                                'width'=>'auto',
                                                'autoOpen'=>false,
                                                'modal'=>true,
                                                ),
                                        ));
$account = new Account('searchwstatus');
	  $account->unsetAttributes();  // clear any default values
	  if(isset($_GET['Account']))
		$account->attributes=$_GET['Account'];
                    $this->widget('zii.widgets.grid.CGridView', array(
                      'id'=>'unbilledgoodsacc-grid',
                      'dataProvider'=>$account->Searchwstatus(),
                      'filter'=>$account,
                      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
                      'columns'=>array(
                        array(
                          'header'=>'',
                          'type'=>'raw',
                        /* Here is The Button that will send the Data to The MAIN FORM */
                          'value'=>'CHtml::Button("V",
                          array("name" => "send_accrelation",
                          "id" => "send_accrelation",
                          "onClick" => "$(\"#unbilledgoodsacc_dialog\").dialog(\"close\"); 
						  $(\"#unbilledgoodsacccode\").val(\"$data->accountcode\"); 
						  $(\"#Productacc_accountid\").val(\"$data->accountid\");"))',
                          ),
	array('name'=>'accountid', 'visible'=>false,'value'=>'$data->accountid','htmlOptions'=>array('width'=>'1%')),
                        'accountcode',
                        ),
                    ));

                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                    echo CHtml::Button('...',
                                          array('onclick'=>'$("#unbilledgoodsacc_dialog").dialog("open"); return false;',
                                       ));?>
              <?php echo $form->error($model,'unbilledgoodsaccid'); ?>
            </div>

<?php $this->endWidget(); ?>
</div><!-- form -->

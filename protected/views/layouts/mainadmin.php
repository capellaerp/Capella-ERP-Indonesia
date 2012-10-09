<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/menu/menu_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ajaxupload.3.5.js" ></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.autoNumeric.js"></script>
<!--[if lt IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/menu/includes/ie6.css" media="screen"/>
<![endif]-->
<link rel="icon" href="images/icon.jpg" />
</head>

<body>
  <div id="container">
    <div id="header">
      <img src="images/header.jpg"></img>
    </div>
      <div class="wrapper1">
      <div class="wrapperadmin">
	<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>             array(
                array('label'=>Catalogsys::model()->GetCatalog('frontpage'), 
						'url'=>array(Menuaccess::model()->GetMenuUrl('frontpage'))),
                array('label'=>Catalogsys::model()->GetCatalog('system'),
					'visible'=>Groupmenu::model()->GetReadMenu('system'),
					'items'=>array(
				array('label'=>Catalogsys::model()->GetCatalog('citizen'),
					'visible'=>Groupmenu::model()->GetReadMenu('citizen'),
						'items'=>array(
						  array('label'=>Catalogsys::model()->GetCatalog('country') . " - " . Menuaccess::model()->GetMenuCode('country'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('country')),
							'visible'=>Groupmenu::model()->GetReadMenu('country')),
						  array('label'=>Catalogsys::model()->GetCatalog('province'). " - " . Menuaccess::model()->GetMenuCode('province'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('province')),
							'visible'=>Groupmenu::model()->GetReadMenu('province')),
						  array('label'=>Catalogsys::model()->GetCatalog('city') . " - " . Menuaccess::model()->GetMenuCode('city'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('city')),
							'visible'=>Groupmenu::model()->GetReadMenu('city')),
						  array('label'=>Catalogsys::model()->GetCatalog('subdistrict') . " - " . Menuaccess::model()->GetMenuCode('subdistrict'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('subdistrict')),
							'visible'=>Groupmenu::model()->GetReadMenu('subdistrict')),
						  array('label'=>Catalogsys::model()->GetCatalog('kelurahan') . " - " . Menuaccess::model()->GetMenuCode('kelurahan'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('kelurahan')),
							'visible'=>Groupmenu::model()->GetReadMenu('kelurahan')),
						  array('label'=>'SPT Indonesian Tax', 'url'=>array('/sptwil/index'),
							'visible'=>Groupmenu::model()->GetReadMenu('sptwil')),
												)),				 
				array('label'=>Catalogsys::model()->GetCatalog('currency') . " - " . Menuaccess::model()->GetMenuCode('currency'),
					'url'=>array(Menuaccess::model()->GetMenuUrl('currency')),
                    'visible'=>Groupmenu::model()->GetReadMenu('currency')),
				array('label'=>Catalogsys::model()->GetCatalog('company') . " - " . Menuaccess::model()->GetMenuCode('company'),
					'url'=>array(Menuaccess::model()->GetMenuUrl('company')),
                    'visible'=>Groupmenu::model()->GetReadMenu('company')),
                array('label'=>Catalogsys::model()->GetCatalog('objectauth'),
                        'visible'=>Groupmenu::model()->GetReadMenu('objectauth'),
						'items'=>array(
						  array('label'=>Catalogsys::model()->GetCatalog('useraccess') . " - " . Menuaccess::model()->GetMenuCode('useraccess'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('useraccess')),
							'visible'=>Groupmenu::model()->GetReadMenu('useraccess')),
						  array('label'=>Catalogsys::model()->GetCatalog('menuaccess') . " - " . Menuaccess::model()->GetMenuCode('menuaccess'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('menuaccess')),
							'visible'=>Groupmenu::model()->GetReadMenu('menuaccess')),
						  array('label'=>Catalogsys::model()->GetCatalog('menuauth') . " - " . Menuaccess::model()->GetMenuCode('menuauth'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('menuauth')),
							'visible'=>Groupmenu::model()->GetReadMenu('menuauth')),
						  array('label'=>Catalogsys::model()->GetCatalog('groupaccess') . " - " . Menuaccess::model()->GetMenuCode('groupaccess'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('groupaccess')),
							'visible'=>Groupmenu::model()->GetReadMenu('groupaccess')),
						  array('label'=>Catalogsys::model()->GetCatalog('usergroup') . " - " . Menuaccess::model()->GetMenuCode('usergroup'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('usergroup')),
							'visible'=>Groupmenu::model()->GetReadMenu('usergroup')),
						  array('label'=>Catalogsys::model()->GetCatalog('groupmenu') . " - " . Menuaccess::model()->GetMenuCode('groupmenu'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('groupmenu')),
							'visible'=>Groupmenu::model()->GetReadMenu('groupmenu')),
						   array('label'=>Catalogsys::model()->GetCatalog('groupmenuauth') . " - " . Menuaccess::model()->GetMenuCode('groupmenuauth'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('groupmenuauth')),
							 'visible'=>Groupmenu::model()->GetReadMenu('groupmenuauth')),
                      array('label'=>Catalogsys::model()->GetCatalog('workflow') . " - " . Menuaccess::model()->GetMenuCode('workflow'),
						'url'=>array(Menuaccess::model()->GetMenuUrl('workflow')),
                        'visible'=>Groupmenu::model()->GetReadMenu('workflow')),
                      array('label'=>Catalogsys::model()->GetCatalog('wfgroup') . " - " . Menuaccess::model()->GetMenuCode('wfgroup'), 
						'url'=>array(Menuaccess::model()->GetMenuUrl('wfgroup')),
                        'visible'=>Groupmenu::model()->GetReadMenu('wfgroup')),
                      array('label'=>Catalogsys::model()->GetCatalog('wfstatus') . " - " . Menuaccess::model()->GetMenuCode('wfstatus'), 
						'url'=>array(Menuaccess::model()->GetMenuUrl('wfstatus')),
                        'visible'=>Groupmenu::model()->GetReadMenu('wfstatus')),
						)),
                      array('label'=>Catalogsys::model()->GetCatalog('translog') . " - " . Menuaccess::model()->GetMenuCode('translog'), 
						'url'=>array(Menuaccess::model()->GetMenuUrl('translog')),
                        'visible'=>Groupmenu::model()->GetReadMenu('translog')),
                      array('label'=>Catalogsys::model()->GetCatalog('translock') . " - " . Menuaccess::model()->GetMenuCode('translock'),  
						'url'=>array(Menuaccess::model()->GetMenuUrl('translock')),
                        'visible'=>Groupmenu::model()->GetReadMenu('translock')),
                      array('label'=>Catalogsys::model()->GetCatalog('snro') . " - " . Menuaccess::model()->GetMenuCode('snro'),  
						'url'=>array(Menuaccess::model()->GetMenuUrl('snro')),
                        'visible'=>Groupmenu::model()->GetReadMenu('snro')),
                      array('label'=>Catalogsys::model()->GetCatalog('snrodet') . " - " . Menuaccess::model()->GetMenuCode('snrodet'),  
						'url'=>array(Menuaccess::model()->GetMenuUrl('snrodet')),
                        'visible'=>Groupmenu::model()->GetReadMenu('snrodet')),
                      array('label'=>Catalogsys::model()->GetCatalog('parameter') . " - " . Menuaccess::model()->GetMenuCode('parameter'),   
						'url'=>array(Menuaccess::model()->GetMenuUrl('parameter')),
                        'visible'=>Groupmenu::model()->GetReadMenu('parameter')),
                      array('label'=>Catalogsys::model()->GetCatalog('language') . " - " . Menuaccess::model()->GetMenuCode('language'),   
						'url'=>array(Menuaccess::model()->GetMenuUrl('language')),
                        'visible'=>Groupmenu::model()->GetReadMenu('language')),
					  array('label'=>Catalogsys::model()->GetCatalog('catalogsys') . " - " . Menuaccess::model()->GetMenuCode('catalogsys'),   
						'url'=>array(Menuaccess::model()->GetMenuUrl('catalogsys')),
						'visible'=>Groupmenu::model()->GetReadMenu('catalogsys')),
                  )
                ),
				array('label'=>Catalogsys::model()->GetCatalog('common'),
				  'visible'=>Groupmenu::model()->GetReadMenu('common'),
                  'items'=>array(					
						  array('label'=>Catalogsys::model()->GetCatalog('addresstype') . " - " . Menuaccess::model()->GetMenuCode('addresstype'),   
							'url'=>array(Menuaccess::model()->GetMenuUrl('addresstype')),
							'visible'=>Groupmenu::model()->GetReadMenu('addresstype')),
						  array('label'=>Catalogsys::model()->GetCatalog('contacttype') . " - " . Menuaccess::model()->GetMenuCode('contacttype'),   
							'url'=>array(Menuaccess::model()->GetMenuUrl('contacttype')),
							'visible'=>Groupmenu::model()->GetReadMenu('contacttype')),
						  array('label'=>Catalogsys::model()->GetCatalog('identitytype') . " - " . Menuaccess::model()->GetMenuCode('identitytype'),   
							'url'=>array(Menuaccess::model()->GetMenuUrl('identitytype')),
							'visible'=>Groupmenu::model()->GetReadMenu('identitytype')),
						  array('label'=>Catalogsys::model()->GetCatalog('romawi') . " - " . Menuaccess::model()->GetMenuCode('romawi'),   
							'url'=>array(Menuaccess::model()->GetMenuUrl('romawi')),
							'visible'=>Groupmenu::model()->GetReadMenu('romawi')),
						  array('label'=>Catalogsys::model()->GetCatalog('industry') . " - " . Menuaccess::model()->GetMenuCode('industry'),   
							'url'=>array(Menuaccess::model()->GetMenuUrl('industry')),
							'visible'=>Groupmenu::model()->GetReadMenu('industry')),
						  array('label'=>Catalogsys::model()->GetCatalog('plant') . " - " . Menuaccess::model()->GetMenuCode('plant'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('plant')),
							'visible'=>Groupmenu::model()->GetReadMenu('plant')),
					array('label'=>Catalogsys::model()->GetCatalog('sloc') . " - " . Menuaccess::model()->GetMenuCode('sloc'),  
						'url'=>array(Menuaccess::model()->GetMenuUrl('sloc')),
                        'visible'=>Groupmenu::model()->GetReadMenu('sloc')),
                    array('label'=>Catalogsys::model()->GetCatalog('unitofmeasure') . " - " . Menuaccess::model()->GetMenuCode('unitofmeasure'),  
						'url'=>array(Menuaccess::model()->GetMenuUrl('unitofmeasure')),
                        'visible'=>Groupmenu::model()->GetReadMenu('unitofmeasure')),
						  array('label'=>Catalogsys::model()->GetCatalog('addressbook') . " - " . Menuaccess::model()->GetMenuCode('addressbook'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('addressbook')),
							'visible'=>Groupmenu::model()->GetReadMenu('addressbook')),
						array('label'=>Catalogsys::model()->GetCatalog('customer') . " - " . Menuaccess::model()->GetMenuCode('customer'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('customer')),
							'visible'=>Groupmenu::model()->GetReadMenu('customer')),
							array('label'=>Catalogsys::model()->GetCatalog('supplier') . " - " . Menuaccess::model()->GetMenuCode('supplier'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('supplier')),
									'visible'=>Groupmenu::model()->GetReadMenu('supplier')),
						  array('label'=>Catalogsys::model()->GetCatalog('bank') . " - " . Menuaccess::model()->GetMenuCode('bank'), 
							'visible'=>Groupmenu::model()->GetReadMenu('bank'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('bank'))
							),
						  array('label'=>Catalogsys::model()->GetCatalog('insurance') . " - " . Menuaccess::model()->GetMenuCode('insurance'), 
							'visible'=>Groupmenu::model()->GetReadMenu('insurance'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('insurance'))
							),
                  )
                ),
				array('label'=>Catalogsys::model()->GetCatalog('acc'), 
					'visible'=>Groupmenu::model()->GetReadMenu('acc'),
					'items'=>array(
						array('label'=>Catalogsys::model()->GetCatalog('paymentmethod') . " - " . Menuaccess::model()->GetMenuCode('paymentmethod'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('paymentmethod')),
							'visible'=>Groupmenu::model()->GetReadMenu('paymentmethod')),
						array('label'=>Catalogsys::model()->GetCatalog('tax') . " - " . Menuaccess::model()->GetMenuCode('tax'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('tax')),
							'visible'=>Groupmenu::model()->GetReadMenu('tax')),
						array('label'=>Catalogsys::model()->GetCatalog('accperiod') . " - " . Menuaccess::model()->GetMenuCode('accperiod'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('accperiod')),
							'visible'=>Groupmenu::model()->GetReadMenu('accperiod')),
						array('label'=>Catalogsys::model()->GetCatalog('accounttype') . " - " . Menuaccess::model()->GetMenuCode('accounttype'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('accounttype')),
							'visible'=>Groupmenu::model()->GetReadMenu('accounttype')),
						array('label'=>Catalogsys::model()->GetCatalog('account') . " - " . Menuaccess::model()->GetMenuCode('account'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('account')),
							'visible'=>Groupmenu::model()->GetReadMenu('account')),
						array('label'=>Catalogsys::model()->GetCatalog('genjournal') . " - " . Menuaccess::model()->GetMenuCode('genjournal'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('genjournal')),
							'visible'=>Groupmenu::model()->GetReadMenu('genjournal')),
						array('label'=>Catalogsys::model()->GetCatalog('invoice') . " - " . Menuaccess::model()->GetMenuCode('invoice'), 
							'visible'=>Groupmenu::model()->GetReadMenu('invoice'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('invap') . " - " . Menuaccess::model()->GetMenuCode('invap'), 
									'visible'=>Groupmenu::model()->GetReadMenu('invap'),
									'items'=>array(
										array('label'=>Catalogsys::model()->GetCatalog('invoiceap') . " - " . Menuaccess::model()->GetMenuCode('invoiceap'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('invoiceap')),
											'visible'=>Groupmenu::model()->GetReadMenu('invoiceap')),
										array('label'=>Catalogsys::model()->GetCatalog('repinvoiceap') . " - " . Menuaccess::model()->GetMenuCode('repinvoiceap'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('repinvoiceap')),
											'visible'=>Groupmenu::model()->GetReadMenu('repinvoiceap')),
									)
								),
								array('label'=>Catalogsys::model()->GetCatalog('invar') . " - " . Menuaccess::model()->GetMenuCode('invar'), 
									'visible'=>Groupmenu::model()->GetReadMenu('invar'),
									'items'=>array(
										array('label'=>Catalogsys::model()->GetCatalog('invoicear') . " - " . Menuaccess::model()->GetMenuCode('invoicear'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('invoicear')),
											'visible'=>Groupmenu::model()->GetReadMenu('invoicear')),
										array('label'=>Catalogsys::model()->GetCatalog('repinvoicear') . " - " . Menuaccess::model()->GetMenuCode('repinvoicear'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('repinvoicear')),
											'visible'=>Groupmenu::model()->GetReadMenu('repinvoicear')),
										array('label'=>Catalogsys::model()->GetCatalog('fakturpajak') . " - " . Menuaccess::model()->GetMenuCode('fakturpajak'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('fakturpajak')),
											'visible'=>Groupmenu::model()->GetReadMenu('fakturpajak')),
									)
								),
							)
						),
						array('label'=>Catalogsys::model()->GetCatalog('cashbank') . " - " . Menuaccess::model()->GetMenuCode('cashbank'), 
							'visible'=>Groupmenu::model()->GetReadMenu('cashbank'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('cashbankin') . " - " . Menuaccess::model()->GetMenuCode('cashbankin'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('cashbankin')),
									'visible'=>Groupmenu::model()->GetReadMenu('cashbankin')),
								array('label'=>Catalogsys::model()->GetCatalog('repcashbankin') . " - " . Menuaccess::model()->GetMenuCode('repcashbankin'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('repcashbankin')),
									'visible'=>Groupmenu::model()->GetReadMenu('repcashbankin')),
								array('label'=>Catalogsys::model()->GetCatalog('cashbankout') . " - " . Menuaccess::model()->GetMenuCode('cashbankout'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('cashbankout')),
									'visible'=>Groupmenu::model()->GetReadMenu('cashbankout')),
								array('label'=>Catalogsys::model()->GetCatalog('repcashbankout') . " - " . Menuaccess::model()->GetMenuCode('repcashbankout'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('repcashbankout')),
									'visible'=>Groupmenu::model()->GetReadMenu('repcashbankout')),
							)
						),
						array('label'=>Catalogsys::model()->GetCatalog('repacc') . " - " . Menuaccess::model()->GetMenuCode('repacc'), 
							'visible'=>Groupmenu::model()->GetReadMenu('repacc'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('repgenjournal') . " - " . Menuaccess::model()->GetMenuCode('repgenjournal'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('repgenjournal')),
									'visible'=>Groupmenu::model()->GetReadMenu('repgenjournal')),
								array('label'=>Catalogsys::model()->GetCatalog('genledger') . " - " . Menuaccess::model()->GetMenuCode('genledger'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('genledger')),
									'visible'=>Groupmenu::model()->GetReadMenu('genledger')),
								array('label'=>Catalogsys::model()->GetCatalog('repprofitloss') . " - " . Menuaccess::model()->GetMenuCode('repprofitloss'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('repprofitloss')),
									'visible'=>Groupmenu::model()->GetReadMenu('repprofitloss')),
								array('label'=>Catalogsys::model()->GetCatalog('repneraca') . " - " . Menuaccess::model()->GetMenuCode('repneraca'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('repneraca')),
									'visible'=>Groupmenu::model()->GetReadMenu('repneraca')),
							)),
				)),
				array('label'=>Catalogsys::model()->GetCatalog('hr'),
					'visible'=>Groupmenu::model()->GetReadMenu('hr'),
					'items'=>array(
                        array('label'=>Catalogsys::model()->GetCatalog('om'), 
                            'visible'=>Groupmenu::model()->GetReadMenu('om'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('position') . " - " . Menuaccess::model()->GetMenuCode('position'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('position')),
									'visible'=>Groupmenu::model()->GetReadMenu('position')),
								array('label'=>Catalogsys::model()->GetCatalog('levelorg') . " - " . Menuaccess::model()->GetMenuCode('levelorg'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('levelorg')),
									'visible'=>Groupmenu::model()->GetReadMenu('levelorg')),
								array('label'=>Catalogsys::model()->GetCatalog('orgstructure') . " - " . Menuaccess::model()->GetMenuCode('orgstructure'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('orgstructure')),
									'visible'=>Groupmenu::model()->GetReadMenu('orgstructure')),
								array('label'=>Catalogsys::model()->GetCatalog('jobs') . " - " . Menuaccess::model()->GetMenuCode('jobs'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('jobs')),
									'visible'=>Groupmenu::model()->GetReadMenu('jobs')),
						)),
						array('label'=>Catalogsys::model()->GetCatalog('prs'), 
                            'visible'=>Groupmenu::model()->GetReadMenu('prs'),
							'items'=>array(
							 array('label'=>Catalogsys::model()->GetCatalog('mp'), 
								'visible'=>Groupmenu::model()->GetReadMenu('mp'),
								'items'=>array(
									array('label'=>Catalogsys::model()->GetCatalog('familyrelation') . " - " . Menuaccess::model()->GetMenuCode('familyrelation'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('familyrelation')),
										'visible'=>Groupmenu::model()->GetReadMenu('familyrelation')),
									array('label'=>Catalogsys::model()->GetCatalog('occupation') . " - " . Menuaccess::model()->GetMenuCode('occupation'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('occupation')),
										'visible'=>Groupmenu::model()->GetReadMenu('occupation')),
									array('label'=>Catalogsys::model()->GetCatalog('sex') . " - " . Menuaccess::model()->GetMenuCode('sex'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('sex')),
										'visible'=>Groupmenu::model()->GetReadMenu('sex')),
									array('label'=>Catalogsys::model()->GetCatalog('religion') . " - " . Menuaccess::model()->GetMenuCode('religion'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('religion')),
										'visible'=>Groupmenu::model()->GetReadMenu('religion')),
									array('label'=>Catalogsys::model()->GetCatalog('education') . " - " . Menuaccess::model()->GetMenuCode('education'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('education')),
										'visible'=>Groupmenu::model()->GetReadMenu('education')),
									array('label'=>Catalogsys::model()->GetCatalog('educationmajor') . " - " . Menuaccess::model()->GetMenuCode('educationmajor'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('educationmajor')),
										'visible'=>Groupmenu::model()->GetReadMenu('educationmajor')),
									array('label'=>Catalogsys::model()->GetCatalog('maritalstatus') . " - " . Menuaccess::model()->GetMenuCode('maritalstatus'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('maritalstatus')),
										'visible'=>Groupmenu::model()->GetReadMenu('maritalstatus')),
									array('label'=>Catalogsys::model()->GetCatalog('employeetype') . " - " . Menuaccess::model()->GetMenuCode('employeetype'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('employeetype')),
										'visible'=>Groupmenu::model()->GetReadMenu('employeetype')),
									array('label'=>Catalogsys::model()->GetCatalog('languagevalue') . " - " . Menuaccess::model()->GetMenuCode('languagevalue'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('languagevalue')),
										'visible'=>Groupmenu::model()->GetReadMenu('languagevalue')),
							)),
							array('label'=>Catalogsys::model()->GetCatalog('employee') . " - " . Menuaccess::model()->GetMenuCode('employee'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('employee')),
									'visible'=>Groupmenu::model()->GetReadMenu('employee')),
							array('label'=>Catalogsys::model()->GetCatalog('hrsp'), 
									'visible'=>Groupmenu::model()->GetReadMenu('hrsp'),
									'items'=>array(
										array('label'=>Catalogsys::model()->GetCatalog('splettertype') . " - " . Menuaccess::model()->GetMenuCode('splettertype'), 
											'url'=>array(Menuaccess::model()->GetMenuUrl('splettertype')),
											'visible'=>Groupmenu::model()->GetReadMenu('splettertype')),
							)),
						)),
						array('label'=>Catalogsys::model()->GetCatalog('hrtm'), 
								'visible'=>Groupmenu::model()->GetReadMenu('hrtm'),
								'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('hrtm'), 
										'visible'=>Groupmenu::model()->GetReadMenu('hrtm'),
										'items'=>array(
									array('label'=>Catalogsys::model()->GetCatalog('absstatus') . " - " . Menuaccess::model()->GetMenuCode('absstatus'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('absstatus')),
										'visible'=>Groupmenu::model()->GetReadMenu('absstatus')),
									array('label'=>Catalogsys::model()->GetCatalog('absschedule') . " - " . Menuaccess::model()->GetMenuCode('absschedule'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('absschedule')),
										'visible'=>Groupmenu::model()->GetReadMenu('absschedule')),
									array('label'=>Catalogsys::model()->GetCatalog('absrule') . " - " . Menuaccess::model()->GetMenuCode('absrule'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('absrule')),
										'visible'=>Groupmenu::model()->GetReadMenu('absrule')),
									array('label'=>Catalogsys::model()->GetCatalog('employeeschedule') . " - " . Menuaccess::model()->GetMenuCode('employeeschedule'), 
										'url'=>array(Menuaccess::model()->GetMenuUrl('employeeschedule')),
										'visible'=>Groupmenu::model()->GetReadMenu('employeeschedule')),
								)),
								array('label'=>Catalogsys::model()->GetCatalog('permitexit'), 
										'visible'=>Groupmenu::model()->GetReadMenu('permitexit'),
										'items'=>array(
											array('label'=>Catalogsys::model()->GetCatalog('permitexit') . " - " . Menuaccess::model()->GetMenuCode('permitexit'), 
												'url'=>array(Menuaccess::model()->GetMenuUrl('permitexit')),
												'visible'=>Groupmenu::model()->GetReadMenu('permitexit')),
								)),
								array('label'=>Catalogsys::model()->GetCatalog('hrp'), 
										'visible'=>Groupmenu::model()->GetReadMenu('hrp'),
										'items'=>array(
											array('label'=>Catalogsys::model()->GetCatalog('permitin') . " - " . Menuaccess::model()->GetMenuCode('permitin'), 
												'url'=>array(Menuaccess::model()->GetMenuUrl('permitin')),
												'visible'=>Groupmenu::model()->GetReadMenu('permitin')),
								)),
								array('label'=>Catalogsys::model()->GetCatalog('hrs'), 
										'visible'=>Groupmenu::model()->GetReadMenu('hrs'),
										'items'=>array(
											array('label'=>Catalogsys::model()->GetCatalog('hospital') . " - " . Menuaccess::model()->GetMenuCode('hospital'), 
												'url'=>array(Menuaccess::model()->GetMenuUrl('hospital')),
												'visible'=>Groupmenu::model()->GetReadMenu('hospital')),
								)),
								array('label'=>Catalogsys::model()->GetCatalog('hro'), 
										'visible'=>Groupmenu::model()->GetReadMenu('hro'),
										'items'=>array(
											array('label'=>Catalogsys::model()->GetCatalog('onleavetype') . " - " . Menuaccess::model()->GetMenuCode('onleavetype'), 
												'url'=>array(Menuaccess::model()->GetMenuUrl('onleavetype')),
												'visible'=>Groupmenu::model()->GetReadMenu('onleavetype')),
								)),
						)),
						array('label'=>Catalogsys::model()->GetCatalog('hrft'), 
							'visible'=>Groupmenu::model()->GetReadMenu('hrft'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('facilitytype') . " - " . Menuaccess::model()->GetMenuCode('facilitytype'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('facilitytype')),
									'visible'=>Groupmenu::model()->GetReadMenu('facilitytype')),
						)),
						array('label'=>Catalogsys::model()->GetCatalog('hrpy'), 
							'visible'=>Groupmenu::model()->GetReadMenu('hrpy'),
							'items'=>array(
								array('label'=>Catalogsys::model()->GetCatalog('benefittype') . " - " . Menuaccess::model()->GetMenuCode('benefittype'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('benefittype')),
									'visible'=>Groupmenu::model()->GetReadMenu('benefittype')),
								array('label'=>Catalogsys::model()->GetCatalog('employeestatus') . " - " . Menuaccess::model()->GetMenuCode('employeestatus'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('employeestatus')),
									'visible'=>Groupmenu::model()->GetReadMenu('employeestatus')),
						)),
					)
				),
				array('label'=>'Purchasing','visible'=>Groupmenu::model()->GetReadMenu('purchasing'),
                  'items'=>array(
                        array('label'=>Catalogsys::model()->GetCatalog('purchasingorg') . " - " . Menuaccess::model()->GetMenuCode('purchasingorg'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('purchasingorg')),
                            'visible'=>Groupmenu::model()->GetReadMenu('purchasingorg')),
                        array('label'=>Catalogsys::model()->GetCatalog('purchasinggroup') . " - " . Menuaccess::model()->GetMenuCode('purchasinggroup'), 
							'url'=>array(Menuaccess::model()->GetMenuUrl('purchasinggroup')),
                            'visible'=>Groupmenu::model()->GetReadMenu('purchasinggroup')),
						array('label'=>Catalogsys::model()->GetCatalog('materialmaster'),
							'visible'=>Groupmenu::model()->GetReadMenu('materialmaster'),
                            'items'=>array(
                              array('label'=>Catalogsys::model()->GetCatalog('materialtype') . " - " . Menuaccess::model()->GetMenuCode('materialtype'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('materialtype')),
                                'visible'=>Groupmenu::model()->GetReadMenu('materialtype')),
                              array('label'=>Catalogsys::model()->GetCatalog('materialgroup') . " - " . Menuaccess::model()->GetMenuCode('materialgroup'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('materialgroup')),
                                'visible'=>Groupmenu::model()->GetReadMenu('materialgroup')),
                               array('label'=>Catalogsys::model()->GetCatalog('materialstatus') . " - " . Menuaccess::model()->GetMenuCode('materialstatus'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('materialstatus')),
                                'visible'=>Groupmenu::model()->GetReadMenu('materialstatus')),
                              array('label'=>Catalogsys::model()->GetCatalog('ownership') . " - " . Menuaccess::model()->GetMenuCode('ownership'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('ownership')),
                                'visible'=>Groupmenu::model()->GetReadMenu('ownership')),
                                  array('label'=>Catalogsys::model()->GetCatalog('product') . " - " . Menuaccess::model()->GetMenuCode('product'), 
									'url'=>array(Menuaccess::model()->GetMenuUrl('product')),
                                    'visible'=>Groupmenu::model()->GetReadMenu('product')),
                            )
                          ),
						  	 array('label'=>Catalogsys::model()->GetCatalog('purchinforec') . " - " . Menuaccess::model()->GetMenuCode('purchinforec'),
								'visible'=>Groupmenu::model()->GetReadMenu('purchinforec'),
                                'url'=>array(Menuaccess::model()->GetMenuUrl('purchinforec'))),
							array('label'=>Catalogsys::model()->GetCatalog('po') . " - " . Menuaccess::model()->GetMenuCode('poheader'),
								'visible'=>Groupmenu::model()->GetReadMenu('po'),
								'items'=>array(
									array('label'=>Catalogsys::model()->GetCatalog('poheader') . " - " . Menuaccess::model()->GetMenuCode('poheader'),
										'visible'=>Groupmenu::model()->GetReadMenu('poheader'),
										'url'=>array(Menuaccess::model()->GetMenuUrl('poheader'))),
									array('label'=>Catalogsys::model()->GetCatalog('reportpo') . " - " . Menuaccess::model()->GetMenuCode('reportpo'),
										'visible'=>Groupmenu::model()->GetReadMenu('reportpo'),
										'url'=>array(Menuaccess::model()->GetMenuUrl('reportpo'))),
								)
							)

					)
				),
				array('label'=>Catalogsys::model()->GetCatalog('inventory'),
					'visible'=>Groupmenu::model()->GetReadMenu('inventory'),
					'items'=>array(
                    array('label'=>Catalogsys::model()->GetCatalog('requestedby') . " - " . Menuaccess::model()->GetMenuCode('requestedby'),   
						'url'=>array(Menuaccess::model()->GetMenuUrl('requestedby')),
                        'visible'=>Groupmenu::model()->GetReadMenu('requestedby')),
                    array('label'=>Catalogsys::model()->GetCatalog('da') . " - " . Menuaccess::model()->GetMenuCode('da'),
                        'visible'=>Groupmenu::model()->GetReadMenu('da'),
						'items'=> array(
							array('label'=>Catalogsys::model()->GetCatalog('deliveryadvice') . " - " . Menuaccess::model()->GetMenuCode('deliveryadvice'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('deliveryadvice')),
								'visible'=>Groupmenu::model()->GetReadMenu('deliveryadvice')),
							array('label'=>Catalogsys::model()->GetCatalog('reportda') . " - " . Menuaccess::model()->GetMenuCode('reportda'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('reportda')),
								'visible'=>Groupmenu::model()->GetReadMenu('reportda')),
						)
					),
					array('label'=>Catalogsys::model()->GetCatalog('pr') . " - " . Menuaccess::model()->GetMenuCode('pr'),
                        'visible'=>Groupmenu::model()->GetReadMenu('pr'),
						'items'=> array(
							array('label'=>Catalogsys::model()->GetCatalog('prheader') . " - " . Menuaccess::model()->GetMenuCode('prheader'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('prheader')),
								'visible'=>Groupmenu::model()->GetReadMenu('prheader')),
							array('label'=>Catalogsys::model()->GetCatalog('reportpr') . " - " . Menuaccess::model()->GetMenuCode('reportpr'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('reportpr')),
								'visible'=>Groupmenu::model()->GetReadMenu('reportpr')),
						)
					),
					array('label'=>Catalogsys::model()->GetCatalog('gr') . " - " . Menuaccess::model()->GetMenuCode('gr'),
                        'visible'=>Groupmenu::model()->GetReadMenu('gr'),
						'items'=> array(
							array('label'=>Catalogsys::model()->GetCatalog('grheader') . " - " . Menuaccess::model()->GetMenuCode('grheader'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('grheader')),
								'visible'=>Groupmenu::model()->GetReadMenu('grheader')),
							array('label'=>Catalogsys::model()->GetCatalog('reportgr') . " - " . Menuaccess::model()->GetMenuCode('reportgr'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('reportgr')),
								'visible'=>Groupmenu::model()->GetReadMenu('reportgr')),
						)
					),
					array('label'=>Catalogsys::model()->GetCatalog('gi') . " - " . Menuaccess::model()->GetMenuCode('gi'),
                        'visible'=>Groupmenu::model()->GetReadMenu('gi'),
						'items'=> array(
							array('label'=>Catalogsys::model()->GetCatalog('giheader') . " - " . Menuaccess::model()->GetMenuCode('giheader'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('giheader')),
								'visible'=>Groupmenu::model()->GetReadMenu('giheader')),
							array('label'=>Catalogsys::model()->GetCatalog('reportgi') . " - " . Menuaccess::model()->GetMenuCode('reportgi'),
								'url'=>array(Menuaccess::model()->GetMenuUrl('reportgi')),
								'visible'=>Groupmenu::model()->GetReadMenu('reportgi')),
						)
					),
					array('label'=>Catalogsys::model()->GetCatalog('productdetail') . " - " . Menuaccess::model()->GetMenuCode('productdetail'),
						'url'=>array(Menuaccess::model()->GetMenuUrl('productdetail')),
						'visible'=>Groupmenu::model()->GetReadMenu('productdetail')),
					array('label'=>Catalogsys::model()->GetCatalog('productstock') . " - " . Menuaccess::model()->GetMenuCode('productstock'),
						'url'=>array(Menuaccess::model()->GetMenuUrl('productstock')),
						'visible'=>Groupmenu::model()->GetReadMenu('productstock')),
				  )
				),
				array('label'=>Catalogsys::model()->GetCatalog('sales'),
					'visible'=>Groupmenu::model()->GetReadMenu('sales'),
					'items'=>array(
						array('label'=>Catalogsys::model()->GetCatalog('soheader'),
							'visible'=>Groupmenu::model()->GetReadMenu('soheader'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('soheader')),
						),
						array('label'=>Catalogsys::model()->GetCatalog('reportso'),
							'visible'=>Groupmenu::model()->GetReadMenu('reportso'),
							'url'=>array(Menuaccess::model()->GetMenuUrl('reportso')),
						)
					)
				)
				  )));
				  ?>
		<br><br>
	 </div>
	 <div id="breadcrumb">
<span>Path :</span><?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
		<?php 
	   if(Yii::app()->user->isGuest) 
	   {
			$this->widget('Userlogin'); 
		}   
	   ?>    <div id="userlogout">User: <?php echo Yii::app()->user->name ?> <?php if (!Yii::app()->user->isGuest) { echo '| '.CHtml::link('Logout', 'index.php?r=site/logout'); }?> </div>
	<?php endif?>	
	</div>  
	<div id="content">
        <?php echo $content; ?>
		<div id="footpanel"> <ul id="mainpanel">
<li>
    <form class="formclass" name="input" action="<?php echo $this->createurl('menuaccess/MenuCodeClick'); ?>" method="post"> 
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'menucode',
	'source'=>$this->createUrl('menuaccess/autocomplete'),
	// additional javascript options for the autocomplete plugin
	'options'=>array(
			'showAnim'=>'fold',
'position'=>array('my'=>'left bottom','at'=>'left bottom','of'=>'#footpanel')
	),
'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),));
?> <input type="submit" value="Submit" /></form></li>
        <li><div id="messages"></div></li>
	  </div>
	</div>
	</div>
</div>
  </div>
</body>
</html>

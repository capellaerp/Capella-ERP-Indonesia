<?php
//require_once("../phpgrid/conf.php");

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Prisma Data Abadi - Your Total IT Solution',

	// preloading 'log' component
	'preload'=>array('log',
		'bootstrap'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.controllers.*',
		'application.components.*',
		'ext.fpdf.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
	  'gii'=>array(
		'class'=>'system.gii.GiiModule',
		'generatorPaths'=>array(
			//'ext.giix-core'
			'bootstrap.gii'
      ),
		'password'=>'123456',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
		'ipFilters'=>array('127.0.0.1','::1'),
	  ),
	),
	// application components
	'components'=>array(
		'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
		'session'=>array(
			'class' => 'system.web.CDbHttpSession',
			'connectionID' => 'db',
			'autoStart' => true
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=prism728_erp',
			'emulatePrepare' => true,
			'username' => 'prism728_erp',
			'password' => 'n0b1t4s4n',
			'charset' => 'utf8',
			'initSQLs'=>array('set names utf8'),
			//'enableProfiling'=>true,
			'enableParamLogging' => true,
			'schemaCachingDuration' => 3600,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
	//    'log'=>array(
	//        'class'=>'CLogRouter',
	//        'routes'=>array(
	//            array(
	//                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
	//                'ipFilters'=>array('127.0.0.1'),
	//            ),
	//        ),
	//    ),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap'
		)
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'siskalandre@yahoo.com',
		'defaultPageSize'=>5,
		'defaultYearFrom'=>date('Y')-1,
		'defaultYearTo'=>date('Y'),
		'sizeLimit'=>1*1024*1024,
		'defaultnumberqty'=>'#,##0.00',
		'defaultnumberprice'=>'#,##0.00',
        'dateviewfromdb'=>'d-m-Y',
        'dateviewcjui'=>'dd-mm-yy',
        'dateviewgrid'=>'dd-MM-yyyy',
        'datetodb'=>'Y-m-d'
	),
);



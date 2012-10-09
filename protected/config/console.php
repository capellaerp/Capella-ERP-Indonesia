<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'My Console Application',

        'import'=>array(
                'application.models.*',
                'application.extensions.*',
        ),

        // application components
        'components'=>array(
                'db'=>array(
		'connectionString' => 'mysql:host=localhost;dbname=smdev',
		'emulatePrepare' => true,
		'username' => 'smdev',
		'password' => 'smdev',
		'charset' => 'utf8',
		'initSQLs'=>array('set names utf8'),
		//'enableProfiling'=>true,
	'enableParamLogging' => true,
	'schemaCachingDuration' => 3600,
	),
            'db1'=>array(
		'connectionString' => 'mysql:host=10.10.10.5;dbname=hr',
                'class'=>'CDbConnection',
		'emulatePrepare' => true,
		'username' => 'erp',
		'password' => 'erp',
		'charset' => 'utf8',
		'initSQLs'=>array('set names utf8'),
		//'enableProfiling'=>true,
	'enableParamLogging' => true,
	'schemaCachingDuration' => 3600,
	),
                // usefull for generating links in email etc...
                'urlManager'=>array(
                        'urlFormat'=>'path',
                        'showScriptName' => FALSE,
                        'rules'=>array(),
                ),
        ),
);
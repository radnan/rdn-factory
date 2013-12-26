<?php

return array(
	'controllers' => array(
		'invokables' => array(
			'RdnFactory:Index' => 'RdnFactory\Controller\Index',
		),
	),

	'rdn_factory_plugins' => array(
		'aliases' => array(
			'Config' => 'RdnFactory:Config',
			'Controller' => 'RdnFactory:Controller',
			'Form' => 'RdnFactory:Form',
			'Params' => 'RdnFactory:Params',
			'Service' => 'RdnFactory:Service',
			'Url' => 'RdnFactory:Url',
		),

		'invokables' => array(
			'RdnFactory:Config' => 'RdnFactory\Plugin\Config',
			'RdnFactory:Controller' => 'RdnFactory\Plugin\Controller',
			'RdnFactory:Form' => 'RdnFactory\Plugin\Form',
			'RdnFactory:Params' => 'RdnFactory\Plugin\Params',
			'RdnFactory:Service' => 'RdnFactory\Plugin\Service',
			'RdnFactory:Url' => 'RdnFactory\Plugin\Url',
		),
	),

	'service_manager' => array(
		'factories' => array(
			'RdnFactory\Plugin\PluginManager' => 'RdnFactory\Factory\Plugin\PluginManager',
		),
	),
);

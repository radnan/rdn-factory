<?php

namespace RdnFactory\Factory\Plugin;

use RdnFactory\Plugin;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PluginManager implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $services
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $services)
	{
		$config = $services->get('Config');
		$config = new Config($config['rdn_factory_plugins']);

		$plugins = new Plugin\PluginManager($config);
		$plugins->setServiceLocator($services);

		return $plugins;
	}
}

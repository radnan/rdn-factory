<?php

namespace RdnFactory;

use RdnFactory\Plugin\PluginManager;
use Zend\ServiceManager;

interface FactoryInterface extends ServiceManager\FactoryInterface
{
	public function setPlugins(PluginManager $plugins);

	/**
	 * @return PluginManager
	 */
	public function getPlugins();
}

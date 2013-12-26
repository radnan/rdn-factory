<?php

namespace RdnFactory\Plugin;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

class PluginManager extends AbstractPluginManager
{
	/**
	 * Validate the plugin
	 *
	 * Checks that the plugin loaded is an instance of PluginInterface.
	 *
	 * @param  mixed $plugin
	 * @return void
	 * @throws Exception\RuntimeException if invalid
	 */
	public function validatePlugin($plugin)
	{
		if ($plugin instanceof PluginInterface)
		{
			return;
		}

		throw new Exception\RuntimeException(sprintf(
			'Plugin of type %s is invalid; must implement %s\PluginInterface'
			, is_object($plugin) ? get_class($plugin) : gettype($plugin)
			, __NAMESPACE__
		));
	}
}

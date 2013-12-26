<?php

namespace RdnFactory\Plugin;

use Zend\ServiceManager\ServiceLocatorAwareInterface;

class Service extends AbstractPlugin
{
	/**
	 * Get a service by the given name.
	 *
	 * @param string $name
	 *
	 * @return mixed
	 * @throws \RuntimeException if service locator not set
	 */
	public function __invoke($name)
	{
		$services = $this->factory->getPlugins();

		while ($services instanceof ServiceLocatorAwareInterface)
		{
			$services = $services->getServiceLocator();
		}

		return $services->get($name);
	}
}

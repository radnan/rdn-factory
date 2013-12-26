<?php

namespace RdnFactory;

use RdnFactory\Plugin\PluginInterface;
use RdnFactory\Plugin\PluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Make it is easy to create factory classes. Contains helper methods for frequently used services.
 *
 * @method mixed config(\string $name = null)
 * @method \Zend\Stdlib\DispatchableInterface controller(\string $name)
 * @method \Zend\Form\ElementInterface form(\string $name)
 * @method mixed params(\string $name, mixed $default = null)
 * @method mixed service(\string $name)
 * @method \string url(\string $name = null, $params = array(), $options = array(), $reuseMatchedParams = false)
 */
abstract class AbstractFactory implements FactoryInterface
{
	/**
	 * @var PluginManager
	 */
	protected $plugins;

	/**
	 * Create service
	 *
	 * @return mixed
	 */
	abstract protected function create();

	/**
	 * Overwrite the FactoryInterface method to enable internal helpers.
	 *
	 * @param ServiceLocatorInterface $services
	 *
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $services)
	{
		$this->setServiceLocator($services);
		return $this->create();
	}

	public function setServiceLocator(ServiceLocatorInterface $services)
	{
		while ($services instanceof ServiceLocatorAwareInterface)
		{
			$services = $services->getServiceLocator();
		}

		$this->setPlugins($services->get('RdnFactory\Plugin\PluginManager'));
	}

	public function setPlugins(PluginManager $plugins)
	{
		$this->plugins = $plugins;
	}

	public function getPlugins()
	{
		return $this->plugins;
	}

	public function __call($name, $args = array())
	{
		if (!$this->plugins instanceof ServiceLocatorInterface)
		{
			throw new \RuntimeException('No service locator set for factory. Set the service locator using the setServiceLocator() method first.');
		}

		/** @var PluginInterface $plugin */
		$plugin = $this->plugins->get($name);
		$plugin->setFactory($this);

		if (is_callable($plugin))
		{
			return call_user_func_array($plugin, $args);
		}

		return $plugin;
	}

	/**
	 * Prefix a service name with the current module name, if one is not already set.
	 *
	 * @param $name
	 *
	 * @return string
	 */
	protected function prefixModule($name)
	{
		if (strpos($name, ':') === false)
		{
			$name = $this->getModuleName() .':'. $name;
		}
		return $name;
	}

	/**
	 * Get name of module current class belongs to.
	 *
	 * @return string
	 */
	protected function getModuleName()
	{
		return strstr(get_class($this), '\\', true);
	}
}

<?php

namespace RdnFactory\Plugin;

use Zend\Stdlib\DispatchableInterface;

class Controller extends AbstractPlugin
{
	/**
	 * Get a controller with the given name.
	 *
	 * @param string $name
	 *
	 * @return DispatchableInterface
	 */
	public function __invoke($name)
	{
		return $this->factory->service('ControllerLoader')->get($name);
	}
}

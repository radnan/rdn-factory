<?php

namespace RdnFactory\Plugin;

use Zend\Mvc\InjectApplicationEventInterface;
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
        $controller = $this->factory->service('ControllerLoader')->get($name);

        if ($controller instanceof InjectApplicationEventInterface) {
            $controller->setEvent($this->factory->service('Application')->getMvcEvent());
        }

        return $controller;
	}
}

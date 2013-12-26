<?php

namespace RdnFactory\Plugin;

use Zend\Mvc\Router\RouteMatch;

class Params extends AbstractPlugin
{
	/**
	 * Fetch route parameter by the given name.
	 *
	 * @param string $name Parameter name to fetch.
	 * @param mixed $default Default value to use when parameter is missing.
	 *
	 * @return array|mixed|null
	 */
	public function __invoke($name, $default = null)
	{
		$match = $this->factory->service('Application')->getMvcEvent()->getRouteMatch();

		if (!$match instanceof RouteMatch)
		{
			return $default;
		}

		return $match->getParam($name, $default);
	}
}

<?php

namespace RdnFactory\Plugin;

use Zend\Mvc\Controller\AbstractActionController;

class Url extends AbstractPlugin
{
	/**
	 * Generate a URL based on a route
	 *
	 * @param string $route Route name
	 * @param array $params Route parameters
	 * @param array $options Route options. If boolean, and no fourth argument, used as $reuseMatchedParams.
	 * @param bool $reuseMatchedParams Whether to reuse matched parameters
	 *
	 * @return string
	 */
	public function __invoke($route = null, $params = array(), $options = array(), $reuseMatchedParams = false)
	{
		/** @var AbstractActionController $controller */
		$controller = $this->factory->controller('RdnFactory:Index');
		return $controller->url()->fromRoute($route, $params, $options, $reuseMatchedParams);
	}
}

<?php

namespace RdnFactory\Plugin;

class Config extends AbstractPlugin
{
	/**
	 * Get configuration by key. Pass multiple arguments to grab nested items.
	 *
	 * <code>
	 * // grab the 'display_exceptions' item inside the 'view_manager' array
	 * $config = $this->config('view_manager', 'display_exceptions');
	 * </code>
	 *
	 * @param string $key Grab the value for this config key.
	 *
	 * @return mixed
	 * @throws \RuntimeException
	 */
	public function __invoke($key = null)
	{
		$config = $this->factory->service('Config');
		$args = func_get_args();

		while (count($args))
		{
			if (!is_array($config))
			{
				throw new \RuntimeException('Config item is not an array, trying to grab '. implode(' -> ', func_get_args()));
			}

			$key = array_shift($args);
			$config = isset($config[$key]) ? $config[$key] : array();
		}

		return $config;
	}
}

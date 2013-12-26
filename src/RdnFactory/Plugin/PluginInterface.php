<?php

namespace RdnFactory\Plugin;

use RdnFactory\FactoryInterface;

interface PluginInterface
{
	public function setFactory(FactoryInterface $factory);

	/**
	 * @return FactoryInterface
	 */
	public function getFactory();
}

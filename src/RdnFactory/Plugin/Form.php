<?php

namespace RdnFactory\Plugin;

use Zend\Form\ElementInterface;

class Form extends AbstractPlugin
{
	/**
	 * Get a form, fieldset, or element with the given name.
	 *
	 * @param string $name
	 *
	 * @return ElementInterface
	 */
	public function __invoke($name)
	{
		return $this->factory->service('FormElementManager')->get($name);
	}
}

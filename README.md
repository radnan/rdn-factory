RdnFactory
==========

The **RdnFactory** ZF2 module makes it really easy to create factory classes.

## How to install

1. Use `composer` to require the `radnan/rdn-factory` package:

   ~~~bash
   $ composer require radnan/rdn-factory:1.*
   ~~~

2. Activate the module by including it in your `application.config.php` file:

   ~~~php
   <?php

   return array(
       'modules' => array(
           'RdnFactory',
           // ...
       ),
   );
   ~~~

## How to use

The module provides an `RdnFactory\AbstractFactory` class that you should extend when creating your factory classes. Implement the protected `create()` method to create your service.

~~~php
namespace FooModule\Factory\Controller;

use FooModule\Controller;
use RdnFactory\AbstractFactory;

class Bar extends AbstractFactory
{
	protected function create()
	{
		// Create and return your service
		return new Controller\Bar;
	}
}
~~~

This abstract factory has access to a repository of plugins, similar to a controller. Simply call the plugin as if you were calling a method:

~~~php
namespace FooModule\Factory\Controller;

use FooModule\Controller;
use RdnFactory\AbstractFactory;

class Bar extends AbstractFactory
{
	protected function create()
	{
		$config = $this->config('foo', 'bar');
		$modules = $this->service('ModuleManager');

		return new Controller\Bar($config, $modules);
	}
}
~~~

### `config(...$key)`

Get configuration by key. You can pass multiple keys to traverse nested configuration items.

~~~php
// grab the 'display_exceptions' item inside the 'view_manager' array
$config = $this->config('view_manager', 'display_exceptions');
~~~

### `controller($name)`

Get the controller with the given name.

~~~php
$controller = $this->controller('FooModule:BarController');
~~~

### `form($name)`

Get a form/fieldset/element with the given name.

~~~php
$collection = $this->form('Collection');

$form = $this->form('FooModule:BarForm');
~~~

### `params($name)`

Get a route parameter value.

~~~php
$id = $this->params('bar-id');
~~~

### `service($name)`

Get a service from the top-level service locator (service manager).

~~~php
$app = $this->service('Application');

$view = $this->service('ViewRenderer');

$uploads = $this->service('RdnUpload\Container');
~~~

### `url($route = null, $params = array(), $options = array(), $reuseMatchedParams = false)`

This is just a proxy to the `url()->fromRoute()` controller plugin. Useful for generating URLs from within a factory.

~~~php
$apiUrl = $this->url('foo/api/search/user');
~~~

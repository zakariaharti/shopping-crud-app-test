<?php

namespace App\core\app;

use App\core\db\Connector;
use App\core\router\Router;

/**
 *
 */
class Application
{
  private $_configs;
  private $_routes;

  function __construct($configs, $routes)
  {
    $this->_configs = $configs;
    $this->_routes = $routes;
    $this->init();
  }

  private function init()
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization");
  }

  public function run() {
    // setup database connection
    $db = Connector::getInstance();
    $connection = $db->connect($this->_configs);

    // setup routes
    $router = new Router($this->_routes);
    $router->handle($connection);
  }
}

<?php

namespace App\core\app;

use Throwable;
use App\core\db\Connector;
use App\core\router\Router;

/**
 * The entry point application
 *
 * @author zakaria harti
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
  }

  public function run() {
    try {
      // setup database connection
      $db = Connector::getInstance();
      $connection = $db->connect($this->_configs);

      // setup routes
      $router = new Router($this->_routes);
      $router->handle($connection);
    } catch (Throwable $e) {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage(),
          "line" => $e->getLine(),
          "file" => $e->getFile()
        ]
      ]);
    }
  }
}

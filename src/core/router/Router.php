<?php

namespace App\core\router;

use PDO;
use ReflectionClass;
use App\core\exceptions\{HttpMethodNotAllowedException, HttpNotFoundException};
/**
 *
 */
class Router
{
  private $_routes = [];

  function __construct($routes)
  {
    $this->_routes = $routes;
  }

  public function handle(PDO $db)
  {
     $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
       if (!empty($this->_routes)) {
         foreach ($this->_routes as $route) {
           $r->addRoute($route['method'],$route['path'],$route['handler']);
         }
       }
     });

     
     $httpMethod = $_SERVER['REQUEST_METHOD'];
     $uri = $_SERVER['REQUEST_URI'];


     if (false !== $pos = strpos($uri, '?')) {
         $uri = substr($uri, 0, $pos);
     }
     $uri = rawurldecode($uri);

     $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
     switch ($routeInfo[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            throw new HttpNotFoundException('404 page not found');
        break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
           $allowedMethods = $routeInfo[1];
           throw new HttpMethodNotAllowedException('Method not allowed Error :'.$allowedMethods);
           break;
        case \FastRoute\Dispatcher::FOUND:
           $handler = $routeInfo[1];
           $vars = $routeInfo[2];

           $className = "App\core\Controllers\\".$handler;
           $obj = new ReflectionClass($className);
           $instance = $obj->newInstance();

           $instance->execute($db, $vars);
          break;
     }
  }
}

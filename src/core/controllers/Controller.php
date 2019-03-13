<?php

namespace App\core\controllers;

/**
 * The base controller class
 *
 * @author zakaria harti
 */
abstract class Controller {
  abstract function execute(\PDO $db, $params = []);
}

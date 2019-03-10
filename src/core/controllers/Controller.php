<?php

namespace App\core\controllers;

abstract class Controller {
  abstract function execute(\PDO $db, $params = []);
}

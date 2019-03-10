<?php

namespace App\core\controllers;

class LoginController extends Controller {
  public function execute(\PDO $db, $params = []) {
    echo 'hello login route'. $params['name'];
  }
}

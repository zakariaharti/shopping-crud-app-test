<?php

namespace App\core\controllers;

use App\core\models\Customer;

class SignupController extends Controller {
  public function execute(\PDO $db, $params = []) {
    /*$customer = new Customer($db);

    if ($customer->usernameExists($params)) {
      throw new \Exception("The provided username {$params['username']} is already exists");
    }

    $customer->createCustomer($params);

    echo json_encode([
      'success' => 'you have been successfuly registered'
    ]);*/

    echo json_encode([
      'message' => 'hello world',
      'params' => $params
    ]);
  }
}

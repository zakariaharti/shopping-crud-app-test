<?php

namespace App\core\controllers;

use App\core\models\Customer;

class SignupController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $customer = new Customer($db);

    // TODO: Add data validation
    $data = [
      'username' => input('username'),
      'name' => input('name'),
      'password' => hashPassword(input('password')),
      'country' => input('country'),
      'addresse' => input('username'),
    ];

    if (!isEmptyValues($data)) {
      if ($customer->usernameExists($data)) {
        throw new \Exception("The provided username {$data['username']} is already exists");
      }
      $customer->createCustomer($data);
    }

    echo json_encode([
      'message' => 'you have been successfuly registered'
    ]);
  }
}

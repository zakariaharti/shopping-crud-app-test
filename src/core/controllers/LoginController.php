<?php

namespace App\core\controllers;

use \Firebase\JWT\JWT;
use App\core\models\Customer;

class LoginController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $customer = new Customer($db);

    // TODO: Add data validation
    $data = [
      'username' => input('username'),
      'password' => input('password'),
    ];

    if (!isEmptyValues($data)) {
      if ($customer->passwordMatch($data)) {
        // generate jwt
        $jwt = getJwtToken($data);
        echo json_encode(
               array(
                  "message" => "Successful login.",
                  "jwt" => $jwt
               )
           );
       }else {
         // set response code
         http_response_code(401);

         // tell the user login failed
         echo json_encode(
           array("message" => "either the username or the password is invalid")
         );
       }
    }
  }
}

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


    // variables used for jwt
    $key = "secret_key";
    $iss = "http://example.org";
    $aud = "http://example.com";
    $iat = 1356999524;
    $nbf = 1357000000;

    if (!isEmptyValues($data)) {
      if ($customer->passwordMatch($data)) {
        $token = array(
          "iss" => $iss,
          "aud" => $aud,
          "iat" => $iat,
          "nbf" => $nbf,
          "data" => array(
             "username" => $data['username'],
          )
        );

        // set response code
        http_response_code(200);

        // generate jwt
        $jwt = JWT::encode($token, $key);
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

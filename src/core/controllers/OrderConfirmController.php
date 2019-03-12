<?php

namespace App\core\controllers;

use App\core\models\{Order, Product};

class OrderConfirmController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $order = new Order($db);
    $product = new Product($db);

    // TODO: Add data validation
    $data = [
      'productId' => $params['id'],
      'orderId' => random_int(5000,100000),
      'username' => input('username'),
      'jwt' => input('jwt')
    ];

    if (!isEmptyValues($data)) {
      try {
        isAuthenticated($data['jwt']);

        if ($product->createOrder($data) && $order->createOrder($data)) {
          // generate jwt
          $jwt = getJwtToken(['username' => $data['username']]);
          echo json_encode(
                 array(
                    "message" => "order has been successfuly registred",
                    "jwt" => $jwt
                 )
             );
        }else {
          // set response code
          http_response_code(401);

          // show error message
          echo json_encode(array("message" => "Unable to add order"));
        }
      } catch (\Exception $e) {
        // set response code
        http_response_code(401);

       // show error message
        echo json_encode(array(
          "message" => "Access denied.",
          "error" => "authentication error",
          "detail" => $e->getMessage()
        ));
      }
    }else {
      echo json_encode(array(
        "message" => "missing required values for order",
      ));
    }
  }
}

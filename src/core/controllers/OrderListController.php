<?php

namespace App\core\controllers;

use App\core\models\Order;

class OrderListController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $customer = new Order($db);

    // TODO: Add data validation
    $data = [
      'username' => input('username'),
      'jwt' => input('jwt')
    ];

    if (!isEmptyValues($data)) {
      try {
        isAuthenticated($data['jwt']);

        if ($result = $customer->fetchProducts($data)) {
          // generate jwt
          $jwt = getJwtToken(['username' => $data['username']]);
          echo json_encode(
                 array(
                    "orders" => $result,
                    "jwt" => $jwt
                 )
             );
        }else {
          // set response code
          http_response_code(401);

          // show error message
          echo json_encode(array("message" => "Unable to fetch orders"));
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

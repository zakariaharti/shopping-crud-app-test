<?php

namespace App\core\controllers;

use App\core\models\Product;

class ProductCreateController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $customer = new Product($db);

    // TODO: Add data validation
    $data = [
      'title' => input('title'),
      'description' => input('description'),
      'price' => input('price'),
      'inventory' => input('inventory'),
      'jwt' => input('jwt')
    ];

    if (!isEmptyValues($data)) {
      try {
        isAuthenticated($data['jwt']);

        if ($customer->createProduct($data)) {
          // generate jwt
          $jwt = getJwtToken(['title' => $data['title']]);
          echo json_encode(
                 array(
                    "message" => "Product ${$data['title']} has been created",
                    "jwt" => $jwt
                 )
             );
        }else {
          // set response code
          http_response_code(401);

          // show error message
          echo json_encode(array("message" => "Unable to create new product"));
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
        "message" => "missing required values for product",
      ));
    }
  }
}

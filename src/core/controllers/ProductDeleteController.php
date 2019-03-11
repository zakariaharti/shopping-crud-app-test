<?php

namespace App\core\controllers;

use App\core\models\Product;

class ProductDeleteController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $product = new Product($db);

    // TODO: Add data validation
    $data = [
      'id' => input('id'),
      'jwt' => input('jwt')
    ];

    if (!isEmptyValues($data)) {
      try {
        isAuthenticated($data['jwt']);

        if ($product->deleteProduct($data)) {
          // generate jwt
          $jwt = getJwtToken(['id' => $data['id']]);
          echo json_encode(
                 array(
                    "message" => "Product has been deleted",
                    "jwt" => $jwt
                 )
             );
        }else {
          // set response code
          http_response_code(401);

          // show error message
          echo json_encode(array("message" => "Unable to delete product"));
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

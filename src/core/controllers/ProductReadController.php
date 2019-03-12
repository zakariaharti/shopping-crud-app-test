<?php

namespace App\core\controllers;

use App\core\models\Product;

class ProductReadController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $product = new Product($db);

    if ($result = $product->fetchProduct($params)) {
      echo json_encode(
             array(
                "product" => $result,
             )
         );
    }else {
      // set response code
      http_response_code(401);

      // show error message
      echo json_encode(array("message" => "Unable to find product"));
    }
  }
}

<?php

namespace App\core\controllers;

use App\core\models\Product;

class ProductListController extends Controller {
  public function execute(\PDO $db, $params = []) {
    $product = new Product($db);

    $productList = $product->fetchProducts();

    if ($productList) {
      echo json_encode([
        'products' => $productList
      ]);
    }else {
      echo json_encode([
        'error' => 'connot fecth products'
      ]);
    }
  }
}

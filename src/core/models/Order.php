<?php

namespace App\core\models;

use PDO;
use App\core\interfaces\CommonModel;

/**
 * Product Model
 */
class Order implements CommonModel
{
  private static $_sqlTabelQuery = '
    CREATE TABLE IF NOT EXISTS orders (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      product_id INTEGER NOT NULL,
      customer_id INTEGER NOT NULL,
      status VARCHAR
    )
  ';

  function __construct($db)
  {
    $this->createTables($db);
  }

  public function createTables(PDO $db){
    $count = $db->exec(self::$_sqlTabelQuery);
    return $count;
  }

  function fetchProducts($data)
  {
    $sql = "SELECT * FROM orders WHERE customer_id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['username']);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

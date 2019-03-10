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
      customer_id INTEGER NOT NULL
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
}

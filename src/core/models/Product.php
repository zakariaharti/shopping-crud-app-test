<?php

namespace App\core\models;

use PDO;
use App\core\interfaces\CommonModel;

/**
 * Product Model
 */
class Product implements CommonModel
{
  private static $_sqlTabelQuery = '
    CREATE TABLE IF NOT EXISTS products (
      id INTEGER PRIMARY KEY AUTOINCREMENT ,
      title VARCHAR NOT NULL,
      description VARCHAR NOT NULL,
      price VARCHAR NOT NULL,
      inventory CHAR NOT NULL
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

<?php

namespace App\core\models;

use PDO;
use App\core\interfaces\CommonModel;

/**
 * Product Model
 */
class Order implements CommonModel
{
  private $_pdo;
  private static $_sqlTabelQuery = '
    CREATE TABLE IF NOT EXISTS orders (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      username INTEGER NOT NULL
    )
  ';

  function __construct($db)
  {
    $this->_pdo = $db;
    $this->createTables($db);
  }

  public function createTables(PDO $db){
    $count = $db->exec(self::$_sqlTabelQuery);
    return $count;
  }

  public function createOrder($data)
  {
    $sql = "INSERT INTO orders VALUES(?,?)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['orderId']);
    $stmt->bindParam(2, $data['username']);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function fetchProducts($data)
  {
    $sql = "SELECT * FROM products";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['username']);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

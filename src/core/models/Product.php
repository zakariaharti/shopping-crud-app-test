<?php

namespace App\core\models;

use PDO;
use App\core\interfaces\CommonModel;

/**
 * Product Model
 */
class Product implements CommonModel
{
  private $_pdo;

  private static $_sqlTabelQuery = '
    CREATE TABLE IF NOT EXISTS products (
      id INTEGER PRIMARY KEY AUTOINCREMENT ,
      title VARCHAR NOT NULL,
      description VARCHAR NOT NULL,
      price VARCHAR NOT NULL,
      inventory CHAR NOT NULL,
      order_id CHAR
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

  public function createProduct($data)
  {
    $id = random_int(500,100000);
    $sql = "INSERT INTO products (id,title,description,price,inventory,order_id) VALUES(?,?,?,?,?,?)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->bindParam(2, $data['title']);
    $stmt->bindParam(3, $data['description']);
    $stmt->bindParam(4, $data['price']);
    $stmt->bindParam(5, $data['inventory']);
    $stmt->bindParam(6, "order");

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function createOrder($data)
  {
    $sql = "UPDATE products SET order_id = ? WHERE id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['orderId']);
    $stmt->bindParam(2, $data['productId']);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function fetchProducts()
  {
    $sql = "SELECT * FROM products";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  function fetchProduct($data)
  {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['id']);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  function deleteProduct($data)
  {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['id']);
    return $stmt->execute();
  }

  function updateProduct($data)
  {
    $sql = "
      UPDATE products
      SET title = ?, description = ?, price = ?, inventory = ?
      WHERE id = ?
    ";

    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(1, $data['title']);
    $stmt->bindParam(2, $data['description']);
    $stmt->bindParam(3, $data['price']);
    $stmt->bindParam(4, $data['inventory']);
    $stmt->bindParam(5, $data['id']);

    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}

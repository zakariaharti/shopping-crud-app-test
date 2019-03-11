<?php

namespace App\core\models;

use PDO;
use App\core\interfaces\CommonModel;

/**
 * Product Model
 */
class Customer implements CommonModel
{
  private $_pdo;
  private static $_sqlTabelQuery = '
    CREATE TABLE IF NOT EXISTS customers (
      username VARCHAR NOT NULL PRIMARY KEY UNIQUE,
      password CHAR NOT NULL,
      name VARCHAR NOT NULL,
      addresse VARCHAR NOT NULL,
      country VARCHAR NOT NULL
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

  public function createCustomer($params)
  {
    $sql = "INSERT INTO customers VALUES(:username,:password,:name,:addresse,:country)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->bindParam(':username',$params['username']);
    $stmt->bindParam(':name',$params['name']);
    $stmt->bindParam(':addresse',$params['addresse']);
    $stmt->bindParam(':country',$params['country']);
    $stmt->bindParam(':password', $params['password']);

    if($stmt->execute()){
       return true;
    }

    return false;
  }

  function usernameExists($params){

    // query to check if email exists
    $query = "SELECT * FROM customers WHERE username = :username";

    $res = $this->_pdo->prepare($query);
    $res->bindParam(':username', $params['username']);
    $res->execute();

    return $res->fetch(PDO::FETCH_OBJ);
  }

  public function passwordMatch($params){
    if ($res = $this->usernameExists($params)) {
      if (password_verify($params['password'], $res->password)) {
        return true;
      }
    }
    return false;
  }
}

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
    CREATE TABLE customers (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      username VARCHAR NOT NULL UNIQUE,
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
    $stmt->bindParam(':username',htmlentities($params['username']));
    $stmt->bindParam(':name',htmlentities($params['name']));
    $stmt->bindParam(':addresse',htmlentities($params['addresse']));
    $stmt->bindParam(':country',htmlentities($params['country']));
    $stmt->bindParam(':password', password_hash($params['password'], PASSWORD_BCRYPT));

    if($stmt->execute()){
       return true;
    }

    return false;
  }

  function usernameExists($params){

    // query to check if email exists
    $query = "SELECT id, username FROM customers WHERE username = ?";

    $stmt = $this->_pdo->prepare( $query );


    $stmt->bindParam(1, $params['username']);

    // execute the query
    $stmt->execute();

    // get number of rows
    $num = $stmt->rowCount();

    if($num > 0){
        return true;
    }

    return false;
  }
}

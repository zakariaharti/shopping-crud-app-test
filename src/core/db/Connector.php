<?php

namespace App\core\db;

use PDO;
use PDOException;
use App\core\exceptions\DBConnectionException;
/**
 * connect to sqlite database
 */
class Connector
{
  private static $_instance = NULL;
  private $_pdo;

  private function __construct()
  {
  }

  public static function getInstance(){
    if (self::$_instance === NULL) {
      self::$_instance = new static();
    }
    return self::$_instance;
  }

  public function connect(array $configs)
  {
     try {
       $this->_pdo = new PDO($configs['db']['dsn']);
       $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch (PDOException $e) {
       throw new DBConnectionException('Database connection error :'.$e->getMessage());
     }

     return $this->_pdo;
  }
}

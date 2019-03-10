<?php

namespace App\core\interfaces;

/**
 * common model interface
 */
interface CommonModel
{
  public function createTables(\PDO $db);
}

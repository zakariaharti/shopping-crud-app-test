<?php

namespace App\core\interfaces;

/**
 * common model interface
 */
interface CommonCon
{
  public function createTables(\PDO $db);
}

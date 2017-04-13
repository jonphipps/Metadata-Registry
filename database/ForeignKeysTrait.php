<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-01-07,  Time: 2:33 PM */

namespace database;

use Illuminate\Database\Schema\Blueprint;
use SchemaL;

trait ForeignKeysTrait
{
  /**
   * List the foreign keys for a table
   *
   * @param Blueprint $table
   *
   * @return array
   */
  public function listTableForeignKeys(Blueprint $table)
  {
    $conn = SchemaL::getConnection()->getDoctrineSchemaManager();

    return array_map(
        function ($key) {
          /** @var \Doctrine\DBAL\Schema\ForeignKeyConstraint $key */
          return $key->getName();
        },
            $conn->listTableForeignKeys($table)
        );
  }


  /**
   * Drop a foreign key, but only if it's already defined
   *
   * @param Blueprint $table
   * @param string $key
   */
  public function dropForeignKey(Blueprint $table, $key)
  {
    $foreignKeys = $this->listTableForeignKeys($table);

    if (in_array($key, $foreignKeys)) {
      $table->dropForeign($key);
    }
  }

}

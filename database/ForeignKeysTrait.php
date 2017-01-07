<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-01-07,  Time: 2:33 PM */

namespace database;

use SchemaL;

trait ListForeignKeysTrait
{
  public function listTableForeignKeys($table)
  {
    $conn = SchemaL::getConnection()->getDoctrineSchemaManager();

    return array_map(

        function ($key) {
          /** @var \Doctrine\DBAL\Schema\ForeignKeyConstraint $key */
          return $key->getName();
        },
        $conn->listTableForeignKeys($table));
  }

}

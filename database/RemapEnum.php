<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-01-07,  Time: 2:36 PM */

namespace database;

use SchemaL;

trait RemapEnum
{
  /**
   * Make sure Doctrine understands Enums
   */
  public function remapEnum()
  {
    $platform = SchemaL::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
    $platform->registerDoctrineTypeMapping('enum', 'string');
  }
}

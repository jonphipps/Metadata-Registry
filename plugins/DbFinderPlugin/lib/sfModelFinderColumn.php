<?php

/*
 * This file is part of the DbFinder package.
 * 
 * (c) 2008 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfModelFinderColumn lists model column types
 */
class sfModelFinderColumn
{
  const STRING = "STRING";
  const NUMERIC = "NUMERIC";
  const DECIMAL = "DECIMAL";
  const TINYINT = "TINYINT";
  const SMALLINT = "SMALLINT";
  const INTEGER = "INTEGER";
  const BIGINT = "BIGINT";
  const REAL = "REAL";
  const FLOAT = "FLOAT";
  const DOUBLE = "DOUBLE";
  const BINARY = "BINARY";
  const VARBINARY = "VARBINARY";
  const LONGVARBINARY = "LONGVARBINARY";
  const BLOB = "BLOB";
  const DATE = "DATE";
  const TIME = "TIME";
  const TIMESTAMP = "TIMESTAMP";
  const BU_DATE = "BU_DATE";
  const BU_TIMESTAMP = "BU_TIMESTAMP";
  const BOOLEAN = "BOOLEAN";
  
  public static function getColumnType($column)
  {
    throw new Exception('This method must be overridden in subclasses!'); // abstract static not allowed since PHP 5.2
  }
}
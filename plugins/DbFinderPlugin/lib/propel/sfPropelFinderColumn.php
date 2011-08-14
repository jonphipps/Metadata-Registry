<?php

/*
 * This file is part of the sfPropelFinder package.
 * 
 * (c) 2009 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelFinderColumn maps Propel column types to sfModelFinderColumn types
 * Currently supported ORMs are Propel 1.2, and Propel 1.3
 */
class sfPropelFinderColumn extends sfModelFinderColumn
{
  private static $propel12ToDbFinderMap = array(
    1 => self::BOOLEAN,
    2 => self::BIGINT,
    3 => self::SMALLINT,
    4 => self::TINYINT,
    5 => self::INTEGER,
    6 => self::STRING,
    7 => self::STRING,
    8 => self::FLOAT,
    9 => self::DOUBLE,
    10 => self::DATE,
    11 => self::TIME,
    12 => self::TIMESTAMP,
    13 => self::VARBINARY,
    14 => self::NUMERIC,
    15 => self::BLOB,
    16 => self::STRING,
    17 => self::STRING,
    18 => self::DECIMAL,
    19 => self::REAL,
    20 => self::BINARY,
    21 => self::LONGVARBINARY,
    22 => self::INTEGER,
  );
  
  private static $propel13ToDbFinderMap = array(
    'CHAR'          => self::STRING,
    'VARCHAR'       => self::STRING,
    'LONGVARCHAR'   => self::STRING,
    'CLOB'          => self::STRING,
    'NUMERIC'       => self::NUMERIC,
    'DECIMAL'       => self::DECIMAL,
    'TINYINT'       => self::TINYINT,
    'SMALLINT'      => self::SMALLINT,
    'INTEGER'       => self::INTEGER,
    'BIGINT'        => self::BIGINT,
    'REAL'          => self::REAL,
    'FLOAT'         => self::FLOAT,
    'DOUBLE'        => self::DOUBLE,
    'BINARY'        => self::BINARY,
    'VARBINARY'     => self::VARBINARY,
    'LONGVARBINARY' => self::LONGVARBINARY,
    'BLOB'          => self::BLOB,
    'DATE'          => self::DATE,
    'TIME'          => self::TIME,
    'TIMESTAMP'     => self::TIMESTAMP,
    'BU_DATE'       => self::BU_DATE,
    'BU_TIMESTAMP'  => self::BU_TIMESTAMP,
    'BOOLEAN'       => self::BOOLEAN,
  );
  
  protected static $version = null;
  
  public static function getColumnType($column)
  {
    if(is_null(self::$version))
    {
      self::$version = method_exists('ColumnMap', 'getCreoleType') ? 12 : 13;
    }
    
    if(self::$version == 12)
    {
      // Propel 1.2
      if($type = $column->getCreoleType())
      {
        $type = array_key_exists($type, self::$propel12ToDbFinderMap) ? self::$propel12ToDbFinderMap[$type] : $type;
      }
    }
    else
    {
      // Propel 1.3
      if($type = $column->getType())
      {
        $type = array_key_exists($type, self::$propel13ToDbFinderMap) ? self::$propel13ToDbFinderMap[$type] : $type;
      }
    }
    
    return $type;
  }
}
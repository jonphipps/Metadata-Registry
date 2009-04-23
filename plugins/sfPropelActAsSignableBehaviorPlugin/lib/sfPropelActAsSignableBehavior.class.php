<?php

/**
 * This file is part of the sfPropelActAsSignableBehavior package.
 * 
 * (c) 2008 Nicolas Chambrier
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
/**
 * This behavior automates the handling of "created_by" and "updated_by" columns
 * 
 * Full options array (every option is optional) :
 * 
 * sfPropelBehavior::add('Dummy', array(
 *   'sfPropelActAsSignableBehavior' => array(
 *     'columns' => array( // columns map
 *       'created' => DummyPeer::CREATED_BY,
 *       'updated' => DummyPeer::UPDATED_BY,
 *       'deleted' => DummyPeer::DELETED_BY,
 *     ),
 *     'userMethods' => array( // user's methods to get string or int representation
 *       'string' => '__toString',
 *       'id'     => 'getId',
 *     ),
 *     'updateModifiedColumn' => false,
 *     'updateEmptyColumn' => true,
 *   )
 * ));
 * 
 *
 * @author  Nicolas Chambrier <naholyr@yahoo.fr>
 */
 
class sfPropelActAsSignableBehavior
{
	
	/**
	 * If set to true, the *_by columns will be set, even if they're already
	 * marked as modified.
	 * 
	 * @see sfPropelActAsSignableBehavior::$default_updateEmptyColumn
	 *
	 * @var boolean
	 */
	public static $default_updateModifiedColumn = false;
	
	/**
	 * If set to true, the *_by columns will be set if they're empty, even if
	 * they're marked as modified.
	 * 
	 * @see sfPropelActAsSignableBehavior::$default_updateModifiedColumn
	 * 
	 * @var boolean
	 */
	public static $default_updateEmptyColumn = true;
	
	/**
	 * If set to true, the behavior will be enabled, even in CLI context
	 */
	public static $enabledInCLI = false;
	
	/**
	 * Is behavior enabled ?
	 *
	 * @var boolean
	 */
	protected static $_enabled = true;
	
	/**
	 * Default columns mapping
	 *
	 * @var array
	 */
	private static $default_columns = array(
		'created' => 'created_by', 
		'updated' => 'updated_by', 
		'deleted' => 'deleted_by'
	);
	
	/**
	 * Default user methods mapping
	 *
	 * @var array
	 */
	private static $default_userMethods = array(
		'id'     => 'getId', 
		'string' => '__toString'
	);
	
	/**
	 * Is behavior enabled ?
	 *
	 * @return boolean
	 */
	public static function enabled()
	{
	  if (0 == strncasecmp(PHP_SAPI, 'cli', 3)) {
      // CLI
      return self::$enabledInCLI;
	  }
	  
		return self::$_enabled;
	}
	
	/**
	 * Disable behavior for the next save()
	 *
	 */
	public static function disable()
	{
		self::$_enabled = false;
	}
	
	/**
	 * Enable behavior
	 *
	 */
	public static function enable()
	{
		self::$_enabled = true;
	}
	
	/**
	 * Called before node is saved
	 *
	 * @param   BaseObject  $object
	 */
	public function preSave(BaseObject $object)
	{
		// Automaticaly re-enable behavior
		if (!self::enabled()) {
			self::enable();
			return false;
		}
		
		// Get user from context, if available
		$user = sfContext::getInstance()->getUser();
		
		// Created by...
		if ($object->isNew()) {
			self::setSomethingBy($object, 'created', $user);
		}
		
		// Updated by...
		if ($object->isModified()) {
			self::setSomethingBy($object, 'updated', $user);
		}
	}
	
	/**
	 * Called before node is deleted
	 *
	 * @param   BaseObject  $object
	 */
	public function preDelete(BaseObject $object)
	{
		// Automaticaly re-enable behavior
		if (!self::enabled()) {
			self::enable();
			return false;
		}
		
		// Get user from context
		$user = sfContext::getInstance()->getUser();
		
		// Deleted by...
		self::setSomethingBy($object, 'deleted', $user);
	}
	
	/**
	 * Update "$what" depending on the user
	 *
	 * @param BaseObject   $object
	 * @param string       $what
	 * @param myUser       $user
	 */
	private static function setSomethingBy(BaseObject $object, $what, myUser $user)
	{
		$class = get_class($object);
		
		// Check if the column is authorized to be updated, depending on the behavior options
		$column = self::getColumnConstant($object, $what);
		$updateModifiedColumn = sfConfig::get('propel_behavior_sfPropelActAsSignableBehavior_' . $class . '_updateModifiedColumn', self::$default_updateModifiedColumn);
		if (!$updateModifiedColumn && $object->isColumnModified($column)) {
			// we're not allowed to update modified column, and this one is modified
			$updateEmptyColumn = sfConfig::get('propel_behavior_sfPropelActAsSignableBehavior_' . $class . '_updateEmptyColumn', self::$default_updateEmptyColumn);
			if (!$updateEmptyColumn) {
				// we don't check if the column is empty, let's stop here
				return false;
			} else {
				// we skip only if the column is not empty
				$getter = self::forgeMethodName($object, 'get', $what);
				$value = call_user_func(array($object, $getter));
				if (!empty($value)) {
					return false;
				}
			}
		}
		
		// Retrieve column's type and get the corresponding user's value
		switch (self::getColumnType($object, $what)) {
			case null:       // Column not found : ignore
				return false;
			case 'int':      // integer : set with id
				$value = self::getUserInfo($class, $user, 'id');
				break;
			case 'string':   // string : set with string representation
				$value = self::getUserInfo($class, $user, 'string');
				break;
			default:         // other : type not supported
				throw new sfException('[sfPropelActAsSignable] column "' . $what . '" must be int or string');
		}
		
		// Set the value
		$setter = self::forgeMethodName($object, 'set', $what);
		
		return call_user_func(array($object, $setter), $value);
	}

	/**
	 * Returns an info from user, depending on the class having registered the behavior
	 *
	 * @param string          $class             Propel model class
	 * @param myUser          $user              Current user
	 * @param string          $info              Info retrieved
	 * 
	 * @return mixed
	 */
	private static function getUserInfo($class, myUser $user, $info)
	{
	  if (!$user) {
	    return null;
	  }
	  
		$methods = sfConfig::get('propel_behavior_sfPropelActAsSignableBehavior_' . $class . '_userMethods', array());
		
		if (array_key_exists($info, $methods)) {
			$method = $methods[$info];
		} else {
			$method = self::$default_userMethods[$info];
		}
		
		return call_user_func(array($user, $method));
	}
	
	/**
	 * Returns the appropriate column name.
	 * 
	 * @param   BaseObject   $object                   Propel object
	 * @param   string       $column                   Column name
	 * 
	 * @return  string       Column's name
	 */
	private static function getColumnConstant(BaseObject $object, $column)
	{
		$class = get_class($object);
		
		$columns = sfConfig::get('propel_behavior_sfPropelActAsSignableBehavior_' . $class . '_columns', array());
		
		if (array_key_exists($column, $columns)) {
			$column = $columns[$column];
		} else {
			$column = self::$default_columns[$column];
		}
		
		// Check that the column is prefixed, if not, prefix it with table name
		$table_name = $object->getPeer()->getTableMap()->getName();
		if (substr($column, 0, strlen($table_name)+1) != $table_name . '.') {
			$column = $table_name . '.' . strtoupper($column);
		}
		
		return $column;
	}
	
	/**
	 * Returns type for one column of the given class
	 *
	 * @param BaseObject   $object                Propel object
	 * @param string       $column                Column name
	 * 
	 * @return string
	 */
	private static function getColumnType(BaseObject $object, $column)
	{
		$table = $object->getPeer()->getTableMap();
		
		try {
		  $column = $table->getColumn(self::getColumnConstant($object, $column));
		  switch ($column->getPdoType()) {
		    case PDO::PARAM_INT:
          $type = 'int';
          break;
        case PDO::PARAM_STR:
          $type = 'string';
          break;
        default:
		      $type = $column->getType();
		      break;
		  }
		} catch (PropelException $e) {
			$type = null;
		}
		
		return $type;
	}
		
	/**
	 * Returns getter / setter name for requested column.
	 * 
	 * @param   BaseObject  $object       Propel object
	 * @param   string      $prefix       get|set|...
	 * @param   string      $column       from|to
	 */
	private static function forgeMethodName(BaseObject $object, $prefix, $column)
	{
		$column_constant = self::getColumnConstant($object, $column);
		$method_name = $prefix . $object->getPeer()->translateFieldName($column_constant, BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
		
		return $method_name;
	}
	
}

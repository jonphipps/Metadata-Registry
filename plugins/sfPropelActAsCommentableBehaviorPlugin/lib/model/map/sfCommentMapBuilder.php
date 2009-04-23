<?php


/**
 * This class adds structure of 'sf_comment' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Thu Apr 23 17:03:56 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfPropelActAsCommentableBehaviorPlugin.lib.model.map
 */
class sfCommentMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfPropelActAsCommentableBehaviorPlugin.lib.model.map.sfCommentMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(sfCommentPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfCommentPeer::TABLE_NAME);
		$tMap->setPhpName('sfComment');
		$tMap->setClassname('sfComment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('COMMENTABLE_MODEL', 'CommentableModel', 'VARCHAR', false, 30);

		$tMap->addColumn('COMMENTABLE_ID', 'CommentableId', 'INTEGER', false, null);

		$tMap->addColumn('COMMENT_NAMESPACE', 'CommentNamespace', 'VARCHAR', false, 50);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', false, 100);

		$tMap->addColumn('TEXT', 'Text', 'LONGVARCHAR', false, null);

		$tMap->addColumn('AUTHOR_ID', 'AuthorId', 'INTEGER', false, null);

		$tMap->addColumn('AUTHOR_NAME', 'AuthorName', 'VARCHAR', false, 50);

		$tMap->addColumn('AUTHOR_EMAIL', 'AuthorEmail', 'VARCHAR', false, 100);

		$tMap->addColumn('AUTHOR_WEBSITE', 'AuthorWebsite', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // sfCommentMapBuilder

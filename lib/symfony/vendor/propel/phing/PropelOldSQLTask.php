<?php

/*
 *  $Id: PropelOldSQLTask.php 536 2007-01-10 14:30:38Z heltem $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://propel.phpdb.org>.
 */

include_once 'propel/engine/database/model/AppData.php';

/**
 * An extended Capsule task used for generating SQL source from an XML schema describing a database structure.
 *
 * This is deprecated; the new PropelSQLTask should be used instead.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Jason van Zyl <jvanzyl@periapt.com> (Torque)
 * @author     John McNally <jmcnally@collab.net> (Torque)
 * @version    $Revision: 536 $
 * @package    propel.phing
 * @deprecated
 */
class PropelOldSQLTask extends AbstractPropelDataModelTask {

	/**
	 * The properties file that maps an SQL file to a particular database.
	 * @var        PhingFile
	 */
	private $sqldbmap;

	/**
	 * Name of the database.
	 */
	private $database;

	/**
	 * Set the sqldbmap.
	 * @param      PhingFile $sqldbmap The db map.
	 */
	public function setSqlDbMap(PhingFile $sqldbmap)
	{
		$this->sqldbmap = $sqldbmap;
	}

	/**
	 * Get the sqldbmap.
	 * @return     PhingFile $sqldbmap.
	 */
	public function getSqlDbMap()
	{
		return $this->sqldbmap;
	}

	/**
	 * Set the database name.
	 * @param      string $database
	 */
	public function setDatabase($database)
	{
		$this->database = $database;
	}

	/**
	 * Get the database name.
	 * @return     string
	 */
	public function getDatabase()
	{
		return $this->database;
	}

	/**
	 * Create the sql -> database map.
	 *
	 * @throws     IOException - if unable to store properties
	 */
	private function createSqlDbMap()
	{
		if ($this->getSqlDbMap() === null) {
			return;
		}

		// Produce the sql -> database map
		$sqldbmap = new Properties();

		// Check to see if the sqldbmap has already been created.
		if ($this->getSqlDbMap()->exists()) {
			$sqldbmap->load($this->getSqlDbMap());
		}

		if ($this->packageObjectModel) {
			// in this case we'll get the sql file name from the package attribute
			$dataModels = $this->packageDataModels();
			foreach ($dataModels as $package => $dataModel) {
				foreach ($dataModel->getDatabases() as $database) {
					$name = ($package ? $package . '.' : '') . 'schema.xml';
					$sqlFile = $this->getMappedFile($name);
					$sqldbmap->setProperty($sqlFile->getName(), $database->getName());
				}
			}
		} else {
			// the traditional way is to map the schema.xml filenames
			$dmMap = $this->getDataModelDbMap();
			foreach(array_keys($dmMap) as $dataModelName) {
				$sqlFile = $this->getMappedFile($dataModelName);
				if ($this->getDatabase() === null) {
					$databaseName = $dmMap[$dataModelName];
				} else {
					$databaseName = $this->getDatabase();
				}
				$sqldbmap->setProperty($sqlFile->getName(), $databaseName);
			}
		}

		try {
			$sqldbmap->store($this->getSqlDbMap(), "Sqlfile -> Database map");
		} catch (IOException $e) {
			throw new IOException("Unable to store properties: ". $e->getMessage());
		}
	}

	public function main() {

		$this->validate();

		if(!$this->mapperElement) {
			throw new BuildException("You must use a <mapper/> element to describe how names should be transformed.");
		}

		if ($this->packageObjectModel) {
			$dataModels = $this->packageDataModels();
		} else {
			$dataModels = $this->getDataModels();
		}

		// 1) first create a map of filenames to databases; this is used by other tasks like
		// the SQLExec task.
		$this->createSqlDbMap();

		// 2) Now actually create the DDL based on the datamodel(s) from XML schema file.
		$targetDatabase = $this->getTargetDatabase();

		$basepath = "sql/base/$targetDatabase";

		$generator = $this->createContext();
		$generator->put("basepath", $basepath); // make available to sub-templates


		$fname = "sql/base/$targetDatabase/table.tpl" ;
		// $generator->put("fname", $fname); // make available to sub-templates

		$fnamekeys= "sql/base/$targetDatabase/tablefk.tpl";
		//$generator->put("fnamekeys", $fnamekeys); // make available to sub-templates

		$ddlStartFile = new PhingFile($this->getTemplatePath(), "sql/base/$targetDatabase/database-start.tpl");
		$ddlEndFile = new PhingFile($this->getTemplatePath(), "sql/base/$targetDatabase/database-end.tpl");

		foreach ($dataModels as $package => $dataModel) {

			foreach ($dataModel->getDatabases() as $database) {

				// file we are going to create
				if (!$this->packageObjectModel) {
					$name = $dataModel->getName();
				} else {
					$name = ($package ? $package . '.' : '') . 'schema.xml';
				}
				$outFile = $this->getMappedFile($name);

				$generator->put("database", $database); // make available to sub-templates
				$generator->put("platform", $database->getPlatform());

				$this->log("Generating SQL tables for database: " . $database->getName());

				$this->log("Writing to SQL file: " . $outFile->getPath());


				// this variable helps us overwrite the first time we write to file
				// and then append thereafter
				$append=false;

				// First check to see if there is a "header" SQL file
				if ($ddlStartFile->exists()) {
					$generator->parse($ddlStartFile->getAbsolutePath(), $outFile->getAbsolutePath(), false);
					$append = true;
				}

				foreach($database->getTables() as $tbl) {
					if (!$tbl->isSkipSql()) {
						$this->log("\t + " . $tbl->getName());
						$generator->put("table", $tbl);
						$generator->parse($fname, $outFile->getAbsolutePath(), $append);
						if ($append === false) $append = true;
					} else {
						$this->log("\t + (skipping) " . $tbl->getName());
					}
				} // foreach database->getTables()

				foreach ($database->getTables() as $tbl) {
					if (!$tbl->isSkipSql()) {
						$generator->put("tablefk", $tbl);
						$generator->parse($fnamekeys, $outFile->getAbsolutePath(), true); // always append
					}
				}

				// Finally check to see if there is a "footer" SQL file
				if ($ddlEndFile->exists()) {
					$generator->parse($ddlEndFile->getAbsolutePath(), $outFile->getAbsolutePath(), true);
				}

			} // foreach database
		} //foreach datamodels

	} // main()

	/**
	 * Packages the datamodels to one datamodel per package
	 *
	 * This applies only when the the packageObjectModel option is set. We need to
	 * re-package the datamodels to allow the database package attribute to control
	 * which tables go into which SQL file.
	 *
	 * @return     array The packaged datamodels
	 */
	protected function packageDataModels() {

		static $packagedDataModels;

		if (is_null($packagedDataModels)) {

			$dataModels = $this->getDataModels();
			$dataModel = array_shift($dataModels);
			$packagedDataModels = array();

			$platform = $this->getPlatformForTargetDatabase();

			foreach ($dataModel->getDatabases() as $db) {
				foreach ($db->getTables() as $table) {
					$package = $table->getPackage();
					if (!isset($packagedDataModels[$package])) {
						$dbClone = $this->cloneDatabase($db);
						$dbClone->setPackage($package);
						$ad = new AppData($platform);
						$ad->setName($dataModel->getName());
						$ad->addDatabase($dbClone);
						$packagedDataModels[$package] = $ad;
					}
					$packagedDataModels[$package]->getDatabase($db->getName())->addTable($table);
				}
			}
		}

		return $packagedDataModels;
	}

	protected function cloneDatabase($db) {

		$attributes = array (
			'name' => $db->getName(),
			'baseClass' => $db->getBaseClass(),
			'basePeer' => $db->getBasePeer(),
			//'defaultPhpType' => $db->getDefaultPhpType(),
			'defaultIdMethod' => $db->getDefaultIdMethod(),
			'defaultPhpNamingMethod' => $db->getDefaultPhpNamingMethod(),
			'defaultTranslateMethod' => $db->getDefaultTranslateMethod(),
			//'heavyIndexing' => $db->getHeavyIndexing(),
		);

		$clone = new Database();
		$clone->loadFromXML($attributes);
		return $clone;
	}
}

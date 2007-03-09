<?php

/*
 *  $Id: PropelDataDumpTask.php 536 2007-01-10 14:30:38Z heltem $
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

include_once 'creole/Creole.php';

/**
 * Dumps the contenst of selected databases to XML data dump file.
 *
 * The generated XML files can have corresponding DTD files generated using the
 * PropelDataDTDTask.  The results of the data dump can be converted to SQL using
 * the PropelDataSQLTask class.
 *
 * The database may be specified (via 'databaseName' attribute) if you only want to dump
 * the contents of one database.  Otherwise it is assumed that all databases described
 * by datamodel schema file(s) will be dumped.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Fedor Karpelevitch <fedor.karpelevitch@home.com> (Torque)
 * @author     Jason van Zyl <jvanzyl@zenplex.com> (Torque)
 * @author     Daniel Rall <dlr@finemaltcoding.com> (Torque)
 * @version    $Revision: 536 $
 * @package    propel.phing
 */
class PropelDataDumpTask extends AbstractPropelDataModelTask {

	/**
	 * Database name.
	 * The database name may be optionally specified in the XML if you only want
	 * to dump the contents of one database.
	 */
	private $databaseName;

	/**
	 * Database URL used for Creole connection.
	 * This is a PEAR-compatible (loosely) DSN URL.
	 */
	private $databaseUrl;

	/**
	 * Database driver used for Creole connection.
	 * This should normally be left blank so that default (Creole built-in) driver for database type is used.
	 */
	private $databaseDriver;

	/**
	 * Database user used for Creole connection.
	 * @deprecated Put username in databaseUrl.
	 */
	private $databaseUser;

	/**
	 * Database password used for Creole connection.
	 * @deprecated Put password in databaseUrl.
	 */
	private $databasePassword;

	/**
	 * Properties file that maps a data XML file to a particular database.
	 * @var        PhingFile
	 */
	private $datadbmap;

	/**
	 * The database connection used to retrieve the data to dump.
	 * Needs to be public so that the TableInfo class can access it.
	 */
	public $conn;

	/**
	 * The statement used to acquire the data to dump.
	 */
	private $stmt;

	/**
	 * Set the file that maps between data XML files and databases.
	 *
	 * @param      PhingFile $sqldbmap the db map
	 * @return     void
	 */
	public function setDataDbMap(PhingFile $datadbmap)
	{
		$this->datadbmap = $datadbmap;
	}

	/**
	 * Get the file that maps between data XML files and databases.
	 *
	 * @return     PhingFile $datadbmap.
	 */
	public function getDataDbMap()
	{
		return $this->datadbmap;
	}

	/**
	 * Get the database name to dump
	 *
	 * @return     The DatabaseName value
	 */
	public function getDatabaseName()
	{
		return $this->databaseName;
	}

	/**
	 * Set the database name
	 *
	 * @param      v The new DatabaseName value
	 */
	public function setDatabaseName($v)
	{
		$this->databaseName = $v;
	}

	/**
	 * Get the database url
	 *
	 * @return     The DatabaseUrl value
	 */
	public function getDatabaseUrl()
	{
		return $this->databaseUrl;
	}

	/**
	 * Set the database url
	 *
	 * @param      string $v The PEAR-compatible database DSN URL.
	 */
	public function setDatabaseUrl($v)
	{
		$this->databaseUrl = $v;
	}

	/**
	 * Get the database user
	 *
	 * @return     string database user
	 * @deprecated
	 */
	public function getDatabaseUser()
	{
		return $this->databaseUser;
	}

	/**
	 * Set the database user
	 *
	 * @param      string $v The new DatabaseUser value
	 * @deprecated Specify user in DSN URL.
	 */
	public function setDatabaseUser($v)
	{
		$this->databaseUser = $v;
	}

	/**
	 * Get the database password
	 *
	 * @return     string database password
	 */
	public function getDatabasePassword()
	{
		return $this->databasePassword;
	}

	/**
	 * Set the database password
	 *
	 * @param      string $v The new DatabasePassword value
	 * @deprecated Specify database password in DSN URL.
	 */
	public function setDatabasePassword($v)
	{
		$this->databasePassword = $v;
	}

	/**
	 * Get the database driver name
	 *
	 * @return     string database driver name
	 */
	public function getDatabaseDriver()
	{
		return $this->databaseDriver;
	}

	/**
	 * Set the database driver name
	 *
	 * @param      string $v The new DatabaseDriver value
	 */
	public function setDatabaseDriver($v)
	{
		$this->databaseDriver = $v;
	}

	/**
	 * Create the data XML -> database map.
	 *
	 * This is necessary because there is currently no other method of knowing which
	 * data XML files correspond to which database.  This map allows us to convert multiple
	 * data XML files into SQL.
	 *
	 * @throws     IOException - if unable to store properties
	 */
	private function createDataDbMap()
	{
		if ($this->getDataDbMap() === null) {
			return;
		}

		// Produce the sql -> database map
		$datadbmap = new Properties();

		// Check to see if the sqldbmap has already been created.
		if ($this->getDataDbMap()->exists()) {
			$datadbmap->load($this->getDataDbMap());
		}

		foreach ($this->getDataModels() as $dataModel) {            // there is really one 1 db per datamodel
			foreach ($dataModel->getDatabases() as $database) {

				// if database name is specified, then we only want to dump that one db.
				if (empty($this->databaseName) || ($this->databaseName && $database->getName() == $this->databaseName)) {
					$outFile = $this->getMappedFile($dataModel->getName());
					$datadbmap->setProperty($outFile->getName(), $database->getName());
				}
			}
		}

		try {
			$datadbmap->store($this->getDataDbMap(), "Data XML file -> Database map");
		} catch (IOException $e) {
			throw new IOException("Unable to store properties: ". $e->getMessage());
		}
	}

	/**
	 * Iterates through each datamodel/database, dumps the contents of all tables and creates a DOM XML doc.
	 *
	 * @return     void
	 * @throws     BuildException
	 */
	public function main()
	{
		$this->validate();

		$buf = "Database settings:\n"
			. " driver: " . ($this->databaseDriver ? $this->databaseDriver : "(default)" ). "\n"
			. " URL: " . $this->databaseUrl . "\n"
			. ($this->databaseUser ? " user: " . $this->databaseUser . "\n" : "") // deprecated
			. ($this->databasePassword ? " password: " . $this->databasePassword . "\n" : ""); // deprecated

		$this->log($buf, PROJECT_MSG_VERBOSE);

		// 1) First create the Data XML -> database name map.
		$this->createDataDbMap();

		// 2) Now go create the XML files from teh database(s)
		foreach ($this->getDataModels() as $dataModel) {            // there is really one 1 db per datamodel
			foreach ($dataModel->getDatabases() as $database) {

				// if database name is specified, then we only want to dump that one db.
				if (empty($this->databaseName) || ($this->databaseName && $database->getName() == $this->databaseName)) {

					$outFile = $this->getMappedFile($dataModel->getName());

					$this->log("Dumping data to XML for database: " . $database->getName());
					$this->log("Writing to XML file: " . $outFile->getName());

					try {

						$url = str_replace("@DB@", $database->getName(), $this->databaseUrl);

						$buf = "Database settings:\n"
						. " driver: " . ($this->databaseDriver ? $this->databaseDriver : "(default)" ). "\n"
						. " URL: " . $url . "\n"
						. ($this->databaseUser ? " user: " . $this->databaseUser . "\n" : "")
						. ($this->databasePassword ? " password: " . $this->databasePassword . "\n" : "");

						$this->log($buf, PROJECT_MSG_VERBOSE);

						$dsn = Creole::parseDSN($url);

						// deprecated, but here for BC
						if ($this->databaseUser) {
							$dsn['username'] = $this->databaseUser;
						}

						if ($this->databasePassword) {
							$dsn['password'] = $this->databasePassword;
						}

						if ($this->databaseName) {
							$dsn['database'] = $this->databaseName;
						}

						if ($this->databaseDriver) {
							Creole::registerDriver($dsn['phptype'], $this->databaseDriver);
						}

						$this->conn = Creole::getConnection($dsn);

						$doc = $this->createXMLDoc($database);
						$doc->save($outFile->getAbsolutePath());

					} catch (SQLException $se) {
						$this->log("SQLException while connecting to DB: ". $se->getMessage(), PROJECT_MSG_ERR);
						throw new BuildException($se);
					}
				} // if databaseName && database->getName == databaseName
			} // foreach database
		} // foreach datamodel
	}

	/**
	 * Gets ResultSet of query to fetch all data from a table.
	 * @param      string $tableName
	 * @return     ResultSet
	 */
	private function getTableDataRS($tableName) {
		// Set Statement object in associated PropelDataDump
		// instance.
		return $this->conn->createStatement()->executeQuery("SELECT * FROM " . $this->getPlatformForTargetDatabase()->quoteIdentifier ( $tableName ) );
	}

	/**
	 * Creates a DOM document containing data for specified database.
	 * @param      Database $database
	 * @return     DOMDocument
	 */
	private function createXMLDoc(Database $database) {

		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->formatOutput = true; // pretty printing
		$doc->appendChild($doc->createComment("Created by data/dump/Control.tpl template."));

		$dsNode = $doc->createElement("dataset");
		$dsNode->setAttribute("name", "all");
		$doc->appendChild($dsNode);

		$this->log("Building DOM tree containing data from tables:");

		foreach ($database->getTables() as $tbl) {
			$this->log("\t+ " . $tbl->getName());
			$rs = $this->getTableDataRS($tbl->getName());
			while ($rs->next()) {
				$rowNode = $doc->createElement($tbl->getPhpName());
				foreach ($tbl->getColumns() as $col) {
					$cval = $rs->get($col->getName());
					if ($cval !== null) {
						$rowNode->setAttribute($col->getPhpName(), iconv($this->dbEncoding, 'utf-8', $cval));
					}
				}
				$dsNode->appendChild($rowNode);
				unset($rowNode);
			}
			$rs->close();
		}

		return $doc;
	}
}

<?php
/*
 *  $Id$
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
 * <http://creole.phpdb.org>.
 */

require_once 'creole/metadata/DatabaseInfo.php';

/**
 * MySQL implementation of DatabaseInfo.
 *
 * @author    Hans Lellelid <hans@xmpl.org>
 * @version   $Revision$
 * @package   creole.drivers.pgsql.metadata
 */
class PgSQLDatabaseInfo extends DatabaseInfo {

    /**
     * @throws SQLException
     * @return void
     */
    protected function initTables()
    {
        include_once 'creole/drivers/pgsql/metadata/PgSQLTableInfo.php';
        
        // Get Database Version
	// TODO: www.php.net/pg_version
        $result = pg_query ($this->conn->getResource(), "SELECT version() as ver");
        
        if (!$result)
        {
        	throw new SQLException ("Failed to select database version");
        } // if (!$result)
        $row = pg_fetch_assoc ($result, 0);
        $arrVersion = sscanf ($row['ver'], '%*s %d.%d');
        $version = sprintf ("%d.%d", $arrVersion[0], $arrVersion[1]);
        // Clean up
        $arrVersion = null;
        $row = null;
        pg_free_result ($result);
        $result = null;

        $result = pg_query($this->conn->getResource(), "SELECT c.oid, 
														case when n.nspname='public' then c.relname else n.nspname||'.'||c.relname end as relname 
														FROM pg_class c join pg_namespace n on (c.relnamespace=n.oid)
														WHERE c.relkind = 'r'
														  AND n.nspname NOT IN ('information_schema','pg_catalog')
														  AND n.nspname NOT LIKE 'pg_temp%'
														  AND n.nspname NOT LIKE 'pg_toast%'
														ORDER BY relname");

        if (!$result) {
            throw new SQLException("Could not list tables", pg_last_error($this->dblink));
        }

        while ($row = pg_fetch_assoc($result)) {
            $this->tables[strtoupper($row['relname'])] = new PgSQLTableInfo($this, $row['relname'], $version, $row['oid']);
        }
		
		$this->tablesLoaded = true;
    }

    /**
     * PgSQL sequences.
     *
     * @return void
     * @throws SQLException
     */
    protected function initSequences()
    {
     
	 	$this->sequences = array();
		   
        $result = pg_query($this->conn->getResource(), "SELECT c.oid, 
														case when n.nspname='public' then c.relname else n.nspname||'.'||c.relname end as relname 
														FROM pg_class c join pg_namespace n on (c.relnamespace=n.oid)
														WHERE c.relkind = 'S'
														  AND n.nspname NOT IN ('information_schema','pg_catalog')
														  AND n.nspname NOT LIKE 'pg_temp%'
														  AND n.nspname NOT LIKE 'pg_toast%'
														ORDER BY relname");
														
        if (!$result) {
            throw new SQLException("Could not list sequences", pg_last_error($this->dblink));
        }
		
		while ($row = pg_fetch_assoc($result)) {
			// FIXME -- decide what info we need for sequences & then create a SequenceInfo object (if needed)
			$obj = new stdClass;
			$obj->name = $row['relname'];
			$obj->oid = $row['oid'];
            $this->sequences[strtoupper($row['relname'])] = $obj;
        }
		
    }

}


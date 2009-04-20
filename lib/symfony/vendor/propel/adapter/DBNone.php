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
 * <http://propel.phpdb.org>.
 */
 
require_once 'propel/adapter/DBAdapter.php';

/**
 * This DatabaseHandler is used when you do not have a database
 * installed.
 *
 * @author Hans Lellelid <hans@xmpl.org> (Propel)
 * @author Jon S. Stevens <jon@clearink.com> (Torque)
 * @author Brett McLaughlin <bmclaugh@algx.net> (Torque)
 * @version $Revision$
 * @package propel.adapter
 */
class DBNone extends DBAdapter {

    /**
     * @return null
     */
    public function getConnection()
    {
        return null;
    }

    /**
     * @see DBAdapter::init()
     */
    public function init($url, $username, $password)
    {
    }

    /**
     * This method is used to ignore case.
     *
     * @param in The string to transform to upper case.
     * @return The upper case string.
     */
    public function toUpperCase($in)
    {
        return $in;
    }

    /**
     * This method is used to ignore case.
     *
     * @param in The string whose case to ignore.
     * @return The string in a case that can be ignored.
     */
    public function ignoreCase($in)
    {
        return $in;
    }    

    /**
     * Returns SQL which concatenates the second string to the first.
     *
     * @param string String to concatenate.
     * @param string String to append.
     * @return string 
     */
    public function concatString($s1, $s2)
    {
        return ($s1 . $s2);
    }

    /**
     * Returns SQL which extracts a substring.
     *
     * @param string String to extract from.
     * @param int Offset to start from.
     * @param int Number of characters to extract.
     * @return string 
     */
    public function subString($s, $pos, $len)
    {
        return substr($s, $pos, $len);
    }

    /**
     * Returns SQL which calculates the length (in chars) of a string.
     *
     * @param string String to calculate length of.
     * @return string 
     */
    public function strLength($s)
    {
        return strlen($s);
    }
 
    /**
     * Locks the specified table.
     *
     * @param Connection $con The Creole connection to use.
     * @param string $table The name of the table to lock.
     * @throws SQLException No Statement could be created or executed.
     */
    public function lockTable(Connection $con, $table)
    {
    }

    /**
     * Unlocks the specified table.
     *
     * @param Connection $con The Creole connection to use.
     * @param string $table The name of the table to unlock.
     * @throws SQLException No Statement could be created or executed.
     */
    public function unlockTable(Connection $con, $table)
    {
    }
}
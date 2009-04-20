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
 
require_once 'creole/CreoleTypes.php';

/**
 * Oracle types / type map.
 *
 * @author    David Giffin <david@giffin.org>
 * @author    Hans Lellelid <hans@xmpl.org>
 * @version   $Revision$
 * @package   creole.drivers.oracle
 */
class OCI8Types extends CreoleTypes {

    /** Map Oracle native types to Creole (JDBC) types. */
    private static $typeMap = array(
                                'char' => CreoleTypes::CHAR,
                                'varchar2' => CreoleTypes::VARCHAR,
                                'long' => CreoleTypes::LONGVARCHAR,
                                'number' => CreoleTypes::NUMERIC,
                                'float' => CreoleTypes::FLOAT,
                                'integer' => CreoleTypes::INTEGER,
                                'smallint' => CreoleTypes::SMALLINT,
                                'double' => CreoleTypes::DOUBLE,
                                'raw' => CreoleTypes::VARBINARY,
                                'longraw' => CreoleTypes::LONGVARBINARY,
                                'date' => CreoleTypes::DATE,
                                'timestamp' => CreoleTypes::TIMESTAMP,
                                'blob' => CreoleTypes::BLOB,
                                'clob' => CreoleTypes::CLOB,
                                'varray' => CreoleTypes::ARR,
                                );
    
    /** Reverse mapping, created on demand. */
    private static $reverseMap = null;
    
    /**
     * This method returns the generic Creole (JDBC-like) type
     * when given the native db type.
     * @param string $nativeType DB native type (e.g. 'TEXT', 'byetea', etc.).
     * @return int Creole native type (e.g. CreoleTypes::LONGVARCHAR, CreoleTypes::BINARY, etc.).
     */
    public static function getType($nativeType)
    {
        $t = str_replace(' ', '', strtolower($nativeType));
        if ( substr($t, 0, 9) == 'timestamp' ) return CreoleTypes::TIMESTAMP;
        if (isset(self::$typeMap[$t])) {
            return self::$typeMap[$t];
        } else {
            return CreoleTypes::OTHER;
        }
    }
            
    /**
     * This method will return a native type that corresponds to the specified
     * Creole (JDBC-like) type.
     * If there is more than one matching native type, then the LAST defined 
     * native type will be returned.
     * @param int $creoleType
     * @return string Native type string.
     */
    public static function getNativeType($creoleType)
    {
        if (self::$reverseMap === null) {
            self::$reverseMap = array_flip(self::$typeMap);
        }
        return @self::$reverseMap[$creoleType];
    }
                                
}

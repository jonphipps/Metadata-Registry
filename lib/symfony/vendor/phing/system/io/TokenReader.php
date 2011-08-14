<?php
/*
 *  $Id: TokenReader.php,v 1.3 2003/11/19 05:48:29 hlellelid Exp $
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
 * <http://phing.info>.
*/

include_once 'phing/system/io/Reader.php';
include_once 'phing/filters/ReplaceTokens.php'; // for class Token

/**
 * Abstract class for reading Tokens from a resource
 *
 * @author    Manuel Holtgewe
 * @version   $Revision: 1.3 $
 * @access    public
 * @package   phing.system.io
 */
class TokenReader extends Reader {

    /**
     * Constructor
     */
    function __construct() {
    }

    /**
     * Reads a token from the resource and returns it as a
     * Token object.
     *
     * @access  public
     */
    function readToken() {
    }
}

?>

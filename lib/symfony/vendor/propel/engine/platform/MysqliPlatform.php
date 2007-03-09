<?php
/*
 *  $Id: MysqliPlatform.php 536 2007-01-10 14:30:38Z heltem $
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

require_once 'propel/engine/platform/MysqlPlatform.php';

/**
 * MySql Platform implementation, using new mysqli API.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @version    $Revision: 536 $
 * @package    propel.engine.platform
 */
class MysqliPlatform extends MysqlPlatform {

	/**
	 * Initializes db specific domain mapping.
	 */
	protected function initialize()
	{
		parent::initialize();

		// HL -- commenting these out, as it turns out that while the date format is fixed
		// there is still a special meaning to TIMESTAMP in MySQL 4.1+
		// $this->setSchemaDomainMapping(new Domain(PropelTypes::TIMESTAMP, "TIMESTAMP"));
		// $this->setSchemaDomainMapping(new Domain(PropelTypes::BU_TIMESTAMP, "TIMESTAMP"));
	}

	/**
	 * Escape the string for MySQL.
	 *
	 * @param      string $text
	 * @return     string
	 */
	public function escapeText($text) {
		// Because mysqli requires open connection, we are using addslashes() here.
		// This needs to be fixed in a better way ...
		return addslashes($text);
	}

}

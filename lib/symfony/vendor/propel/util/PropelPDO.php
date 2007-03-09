<?php
/*
 *  $Id: PropelPDO.php 521 2007-01-05 13:29:36Z heltem $
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


/**
 * PDO connection subclass that provides some enhanced functionality needed by Propel.
 *
 * This class was designed to work around the limitation in PDO where attempting to begin
 * a transaction when one has already been begun will trigger a PDOException.  Propel
 * relies on the ability to create nested transactions, even if the underlying layer
 * simply ignores these (because it doesn't support nested transactions).
 *
 * The changes that this class makes to the underlying API include the addition of the
 * getNestedTransactionDepth() and isInTransaction() and the fact that beginTransaction()
 * will no longer throw a PDOException (or trigger an error) if a transaction is already
 * in-progress.
 *
 * @author     Cameron Brunner <cameron.brunner@gmail.com>
 * @author     Hans Lellelid <hans@xmpl.org>
 * @since      2006-09-22
 * @package    propel.util
 */
class PropelPDO extends PDO {

	/**
	 * The current transaction depth.
	 * @var        int
	 */
	protected $nestedTransactionCount = 0;

	/**
	 * Gets the current transaction depth.
	 * @return     int
	 */
	public function getNestedTransactionCount()
	{
		return $this->nestedTransactionCount;
	}

	/**
	 * Set the current transaction depth.
	 * @param      int $v The new depth.
	 */
	protected function setNestedTransactionCount($v)
	{
		$this->nestedTransactionCount = $v;
	}

	/**
	 * Decrements the current transaction depth by one.
	 */
	protected function decrementNestedTransactionCount()
	{
		$this->nestedTransactionCount--;
	}

	/**
	 * Increments the current transaction depth by one.
	 */
	protected function incrementNestedTransactionCount()
	{
		$this->nestedTransactionCount++;
	}

	/**
	 * Is this PDO connection currently in-transaction?
	 * This is equivalent to asking whether the current nested transaction count
	 * is greater than 0.
	 * @return     boolean
	 */
	public function isInTransaction()
	{
		return ($this->getNestedTransactionCount() > 0);
	}

	/**
	 * Overrides PDO::beginTransaction() to prevent errors due to already-in-progress transaction.
	 */
	public function beginTransaction()
	{
		$opcount = $this->getNestedTransactionCount();
		if ( $opcount === 0 ) {
			parent::beginTransaction();
		}
		$this->incrementNestedTransactionCount();
	}

	/**
	 * Overrides PDO::commit() to only commit the transaction if we are in the outermost
	 * transaction nesting level.
	 */
	public function commit()
	{
		$opcount = $this->getNestedTransactionCount();
		if ($opcount > 0) {
			if ($opcount === 1) {
				parent::commit();
			}
			$this->decrementNestedTransactionCount();
		}
	}

	/**
	 * Overrides PDO::rollback() to only rollback the transaction if we are in the outermost
	 * transaction nesting level.
	 */
	public function rollback()
	{
		$opcount = $this->getNestedTransactionCount();
		if ($opcount > 0) {
			if ($opcount === 1) {
				parent::rollback();
			}
			$this->decrementNestedTransactionCount();
		}
	}

	/**
	 * Overrides PDO::prepare() to add logging.
	 */
	public function prepare($sql)
	{
		Propel::log($sql, Propel::LOG_DEBUG);
		return parent::prepare($sql);
	}
}

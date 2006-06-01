<?php
/**
 * $Id: PHPUnit2TestRunner.php,v 1.9 2005/05/23 15:21:13 sb Exp $
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

require_once 'PHPUnit2/Framework/TestListener.php';
require_once 'PHPUnit2/Framework/TestResult.php';
require_once 'PHPUnit2/Framework/TestSuite.php';

require_once 'phing/system/util/Timer.php';

/**
 * Simple Testrunner for PHPUnit2 that runs all tests of a testsuite.
 *
 * @author Michiel Rook <michiel@trendserver.nl>
 * @version $Id: PHPUnit2TestRunner.php,v 1.9 2005/05/23 15:21:13 sb Exp $
 * @package phing.tasks.ext.phpunit2
 * @since 2.1.0
 */
class PHPUnit2TestRunner
{
	const SUCCESS = 0;
	const FAILURES = 1;
	const ERRORS = 2;

	private $test = NULL;
	private $suite = NULL;
	private $retCode = 0;
	private $formatters = array();

	function __construct(PHPUnit2_Framework_TestSuite $suite)
	{
		$this->suite = $suite;
		$this->retCode = self::SUCCESS;
	}

	function addFormatter(PHPUnit2_Framework_TestListener $formatter)
	{
		$this->formatters[] = $formatter;
	}

	function run()
	{
		$res = new PHPUnit2_Framework_TestResult();

		include_once 'PHPUnit2/Runner/Version.php';	
		if (version_compare(PHPUnit2_Runner_Version::id(), '2.3.0', '>=')) {
			$res->collectCodeCoverageInformation(TRUE);
		}

		foreach ($this->formatters as $formatter)
		{
			$res->addListener($formatter);
		}

		$this->suite->run($res);

		if ($this->retCode != self::SUCCESS && $res->errorCount() != 0)
		{
			$this->retCode = self::ERRORS;
		}

		else if ($res->failureCount() != 0 || $res->notImplementedCount() != 0)
		{
			$this->retCode = self::FAILURES;
		}
	}

	function getRetCode()
	{
		return $this->retCode;
	}
}
?>
<?php
/**
 * $Id: CoverageFormatter.php,v 1.10 2005/05/26 13:10:52 mrook Exp $
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

require_once 'PHPUnit2/Framework/Test.php';

require_once 'phing/tasks/ext/phpunit2/PHPUnit2ResultFormatter.php';

/**
 * Saves coverage output of the test to a specified database
 *
 * @author Michiel Rook <michiel@trendserver.nl>
 * @version $Id: CoverageFormatter.php,v 1.10 2005/05/26 13:10:52 mrook Exp $
 * @package phing.tasks.ext.coverage
 * @since 2.1.0
 */
class CoverageFormatter extends PHPUnit2ResultFormatter
{
	private function mergeCodeCoverage($left, $right)
	{
		$coverageMerged = array();

		reset($left);
		reset($right);

		while (current($left) && current($right))
		{
			$linenr_left = key($left);
			$linenr_right = key($right);

			if ($linenr_left < $linenr_right)
			{
				$coverageMerged[$linenr_left] = current($left);

				next($left);
			}
			else
			if ($linenr_right < $linenr_left)
			{
				$coverageMerged[$linenr_right] = current($right);
				next($right);
			}
			else
			{
				if (current($left) < 0)
				{
					$coverageMerged[$linenr_right] = current($right);
				}
				else
				if (current($right) < 0)
				{
					$coverageMerged[$linenr_right] = current($left);
				}
				else
				{
					$coverageMerged[$linenr_right] = current($left) + current($right);
				}
				
				next($left);
				next($right);
			}
		}

		while (current($left))
		{
			$coverageMerged[key($left)] = current($left);
			next($left);
		}

		while (current($right))
		{
			$coverageMerged[key($right)] = current($right);
			next($right);
		}

		return $coverageMerged;
	}

	function endTest(PHPUnit2_Framework_Test $test)
	{
		parent::endTest($test);
		
		$database = new PhingFile($this->project->getProperty('coverage.database'));

		$props = new Properties();
		$props->load($database);
		
		$coverage = $test->getCodeCoverageInformation();
		
		foreach ($coverage as $filename => $coverageFile)
		{
			$filename = strtolower($filename);
			
			if ($props->getProperty($filename) != null)
			{
				$file = unserialize($props->getProperty($filename));
				$left = $file['coverage'];
				$right = $coverageFile;
				
				$coverageMerged = $this->mergeCodeCoverage($left, $right);
				
				$file['coverage'] = $coverageMerged;

				$props->setProperty($filename, serialize($file));
			}
		}

		$props->store($database);
	}

	function getExtension()
	{
		return ".coverage";
	}
}
?>
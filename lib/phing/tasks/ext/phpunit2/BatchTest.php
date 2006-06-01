<?php
/**
 * $Id: BatchTest.php,v 1.9 2005/09/08 14:15:00 mrook Exp $
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

require_once 'phing/types/FileSet.php';

/**
 * Scans a list of (.php) files given by the fileset attribute, extracts
 * all subclasses of PHPUnit2_Framework_TestCase.
 *
 * @author Michiel Rook <michiel@trendserver.nl>
 * @version $Id: BatchTest.php,v 1.9 2005/09/08 14:15:00 mrook Exp $
 * @package phing.tasks.ext.phpunit2
 * @since 2.1.0
 */
class BatchTest
{
	/** the list of filesets containing the testcase filename rules */
	private $filesets = array();

	/** the reference to the project */
	private $project = NULL;

	/** the classpath to use with Phing::__import() calls */
	private $classpath = NULL;
	
	/**
	 * Create a new batchtest instance
	 *
	 * @param Project the project it depends on.
	 */
	function __construct(Project $project)
	{
		$this->project = $project;
	}
	
	/**
	 * Sets the classname prefix
	 */
	function setPrefix($prefix)
	{
		$this->prefix = $prefix;
	}

	/**
	 * Sets the classpath
	 */
	function setClasspath(Path $classpath)
	{
		if ($this->classpath === null)
		{
			$this->classpath = $classpath;
		}
		else
		{
			$this->classpath->append($classpath);
		}
	}

	/**
	 * Creates a new Path object
	 */
	function createClasspath()
	{
		$this->classpath = new Path();
		return $this->classpath;
	}

	/**
	 * Returns the classpath
	 */
	function getClasspath()
	{
		return $this->classpath;
	}

	/**
	 * Add a new fileset containing the XML results to aggregate
	 *
	 * @param FileSet the new fileset containing XML results.
	 */
	function addFileSet(FileSet $fileset)
	{
		$this->filesets[] = $fileset;
	}

	/**
	 * Iterate over all filesets and return the filename of all files
	 * that end with .php.
	 *
	 * @return array an array of filenames
	 */
	private function getFilenames()
	{
		$filenames = array();

		foreach ($this->filesets as $fileset)
		{
			$ds = $fileset->getDirectoryScanner($this->project);
			$ds->scan();

			$files = $ds->getIncludedFiles();

			foreach ($files as $file)
			{
				if (strstr($file, ".php"))
				{
					$filenames[] = $ds->getBaseDir() . "/" . $file;
				}
			}
		}

		return $filenames;
	}
	
	/**
	 * Filters an array of classes, removes all classes that are not subclasses of PHPUnit2_Framework_TestCase,
	 * or classes that are declared abstract
	 */
	private function filterTests($input)
	{
		$reflect = new ReflectionClass($input);
		
		return is_subclass_of($input, 'PHPUnit2_Framework_TestCase') && (!$reflect->isAbstract());
	}

	/**
	 * Returns an array of PHPUnit2_Framework_TestCase classes that are declared
	 * by the files included by the filesets
	 *
	 * @return array an array of PHPUnit2_Framework_TestCase classes.
	 */
	function elements()
	{
		$filenames = $this->getFilenames();
		
		$declaredClassesOld = get_declared_classes();

		foreach ($filenames as $filename)
		{
			Phing::__import($filename, $this->classpath);
		}
		
		$declaredClassesNew = get_declared_classes();
		
		$declaredClasses = array_diff($declaredClassesNew, $declaredClassesOld);
		
		$elements = array_filter($declaredClasses, array($this, "filterTests"));

		return $elements;
	}
}
?>
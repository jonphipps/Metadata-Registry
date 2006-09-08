<?php
/**
 * $Id: FormatterElement.php 82 2006-07-07 18:15:35Z mrook $
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

require_once 'phing/tasks/ext/phpunit2/XMLPHPUnit2ResultFormatter.php';
require_once 'phing/tasks/ext/phpunit2/PlainPHPUnit2ResultFormatter.php';
require_once 'phing/system/io/PhingFile.php';

/**
 * A wrapper for the implementations of PHPUnit2ResultFormatter.
 *
 * @author Michiel Rook <michiel.rook@gmail.com>
 * @version $Id: FormatterElement.php 82 2006-07-07 18:15:35Z mrook $
 * @package phing.tasks.ext.phpunit2
 * @since 2.1.0
 */
class FormatterElement
{
	protected $formatter = NULL;
	
	protected $type = "";
	
	protected $useFile = true;
	
	protected $toDir = ".";
	
	protected $outfile = "";

	function setType($type)
	{
		$this->type = $type;

		if ($this->type == "xml")
		{
			$destFile = new PhingFile($this->toDir, 'testsuites.xml');
			$this->formatter = new XMLPHPUnit2ResultFormatter();
		}
		else
		if ($this->type == "plain")
		{
			$this->formatter = new PlainPHPUnit2ResultFormatter();
		}
		else
		{
			throw new BuildException("Formatter '" . $this->type . "' not implemented");
		}
	}

	function setClassName($className)
	{
		$classNameNoDot = Phing::import($className);

		$this->formatter = new $classNameNoDot();
	}

	function setUseFile($useFile)
	{
		$this->useFile = $useFile;
	}
	
	function getUseFile()
	{
		return $this->useFile;
	}
	
	function setToDir($toDir)
	{
		$this->toDir = $toDir;
	}
	
	function getToDir()
	{
		return $this->toDir;
	}

	function setOutfile($outfile)
	{
		$this->outfile = $outfile;
	}
	
	function getOutfile()
	{
		if ($this->outfile)
		{
			return $this->outfile;
		}
		else
		{
			return $this->formatter->getPreferredOutfile() . $this->getExtension();
		}
	}
	
	function getExtension()
	{
		return $this->formatter->getExtension();
	}

	function getFormatter()
	{
		return $this->formatter;
	}
}
?>
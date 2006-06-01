<?php
/**
 * $Id: SvnLastRevisionTask.php,v 1.6 2005/02/27 20:52:10 mrook Exp $
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

require_once 'phing/Task.php';

/**
 * Stores the number of the last revision of a workingcopy in a property
 *
 * @author Michiel Rook <michiel@trendserver.nl>
 * @version $Id: SvnLastRevisionTask.php,v 1.6 2005/02/27 20:52:10 mrook Exp $
 * @package phing.tasks.ext.svn
 * @see VersionControl_SVN
 * @since 2.1.0
 */
class SvnLastRevisionTask extends Task
{
	private $workingCopy = "";
	private $svnPath = "/usr/bin/svn";
	private $propertyName = "svn.lastrevision";

	/**
	 * Initialize Task.
 	 * This method includes any necessary SVN libraries and triggers
	 * appropriate error if they cannot be found.  This is not done in header
	 * because we may want this class to be loaded w/o triggering an error.
	 */
	function init() {
		include_once 'VersionControl/SVN.php';
		if (!class_exists('VersionControl_SVN')) {
			throw new Exception("SvnLastRevisionTask depeneds on PEAR VersionControl_SVN package being installed.");
		}
	}

	/**
	 * Sets the path to the workingcopy
	 */
	function setWorkingCopy($workingCopy)
	{
		$this->workingCopy = $workingCopy;
	}

	/**
	 * Returns the path to the workingcopy
	 */
	function getWorkingCopy()
	{
		return $this->workingCopy;
	}

	/**
	 * Sets the path/URI to the repository
	 */
	function setSvnPath($svnPath)
	{
		$this->svnPath = $svnPath;
	}

	/**
	 * Returns the path/URI to the repository
	 */
	function getSvnPath()
	{
		return $this->svnPath;
	}

	/**
	 * Sets the name of the property to use
	 */
	function setPropertyName($propertyName)
	{
		$this->propertyName = $propertyName;
	}

	/**
	 * Returns the name of the property to use
	 */
	function getPropertyName()
	{
		return $this->propertyName;
	}

	/**
	 * The main entry point
	 *
	 * @throws BuildException
	 */
	function main()
	{
		// Set up runtime options. Will be passed to all
		// subclasses.
		$options = array('fetchmode' => VERSIONCONTROL_SVN_FETCHMODE_ASSOC, 'svn_path' => $this->getSvnPath());

		// Pass array of subcommands we need to factory
		$svn = VersionControl_SVN::factory(array('info'), $options);

		$args = array($this->getWorkingCopy());

		if ($output = $svn->info->run())
		{
			if (preg_match('/Last Changed Rev:[\s]+([\d]+)/', $output, $matches))
			{
				$this->project->setProperty($this->getPropertyName(), $matches[1]);
			}
			else
			{
				throw new BuildException("Failed to parse the output of 'svn info'.");
			}
		}
		else
		{
			throw new BuildException("Failed to run the 'svn info' command");
		}
	}
}
?>
<?php
/*
 *  $Id: ProjectComponent.php,v 1.5 2003/12/24 13:02:08 hlellelid Exp $
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

/**
 *  Abstract class providing properties and methods common to all
 *  the project components
 *
 * @author    Andreas Aderhold <andi@binarycloud.com>
 * @author    Hans Lellelid <hans@xmpl.org> 
 * @version   $Revision: 1.5 $
 * @package   phing
 */
abstract class ProjectComponent {

    /**
     *  Holds a reference to the project that a project component
     *  (a task, a target, etc.) belongs to
     *
     *  @var    object  A reference to the current project instance
     */
    protected $project = null;

    /**
     *  References the project to the current component.
     *
     *  @param    object    The reference to the current project
     *  @access   public
     */
    function setProject($project) {
        $this->project = $project;
    }

    /**
     *  Returns a reference to current project
     *
     *  @return   object   Reference to current porject object
     *  @access   public
     */
    function getProject() {
        return $this->project;
    }

    /**
     *  Logs a message with the given priority.
     *
     *  @param  string   The message to be logged.
     *  @param  integer  The message's priority at this message should have
     */
    public function log($msg, $level = PROJECT_MSG_INFO) {
        if ($this->project !== null) {
            $this->project->log($msg, $level);
        }
    }
}

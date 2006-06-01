<?php
/*
 *  $Id: OsCondition.php,v 1.7 2003/12/24 13:02:09 hlellelid Exp $
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

require_once 'phing/tasks/system/condition/ConditionBase.php';

/**
 *  Condition that tests the OS type.
 *
 *  @author    Andreas Aderhold <andi@binarycloud.com>
 *  @copyright � 2001,2002 THYRELL. All rights reserved
 *  @version   $Revision: 1.7 $ $Date: 2003/12/24 13:02:09 $
 *  @access    public
 *  @package   phing.tasks.system.condition
 */
class OsCondition implements Condition {

    private $family;

    function setFamily($f) {
        $this->family = strtolower($f);
    }

    function evaluate() {
        $osName = strtolower(Phing::getProperty("os.name"));
        $pathSep = Phing::getProperty("path.separator");
        if ($this->family !== null) {
            if ($this->family === "windows") {
                return strpos($osName, "win") !== false;
            } elseif ($this->family === "dos") {
                return $pathSep === ";";
            } elseif ($this->family === "mac") {
                return strpos($osName, "mac") !== false;
            } elseif ($this->family === ("unix")) {
                return ($pathSep === ":"
                    && (!StringHelper::startsWith($osName, "mac") || StringHelper::endsWith($osName, "x")));
            }
            throw new BuildException("Don't know how to detect os family '" . $this->family . "'");
        }
        return false;
    }

}

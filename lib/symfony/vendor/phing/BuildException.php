<?php
/*
 *  $Id: BuildException.php,v 1.12 2005/02/27 20:52:07 mrook Exp $
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
 * BuildException is for when things go wrong in a build execution.
 *
 * @author   Andreas Aderhold <andi@binarycloud.com>
 * @version  $Revision: 1.12 $
 * @package  phing
 */
class BuildException extends Exception {

    /** location in the xml file */
    protected $location = null; 
            
    /** The nested "cause" exception. */
    protected $cause;
    
    /**
     * Construct a BuildException.
     * Supported signatures:
     *         throw new BuildException($causeExc);
     *         throw new BuildException($msg);
     *         throw new Buildexception($causeExc, $loc);
     *         throw new BuildException($msg, $causeExc);
     *         throw new BuildException($msg, $loc);
     *         throw new BuildException($msg, $causeExc, $loc);
     */
    function __construct($p1, $p2 = null, $p3 = null) {        
        
        $cause = null;
        $loc = null;
        $msg = "";
        
        if ($p3 !== null) {
            $cause = $p2;
            $loc = $p3;
            $msg = $p1;
        } elseif ($p2 !== null) {
            if ($p2 instanceof Exception) {
                $cause = $p2;
                $msg = $p1;
            } elseif ($p2 instanceof Location) {
                $loc = $p2;
                if ($p1 instanceof Exception) {
                    $cause = $p1;
                } else {
                    $msg = $p1;
                }
            }
        } elseif ($p1 instanceof Exception) {
            $cause = $p1;
        } else {
            $msg = $p1;
        }
        
        parent::__construct($msg);
        
        if ($cause !== null) {
            $this->cause = $cause;
            $this->message .= " [wrapped: " . $cause->getMessage() ."]";
        }
        
        if ($loc !== null) {
            $this->setLocation($loc);
        }                
    }
    
    function getCause() {
        return $this->cause;
    }
    
    function getLocation() {
        return $this->location;
    }

    function setLocation($loc) {        
        $this->location = $loc;
        $this->message = $loc->toString() . ': ' . $this->message;
    }

}

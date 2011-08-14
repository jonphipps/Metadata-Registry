<?php
  /**
  * description
  *
  *
  * @package      Metadata Registry
  * @subpackage   ARC2 Extensions
  * @author       @link mailto:jphipps@madcreek.com?subject=Re:Registry_code Jon Phipps}.
  * Date created: 08/18/2009
  * @version      Release: @package_version@
  */

  class Reg_ARC2_Store extends ARC2_Store
  {
    //add function to clear errors
    function clearErrors() {
      unset($this->errors);
    }

    //add function to clear warnings
    function clearWarnings() {
      unset($this->warnings);
    }

  }
?>

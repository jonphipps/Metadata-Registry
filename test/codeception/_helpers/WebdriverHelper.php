<?php
  /**
   * Created by jonphipps, on 2014-05-02 at 5:43 PM
   * for the registry.dev project
   */

  namespace Codeception\Module;

  class WebdriverHelper extends WebDriver {

    public function _afterSuite($settings = array()) {
      //$this->_initializeSession();
      $this->debug("\nrunning after suite\n");
      if (isset($this->webDriver)) {
        $this->debug("\ndeleting session\n\n");
        $this->webDriver->manage()->deleteAllCookies();
        $this->webDriver->manage()->quit();
        $this->webDriver = null;
      }
      parent::_afterSuite($settings);
    }

  }

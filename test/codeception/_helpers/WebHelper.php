<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module;

class WebHelper extends Module
{
  /**
   * @param int $width
   * @param int $height
   *
   * @throws \Codeception\Exception\Module
   */
  public function setWindowSize($width, $height) {
    /** @var $module WebDriver */
    $module = $this->getModule("WebDriver");
    $module->resizeWindow($width, $height);
  }

}

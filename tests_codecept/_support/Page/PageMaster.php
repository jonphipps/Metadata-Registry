<?php

/** This is the master page and contains all of the master layout page actions and elements */

namespace Page;

abstract class PageMaster
{

  // include url of current page
  public static $URL = '';

  /**
   * @var array
   */
  private $requiredData = [];

  /**
   * @var array
   */
  private $optionalData = [];


  /**
   * @return array
   */
  public function getRequired(): array
  {
    return $this->requiredData;
  }


  /**
   * @return array
   */
  public function getOptional()
  {
    return $this->optionalData;
  }

  /**
   * Declare UI map for this page here. CSS or XPath allowed.
   * public static $usernameField = '#username';
   * public static $formSubmitButton = "#mainForm input[type=submit]";
   */

  /**
   * Basic route example for your current URL
   * You can append any additional parameter to URL
   * and use it in tests like: Page\Edit::route('/123-post');
   */
  public static function route($param)
  {
    return static::$URL . $param;
  }

}

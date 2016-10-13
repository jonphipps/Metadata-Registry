<?php

/**
 * Subclass for representing a row from the 'profile_property' table.
 *
 *
 *
 * @package lib.model
 */
class ProfileProperty extends BaseProfileProperty
{
  /**
  * to string
  *
  * @return string
  */
  public function __toString()
  {
    return $this->getLabel();
  }


  /**
   * @param int $counter
   * @param string $language
   *
   * @return string
   */
  public function getLabelForExport($counter, $language = '')
  {
    $label = $this->getLabel();
    $label = $this->getIsRequired() ? "*" . $label : $label;
    if ($this->getHasLanguage()) {
      $label = $this->getIsSingleton() ? $label . "_" . $language : $label . "[$counter]_" . $language;
    } else {
      $label = $this->getIsSingleton() ? $label : $label . "[$counter]";
    }
    return $label;

  } //__toString
}

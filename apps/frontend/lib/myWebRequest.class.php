<?php

class myWebRequest extends sfWebRequest
{
  /**
  * Retrieves a single param from PathInfo
  *
  * @return string
  * @param  string $param The parameter to return
  */
  public function getPathInfoParam($param)
  {
    $patharray = $this->getPathInfoArray();
    return $patharray[$param];
  }
}


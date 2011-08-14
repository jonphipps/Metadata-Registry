<?php

/**
 * sparql actions.
 *
 * @package    registry
 * @subpackage sparql
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class sparqlActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }

  /**
   * Executes endpoint action
   *
   */
  public function executeEndpoint()
  {
    require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'arc_config.php');

    /* instantiation */
    $ep = ARC2::getStoreEndpoint($arc_config);

    /* request handling */
    $ep->go();
    $this->ep = $ep;

    return sfView::NONE;
  }
}

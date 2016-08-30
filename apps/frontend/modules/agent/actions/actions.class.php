<?php

/**
 * agent actions.
 *
 * @package    registry
 * @subpackage agent
 * @author     Jon Phipps
 * @version    SVN: $Id: actions.class.php 14 2006-04-13 13:08:36Z jphipps $
 */
class agentActions extends autoAgentActions
{

  public function setDefaults($agent)
  {
    $agent->setCountry('US');
    parent::setDefaults($agent);
  }
}

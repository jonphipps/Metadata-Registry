<?php

/**
 * agent actions.
 *
 * @package    registry
 * @subpackage agent
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 14 2006-04-13 13:08:36Z jphipps $
 */
class agentActions extends autoagentActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->getUser()->getAgentCredentials($this->getRequestParameter('id'));
    return;
  }

  public function setDefaults($agent)
  {
    $agent->setCountry('US');
    parent::setDefaults($agent);
  }

}
<?php

/**
 * new account validator.
 *
 * @package    Registry
 * @subpackage user
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: myNewAccountValidator.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class myAgentAdminValidator extends sfValidator
{
  /**
   * Execute this validator.
   *
   * @param mixed $value A file or parameter value/array.
   * @param error $error An error message reference.
   *
   * @return bool true, if this validator executes successfully, otherwise
   *              false.
   */
  public function execute (&$value, &$error)
  {
    $this->getContext()->getRequest()->setAttribute('newaccount', true);

    $agent_id = $this->getContext()->getRequest()->getParameter('agent_id');

    $c = new Criteria();
    $c->add(AgentHasUserPeer::AGENT_ID, $agent_id);
    $c->add(AgentHasUserPeer::IS_ADMIN_FOR, true);
    $adminCount = AgentHasUserPeer::doCount($c);

    // there are still admins if this is set to false?
    if ($value == false && $adminCount <= 1)
    {
      $error = $this->getParameterHolder()->get('limit_error');
      return false;
    }

    return true;
  }

  public function initialize ($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('limit_error', 'There must be at least one');

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}


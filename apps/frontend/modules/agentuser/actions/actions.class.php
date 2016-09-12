                                                                                  
<?php

/**
 * agentuser actions.
 *
 * @package    registry
 * @subpackage agentuser
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 63 2006-06-14 17:31:15Z jphipps $
 */
class agentuserActions extends autoAgentuserActions
{
  public function setDefaults($AgentHasUser)
  {
    $agent = myActionTools::findCurrentAgent();
    if ($agent)
    {
      $AgentHasUser->setAgentId($agent->getId());
    }

    $AgentHasUser->setIsRegistrarFor(false);
      $AgentHasUser->setIsAdminFor(false);

      parent::setDefaults($AgentHasUser);
  }

  public function executeCancel()
  {
    $this->setFilter();
    parent::executeCancel();
  }

  public function executeDelete()
  {
    $this->setFilter();
    parent::executeDelete();
  }

  public function executeList()
  {
      $this->setFilter();
      parent::executeList();
  }


    public function executeEdit()
    {
        $this->getUser()->setAttribute('agent_id', $this->getRequestParameter('agent_id'), 'sf_admin/agent_has_user/filters');
        $this->setFilter();
        return parent::executeEdit();
    }


    private function setFilter()
    {
        $user_id  = $this->getUser()->getAttribute('user_id', '', 'sf_admin/agent_has_user/filters');
        $agent_id = $this->getUser()->getAttribute('agent_id', '', 'sf_admin/agent_has_user/filters');
        if ($user_id) {
            $this->redirectFilter = '?user_id=' . strval($user_id);
        } elseif ($agent_id) {
            $this->redirectFilter = '?agent_id=' . strval($agent_id);
        }
    }

}

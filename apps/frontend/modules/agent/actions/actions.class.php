<?php

/**
 * agent actions.
 *
 * @package    registry
 * @subpackage agent
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class agentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->agent_list = AgentPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->agent = AgentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->agent);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AgentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AgentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($agent = AgentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object agent does not exist (%s).', $request->getParameter('id')));
    $this->form = new AgentForm($agent);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($agent = AgentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object agent does not exist (%s).', $request->getParameter('id')));
    $this->form = new AgentForm($agent);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($agent = AgentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object agent does not exist (%s).', $request->getParameter('id')));
    $agent->delete();

    $this->redirect('agent/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $agent = $form->save();

      $this->redirect('agent/edit?id='.$agent->getId());
    }
  }
}

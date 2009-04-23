<?php

/**
 * sfWebPanelBugs components.
 *
 * @package    sf_sandbox
 * @subpackage sfWebPanelBugs
 * @author     Nikolay Kolev
 */
class sfWebPanelBugsComponents extends sfComponents
{
	
  public function executeList()
  {
  	$this->module = sfContext::getInstance()->getModuleName();
  	$this->action = sfContext::getInstance()->getActionName();
  	$this->app = $this->getContext()->getConfiguration()->getApplication();
  	$this->url = substr($_SERVER['REQUEST_URI'], strlen($this->getRequest()->getRelativeUrlRoot()));
    $c = new Criteria();
    $c->addAscendingOrderByColumn(SfWebpanelBugsPeer::SOLVED);
    $c->addDescendingOrderByColumn(SfWebpanelBugsPeer::DATE_ADDED);
    $c->add(SfWebpanelBugsPeer::MODULE_NAME, $this->module);
    $c->add(SfWebpanelBugsPeer::ACTION_NAME, $this->action);
    $c->add(SfWebpanelBugsPeer::APP_NAME, $this->app);
    $this->bugs = SfWebpanelBugsPeer::doSelect($c);
  }
  
}

?>
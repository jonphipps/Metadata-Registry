<?php

/**
 * home actions.
 *
 * @package    sfBug
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class sfWebPanelBugsActions extends sfActions
{
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete($request)
  {
    $c = new Criteria();
    SfWebpanelBugsPeer::doDelete($this->getRequestParameter('id', 0));
    $this->forward('sfWebPanelBugs', 'list');
  }
  
  public function executeAdd($request)
  {
  	$bug = new SfWebpanelBugs();
  	$bug->setDateAdded(date('Y-m-d H:i:s'));
  	$bug->setDescription(strip_tags($this->getRequestParameter('description')));
  	$bug->setUrl(strip_tags($this->getRequestParameter('uri')));
  	$bug->setTitle(strip_tags($this->getRequestParameter('title')));
  	$bug->setModuleName(strip_tags($this->getRequestParameter('mod', '')));
  	$bug->setActionName(strip_tags($this->getRequestParameter('act', '')));
  	$bug->setAppName(strip_tags($this->getRequestParameter('app', '')));
  	$bug->save();
  	$this->forward('sfWebPanelBugs', 'list');
  }
  
  private function setSolveState($bugId, $state) {
  	$bug = SfWebpanelBugsPeer::retrieveByPK($bugId);
  	
  	if ( $bug ) {
  		$bug->setSolved($state);
  		$bug->save();
  	}
  	$this->forward('sfWebPanelBugs', 'list');
  }
  
  public function executeView($request)
  {
    $this->bug = SfWebpanelBugsPeer::retrieveByPK($this->getRequestParameter('id', 0));
    
    if ( !$this->bug ) {
    	$this->forward('sfWebPanelBugs', 'list');
    }
    
    $this->module = $this->getRequestParameter('mod', '');
  	$this->action = $this->getRequestParameter('act', '');
  	$this->app = $this->getRequestParameter('app', '');
  }
  
  public function executeReopen($request)
  {
  	$this->setSolveState($this->getRequestParameter('id', 0), 0);
  }
  
  public function executeSolve($request)
  {
  	$this->setSolveState($this->getRequestParameter('id', 0), 1);
  }
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList($request)
  {
  	$this->module = $this->getRequestParameter('mod', '');
  	$this->action = $this->getRequestParameter('act', '');
  	$this->app = $this->getRequestParameter('app', '');
    $c = new Criteria();
    $c->addAscendingOrderByColumn(SfWebpanelBugsPeer::SOLVED);
    $c->addDescendingOrderByColumn(SfWebpanelBugsPeer::DATE_ADDED);
    $c->add(SfWebpanelBugsPeer::MODULE_NAME, $this->module);
    $c->add(SfWebpanelBugsPeer::ACTION_NAME, $this->action);
    $c->add(SfWebpanelBugsPeer::APP_NAME, $this->app);
    $this->bugs = SfWebpanelBugsPeer::doSelect($c);
  }
}

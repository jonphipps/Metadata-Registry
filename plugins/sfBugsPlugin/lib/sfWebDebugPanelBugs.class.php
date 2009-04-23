<?php
 
class sfWebDebugPanelBugs extends sfWebDebugPanel
{
	
  static public function listenToAddPanelEvent(sfEvent $event)
  {
    $event->getSubject()->setPanel('bugs', new sfWebDebugPanelBugs($event->getSubject()));
  }
	
  public function getTitle()
  {
    return 'bugs';
  }
 
  public function getPanelTitle()
  {
    return 'Bugs reported for this module and action';
  }
 
  public function getPanelContent()
  {
  	//return 'inner info';
    return get_component('sfWebPanelBugs', 'list', array());
    //return get_partial('sfWebPanelBugs/list', array());
  }
}

?>
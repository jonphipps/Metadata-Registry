<?php

/**
 * sfControlPanel components.
 *
 * @package    sfControlPanelPlugin
 * @author     François Zaninotto
 */
class sfControlPanelComponents extends sfComponents
{
  public function executeDataSidebar()
  {
    if($files = sfFinder::type('file')->name("*Peer.php")->relative()->prune('om')->ignore_version_control()->in(SF_ROOT_DIR.'/lib/model'))
    {
      $this->model_files = $files;
    }     
  } 

  public function executeHeader()
  {
    $tmp1 = str_replace('\\', '/', SF_ROOT_DIR);
    $tmp2 = explode('/', $tmp1);
    $this->project_name = end($tmp2);
    $this->action = $this->getRequestParameter('action');
    $this->module = $this->getRequestParameter('module');
  }   
}


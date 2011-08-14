<?php

class sfDoctrineFinderListener extends Doctrine_EventListener
{
  protected $queries = array();
  protected static $instance = null;

  /**
   * Retrieve the singleton instance of this class.
   *
   * @return sfDoctrineFinderListener A sfDoctrineFinderListener implementation instance.
   */
  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      $class = __CLASS__;
      self::$instance = new $class();
      if (sfConfig::get('sf_debug') && sfConfig::get('sf_logging_enabled'))
      {
        Doctrine_Manager::connection()->addListener(self::$instance);
      }
    }

    return self::$instance;
  }
  
  /**
   * preExecute
   *
   * @param string $Doctrine_Event
   * @return void
   */
  public function preQuery(Doctrine_Event $event)
  {
    $this->queries []= $event->getQuery();
  }
  
  /**
   * preStmtExecute
   *
   * @param string $Doctrine_Event
   * @return void
   */
  public function preStmtExecute(Doctrine_Event $event)
  {
    $query = $event->getQuery();
    $params = $event->getParams();
    foreach($params as $key => $value)
    {
      if(is_numeric($key))
      {
        // it's a '?'
        $query = preg_replace('/\?/', "'".$value."'", $query, 1);
      }
      else
      {
        $params[$key] = "'".$value."'";
      }
    }
    $this->queries []= strtr($query, $params);
  }
  
  public function getLatestQuery()
  {
    return ($count = count($this->queries)) ? $this->queries[$count - 1] : '';
  }
  
  public function getQueries()
  {
    return $this->queries;
  }
}
<?php
class sfDoctrineFinderPager extends sfDoctrinePager
{
  protected 
    $finder;
    
  /**
   * __construct
   *
   * @return void
   */
  public function __construct($class, $defaultMaxPerPage = 10)
  {
    parent::__construct($class, $defaultMaxPerPage);

    $this->setFinder(sfDoctrineFinder::from($class));
  }


  /**
   * Set finder object for the pager
   *
   * @param sfDoctrineFinder $finder
   * @return void
   */
  public function setFinder($finder)
  {
    $this->finder = $finder;
  }
  
  /**
   * Get the finder for the pager
   *
   * @return sfDoctrineFinder $finder
   */
  public function getFinder()
  {
    return $this->finder;
  }

  /**
   * init pager
   *
   * @return void
   */
  public function init()
  {
    $this->setQuery($this->finder->getQueryObject());

    return parent::init();
  }
  
  /**
   * serialize
   *
   * @return void
   */
  public function serialize()
  {
    $vars = get_object_vars($this);
    unset($vars['finder']);
    unset($vars['query']);
    return serialize($vars);
  }
}
<?php
class sfPropelFinderPager extends sfPropelPager
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

    $this->setFinder(sfPropelFinder::from($class));
  }


  /**
   * Set finder object for the pager
   *
   * @param sfPropelFinder $finder
   * @return void
   */
  public function setFinder($finder)
  {
    $this->finder = $finder;
  }
  
  /**
   * Get the finder for the pager
   *
   * @return sfPropelFinder $finder
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
    $hasMaxRecordLimit = ($this->getMaxRecordLimit() !== false);
    $maxRecordLimit = $this->getMaxRecordLimit();

    $finderForCount = clone $this->getFinder();
    $count = $finderForCount->
      offset(0)->
      limit(0)->
      clearGroupByColumns()->
      count();

    $this->setNbResults($hasMaxRecordLimit ? min($count, $maxRecordLimit) : $count);
    
    $this->finder->
      offset(0)->
      limit(0);
      
    if (($this->getPage() == 0 || $this->getMaxPerPage() == 0))
    {
      $this->setLastPage(0);
    }
    else
    {
      $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));

      $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
      $this->finder->offset($offset);

      if ($hasMaxRecordLimit)
      {
        $maxRecordLimit = $maxRecordLimit - $offset;
        if ($maxRecordLimit > $this->getMaxPerPage())
        {
          $this->finder->limit($this->getMaxPerPage());
        }
        else
        {
          $this->finder->limit($maxRecordLimit);
        }
      }
      else
      {
        $this->finder->limit($this->getMaxPerPage());
      }
    }
    
  }

  /**
   * Retrieve the object for a certain offset
   *
   * @param integer $offset 
   * @return BaseObject $record
   */
  protected function retrieveObject($offset)
  {
    $finderForRetrieve = clone $this->getFinder();

    return $finderForRetrieve->
      offset($offset - 1)->
      findOne();
  }
  
  /**
   * Retrieve the object for a certain offset
   *
   * @return Array $array of BaseObject instances
   */
  public function getResults()
  {
    return $this->getFinder()->find();
  }
  
}
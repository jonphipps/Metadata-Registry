<?php


class sfDoctrineFinderRecordTemplate extends Doctrine_Template
{
  /**
  * Behavior-like supplementary getter for supplementary columns added by way of withColumn()
  *
  * @param Doctrine_Record $object Propel object
  * @param string $alias Supplementary column name
  *
  * @return mixed The value of the column set by setColumn()
  */
  public function getColumn($alias)
  {
    $relatedObject = $this->getInvoker();

    return $relatedObject[$alias];
  }
}
<?php
// auto-generated by sfPropelCrud
// date: 2007/02/03 15:43:47
?>
<?php

/**
 * concept actions.
 *
 * @package    registry
 * @subpackage concept
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class conceptActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('concept', 'list');
  }

  public function executeList()
  {
    $this->concepts = ConceptPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->concept = ConceptPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->concept);
  }

  public function executeCreate()
  {
    $this->concept = new Concept();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->concept = ConceptPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->concept);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $concept = new Concept();
    }
    else
    {
      $concept = ConceptPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($concept);
    }

    $concept->setId($this->getRequestParameter('id'));
    if ($this->getRequestParameter('last_updated'))
    {
      list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('last_updated'), $this->getUser()->getCulture());
      $concept->setLastUpdated("$y-$m-$d");
    }
    $concept->setUri($this->getRequestParameter('uri'));
    $concept->setPrefLabel($this->getRequestParameter('pref_label'));
    $concept->setVocabularyId($this->getRequestParameter('vocabulary_id') ? $this->getRequestParameter('vocabulary_id') : null);
    $concept->setIsTopConcept($this->getRequestParameter('is_top_concept'));
    $concept->setStatusId($this->getRequestParameter('status_id') ? $this->getRequestParameter('status_id') : null);

    $concept->save();

    return $this->redirect('concept/show?id='.$concept->getId());
  }

  public function executeDelete()
  {
    $concept = ConceptPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($concept);

    $concept->delete();

    return $this->redirect('concept/list');
  }
}

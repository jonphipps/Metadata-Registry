<?php

/**
 * Subclass for representing a row from the 'reg_concept_property_history' table.
 *
 *
 *
 * @package lib.model
 */
/**
 * ConceptPropertyHistory
 *
 * @package
 * @author jphipps
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class ConceptPropertyHistory extends BaseConceptPropertyHistory
{
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getScheme()
  {
    $scheme = VocabularyPeer::retrieveByPK($this->getSchemeId());

    if ($scheme)
    {
      return $scheme->getName();
    }
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getRelatedConcept()
  {
    $concept = ConceptPeer::retrieveByPK($this->getRelatedConceptId());

    if ($concept)
    {
      return $concept->getPrefLabel();
    }
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getPrefLabel()
  {
    return $this->getConceptRelatedByConceptId()->getPrefLabel();
  }
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getUri()
  {
    return $this->getConceptRelatedByConceptId()->getUri();
  }

  /**
  * gets the previous change if the action is 'modified'
  *
  * @return ConceptPropertyHistory object
  * @param  string $historyTimestamp
  * @param  string $propertyId
  */
  function getPrevious()
  {
    $propertyId = $this->getConceptPropertyId();
    $timestamp = $this->getCreatedAt();

    //build the query string
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $propertyId);
    $crit1 = $c->getNewCriterion(ConceptPropertyHistoryPeer::CREATED_AT, $timestamp, Criteria::LESS_THAN);

    // Perform AND at level 0 ($crit0 $crit1 )
    $crit0->addAnd($crit1);
    $c->add($crit0);

    //set order and limits
    $c->setLimit(1);
    $c->addDescendingOrderByColumn(ConceptPropertyHistoryPeer::CREATED_AT);

    $result = ConceptPropertyHistoryPeer::doSelect($c);

    //return the resulting object
    if (count($result))
    {
        $result = $result[0];
    }

    return $result;
  }

  //feed related properties

   /**
   * ConceptPropertyHistory::getFeedTitle()
   *
   * @return
   */
  public function getFeedTitle()
  {
    $title = $this->getVocabularyRelatedByVocabularyId()->getName() .
             " :: " . $this->getConceptRelatedByConceptId()->getPrefLabel() .
             " :: " . $this->getConceptProperty()->getSkosPropertyName() .
             " :: " . $this->getAction();
    return $title;
  }

  /**
   * ConceptPropertyHistory::getFeedLink()
   *
   * @return
   */
//  public function getFeedLink()
//  {
//debugbreak();
//  }

  /**
   * ConceptPropertyHistory::getDescription()
   *
   * @return
   */
  public function getFeedDescription()
  {
    return;
  }

  /**
   * ConceptPropertyHistory::getContent()
   *
   * @return
   */
  public function getFeedContent()
  {
    $uriPrefix = sfContext::getInstance()->getRequest()->getUriPrefix();
    $language = ($this->getLanguage()) ? " (" . $this->getLanguage() . ")" : "";
    $content = "On " .  $this->getCreatedAt("D M j Y") .
               " at " .  $this->getCreatedAt("G:i:s T") . ",  " .
               '<a href="' . $this->getFeedAuthorLink() . '">' .
               $this->getFeedAuthorName() . '</a>, <br />working on the Concept: <a href="' .
               $uriPrefix . "/concept/show/id/" . $this->getConceptId() . '.html">' .
               $this->getConceptProperty()->getConceptRelatedByConceptId()->getPrefLabel() . '</a>, <br />' .
               $this->getAction() . ' the <a href="' .
               $uriPrefix . "/conceptprop/show/id/" . $this->getConceptPropertyId() . '.html">' .
               $this->getConceptProperty()->getSkosPropertyName() . $language . '</a> Property';
    $content .= ('updated' == $this->getAction()) ? '<br /> To: ' : ':';
    $content .= '<div style="background-color:#eeffee; padding:3px" >';
    $content .= $this->getObject();
    $content .= '</div>';
    if ('updated' == $this->getAction())
    {
      $content .= ' From: ';
      $content .= '<div style="background-color:#ffffee; padding:3px" >';
      $previous = $this->getPrevious();
      if ($previous)
      {
        $content .= $previous->getObject();
      }
    $content .= '</div>';
    }

    return $content;
  }

  /**
   * ConceptPropertyHistory::getAuthorEmail()
   *
   * @return
   */
  public function getFeedAuthorEmail()
  {

  }

  /**
   * ConceptPropertyHistory::getAuthorName()
   *
   * @return
   */
  public function getFeedAuthorName()
  {
    $user = $this->getUser();
    $userName = $user->getFirstName() . " " . $user->getLastName();
    if (!rtrim($userName))
    {
      $userName = $user->getNickname();
    }

    return $userName;
  }

  /**
   * ConceptPropertyHistory::getAuthorLink()
   *
   * @return
   */
  public function getFeedAuthorLink()
  {
    $link = sfContext::getInstance()->getRequest()->getUriPrefix() .
            "/user/show/id/" . $this->getCreatedUserId() . ".html";
    return $link;
  }

  /**
   * ConceptPropertyHistory::getPubdate()
   *
   * @return
   */
  public function getFeedPubdate()
  {
    $date = $this->getCreatedAt('U');
    return $date;
  }

  /**
   * ConceptPropertyHistory::getComments()
   *
   * @return
   */
  public function getFeedComments()
  {

  }

  /**
   * ConceptPropertyHistory::getUniqueId()
   *
   * @return
   */
  public function getFeedUniqueId()
  {
    $id = sfContext::getInstance()->getRequest()->getUriPrefix() .
            "/history/show/id/" . $this->getId() . ".html" ;
    return $id;
  }

  /**
   * ConceptPropertyHistory::getEnclosure()
   *
   * @return
   */
  public function getFeedEnclosure()
  {

  }

  /**
   * ConceptPropertyHistory::getCategories()
   *
   * @return
   */
  public function getFeedCategories()
  {

  }



}
<?php
use ForceUTF8\Encoding;

/**
 * Subclass for representing a row from the 'reg_schema_property_element_history' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElementHistory extends BaseSchemaPropertyElementHistory
{

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    return $this->getUserRelatedByCreatedUserId();

  } // getCreatedUser

  /**
  * Gets the property label
  *
  * @return SchemaProperty
  */
  public function getPropertyLabel()
  {
    return $this->getSchemaPropertyRelatedBySchemaPropertyId();

  } // getPropertyLabel

  /**
  * Gets the property uri
  *
  * @return string
  */
  public function getPropertyUri()
  {
    return $this->getSchemaPropertyRelatedBySchemaPropertyId()->getUri();

  } // getPropertyUri

  /**
  * gets the previous change if the action is 'modified'
  *
  * @return ConceptPropertyHistory object
  * @param  string $historyTimestamp
  * @param  string $propertyId
  */
  function getPrevious()
  {
    $propertyId = $this->getSchemaPropertyElementId();
    $timestamp = $this->getCreatedAt();

    //build the query string
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(SchemaPropertyElementHistoryPeer::SCHEMA_PROPERTY_ELEMENT_ID, $propertyId);
    $crit1 = $c->getNewCriterion(SchemaPropertyElementHistoryPeer::CREATED_AT, $timestamp, Criteria::LESS_THAN);

    // Perform AND at level 0 ($crit0 $crit1 )
    $crit0->addAnd($crit1);
    $c->add($crit0);

    //set order and limits
    $c->setLimit(1);
    $c->addDescendingOrderByColumn(SchemaPropertyElementHistoryPeer::CREATED_AT);

    $result = SchemaPropertyElementHistoryPeer::doSelect($c);

    //return the resulting object
    if (count($result))
    {
        $result = $result[0];
    }

    return $result;

  } //getPrevious

  //feed related properties

   /**
   * SchemaPropertyElementHistory::getFeedTitle()
   *
   * @return
   */
  public function getFeedTitle()
  {
    $title = $this->getSchema()->getName() .
             " :: " . $this->getSchemaPropertyRelatedBySchemaPropertyId()->getLabel() .
             " :: " . $this->getProfileProperty()->getLabel() .
             " :: " . $this->getAction();
    return $title;
  }

  /**
   * SchemaPropertyElementHistory::getFeedLink()
   *
   * @return
   */
//  public function getFeedLink()
//  {
//  }

  /**
   * SchemaPropertyElementHistory::getDescription()
   *
   * @return
   */
  public function getFeedDescription()
  {
    return;
  }

  /**
   * SchemaPropertyElementHistory::getContent()
   *
   * @return string
   */
  public function getFeedContent()
  {
    $uriPrefix = sfContext::getInstance()->getRequest()->getUriPrefix();
    $language = ($this->getLanguage()) ? " (" . $this->getLanguage() . ")" : "";
    $content = "On " .  $this->getCreatedAt("D M j Y") .
               " at " .  $this->getCreatedAt("G:i:s T") . ",  " .
               '<a href="' . $this->getFeedAuthorLink() . '">' .
               $this->getFeedAuthorName() . '</a>, <br />working on the Element: <a href="' .
               $uriPrefix . "/schemaprop/show/id/" . $this->getSchemaPropertyId() . '.html">' .
               $this->getSchemaPropertyRelatedBySchemaPropertyId()->getLabel() . '</a>, <br />' .
               $this->getAction() . ' the <a href="' .
               $uriPrefix . "/schemapropel/show/id/" . $this->getSchemaPropertyElementId() . '.html">' .
               $this->getProfileProperty()->getLabel() . $language . '</a> Property';
    $content .= ('updated' == $this->getAction()) ? '<br /> To: ' : ':';
    $content .= '<div style="background-color:#eeffee; padding:3px" >';
    $content .= Encoding::fixUTF8($this->getObject());
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
   * SchemaPropertyElementHistory::getAuthorEmail()
   *
   * @return
   */
  public function getFeedAuthorEmail()
  {

  }

  /**
   * SchemaPropertyElementHistory::getAuthorName()
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
   * SchemaPropertyElementHistory::getAuthorLink()
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
   * SchemaPropertyElementHistory::getPubdate()
   *
   * @return
   */
  public function getFeedPubdate()
  {
    $date = $this->getCreatedAt('U');
    return $date;
  }

  /**
   * SchemaPropertyElementHistory::getComments()
   *
   * @return
   */
  public function getFeedComments()
  {

  }

  /**
   * SchemaPropertyElementHistory::getUniqueId()
   *
   * @return
   */
  public function getFeedUniqueId()
  {
    $id = sfContext::getInstance()->getRequest()->getUriPrefix() .
            "/schemahistory/show/id/" . $this->getId() . ".html" ;
    return $id;
  }

  /**
   * SchemaPropertyElementHistory::getEnclosure()
   *
   * @return
   */
  public function getFeedEnclosure()
  {

  }

  /**
   * SchemaPropertyElementHistory::getCategories()
   *
   * @return
   */
  public function getFeedCategories()
  {

  }

}

<?php

/**
 * Subclass for performing query and update operations on the 'reg_concept_property_history' table.
 *
 *
 *
 * @package lib.model
 */
class ConceptPropertyHistoryPeer extends BaseConceptPropertyHistoryPeer
{

  /**
  * Gets the last update for a domain
  *
  * @return mixed Either a date string or a time integer
  * @param  string $domain
  * @param  string $format A date format string. If $format is null, then an integer is returned
  */
  static public function getLastUpdateForDomain($domain, $format = 'Y-m-d H:i:s')
  {
    $results = '';
    if (!preg_match('/%$/', $domain))
    {
      $domain .="%";
    }
    $c = new Criteria();
    $c->add(VocabularyPeer::URI, $domain, Criteria::LIKE);
    $c->addJoin(self::VOCABULARY_ID, VocabularyPeer::ID);
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $rs = self::doSelectOne($c);
    if ($rs) {
      $results = $rs->getCreatedAt($format);
    }
    return $results;
  }

  /**
  * Gets the last update for a vocabulary
  *
  * @return mixed Either a date string or a time integer
  * @param  integer $id
  * @param  string $format A date format string. If $format is null, then an integer is returned
  */
  static public function getLastUpdateForVocab($id, $format = 'Y-m-d H:i:s')
  {
    $c = new Criteria();
    $c->add(self::VOCABULARY_ID, $id);
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $rs = self::doSelectOne($c);
    $results = 0; //there may be no concepts
    if ($rs)
    {
      $results = $rs->getCreatedAt($format);
    }
    return $results;
  }


}

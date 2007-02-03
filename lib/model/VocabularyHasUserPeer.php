<?php

/**
 * Subclass for performing query and update operations on the 'reg_vocabulary_has_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class VocabularyHasUserPeer extends BaseVocabularyHasUserPeer
{
   /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function doSelectForUser()
  {
      $con = Propel::getConnection(self::DATABASE_NAME);
      $criteria = self::getUserCriteria();
      $result = self::doSelectJoinAll($criteria, $con);
      return $result;
  }
  
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function doCountForUser()
  {
      $criteria = self::getUserCriteria();
      $result = self::doCountJoinAll($criteria);
      return $result;
  }
  
  /**
  * gets the criteria for select based on whether the user is an admin
  *
  * @return criteria object
  */
  public static function getUserCriteria()
  {
      $criteria = new Criteria(VocabularyPeer::DATABASE_NAME);
      $user = sfContext::getInstance()->getUser();
      $userId = $user->getSubscriberId();
      $isAdmin = $user->hasCredential(array (0 => 'administrator' ));
      if (!$isAdmin)
      {
         $criteria->add(self::USER_ID, $userId);
         $criteria->add(self::IS_ADMIN_FOR, true);
      }
    return $criteria;
  }

} // VocabularyHasUserPeer

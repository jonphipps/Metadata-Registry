<?php

/**
 * Subclass for representing a row from the 'sf_blog' table.
 *
 * 
 *
 * @package plugins.sfBlogsPlugin.lib.model
 */ 
class PluginsfBlogLog extends BasesfBlogLog
{
  public function __toString()
  {
    $context = sfContext::getInstance();
    $context->getConfiguration()->loadHelpers(array('I18N'), $context->getModuleName());
    return __($this->getMessage(ESC_RAW), array(
      '%subject%' => $this->getSubjectLink(ESC_RAW) ? '<a href="'.$this->getSubjectLink(ESC_RAW).'">'.(string) $this->getSubjectName(ESC_RAW).'</a>' : $this->getSubjectName(ESC_RAW),
      '%object%'  => $this->getObjectLink(ESC_RAW) ? '<a href="'.$this->getObjectLink(ESC_RAW).'">'.(string) $this->getObjectName(ESC_RAW).'</a>' : $this->getObjectName(ESC_RAW),
      '%complement%' => $this->getComplementLink(ESC_RAW) ? '<a href="'.$this->getComplementLink(ESC_RAW).'">'.(string) $this->getComplementName(ESC_RAW).'</a>' : $this->getComplementName(ESC_RAW),
    ));
  }
  
  public function setElements($user, $subject, $verb, $object, $messageIfAuthor, $messageIfNotAuthor = '', $complement = null)
  {
    $this->setSfGuardUser($user);
    $this->setSubject($subject);
    $this->setVerb($verb);
    $this->setObject($object);
    if($messageIfNotAuthor && !$user->equals($subject))
    {
      $this->setMessage($messageIfNotAuthor);
    }
    else
    {
      $this->setMessage($messageIfAuthor);
    }
    if($complement)
    {
      $this->setComplement($complement);
    }
  }
  
  public function guessSubject()
  {
    if(!sfContext::hasInstance()) return;
    if($user = sfContext::getInstance()->getUser()->getGuardUser())
    {
      $this->setSubject($user);
    }
  }
  
  public function setSubject($subject)
  {
    $this->setSubjectClass(get_class($subject));
    $this->setSubjectId($subject->getId());
    $this->setSubjectName((string) $subject);
  }
  
  public function getSubject()
  {
    return DbFinder::from($this->getSubjectClass())->findPk($this->getSubjectId());
  }
  
  public function setObject($object)
  {
    $this->setObjectClass(get_class($object));
    $this->setObjectId($object->getId());
    $this->setObjectName((string) $object);
  }
  
  public function getObject()
  {
    return DbFinder::from($this->getObjectClass())->findPk($this->getObjectId());
  }
  
  public function setComplement($complement)
  {
    $this->setComplementClass(get_class($complement));
    $this->setComplementId($complement->getId());
    $this->setComplementName((string) $complement);
  }
  
  public function getComplement()
  {
    return DbFinder::from($this->getComplementClass())->findPk($this->getComplementId());
  }
  
}

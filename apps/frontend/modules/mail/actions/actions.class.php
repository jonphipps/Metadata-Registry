<?php

/**
 * mail actions.
 *
 * @package    Registry
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class mailActions extends sfActions
{
  public function executeSendPassword()
  {
    $mail = new sfMail();
    $mail->addAddress($this->getRequestParameter('email'));
    $mail->setFrom('Registry <registry@metadataregistry.com>');
    $mail->setSubject('Registry password recovery');

    $mail->setPriority(1);

    $mail->addEmbeddedImage(sfConfig::get('sf_web_dir').'/images/Registry_logo.gif', 'CID1', 'Registry Logo', 'base64', 'image/gif');

    $this->mail = $mail;

    $this->nickname = $this->getRequest()->getAttribute('nickname');
    $this->password = $this->getRequest()->getAttribute('password');
  }
}

?>
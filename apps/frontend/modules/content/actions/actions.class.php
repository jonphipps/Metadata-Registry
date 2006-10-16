<?php

/**
 * content actions.
 *
 * @package    Registry
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class contentActions extends sfActions
{
  public function executeHome()
  {
    require_once('markdown.php');

    $fileRoot = sfConfig::get('sf_data_dir').'/content/home_';
    $file = $fileRoot . $this->getUser()->getCulture() . '.txt';
    if (!is_readable($file))
    {
      $file = $fileRoot . '_en.txt';
    }

    $this->html = markdown(file_get_contents($file));

    $this->getContext()->getResponse()->setTitle('The Registry! :: home');
  }

  public function executeAbout()
  {
    require_once('markdown.php');

    $file = sfConfig::get('sf_data_dir').'/content/about_'.$this->getUser()->getCulture().'.txt';
    if (!is_readable($file))
    {
      $file = sfConfig::get('sf_data_dir').'/content/about_en.txt';
    }

    $this->html = markdown(file_get_contents($file));

    $this->getContext()->getResponse()->setTitle('The Registry! :: about');
  }

  public function executeUnavailable()
  {
    require_once('markdown.php');

    $file = sfConfig::get('sf_data_dir').'/content/unavailable_'.$this->getUser()->getCulture().'.txt';
    if (!is_readable($file))
    {
      $file = sfConfig::get('sf_data_dir').'/content/unavailable_en.txt';
    }

    $this->getContext()->getResponse()->setTitle('The Registry! :: maintenance');
  }
}
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
    $this->getRss();
    $this->outputFile('home');
  }

  public function executeAbout()
  {
    $this->outputFile('about');
  }

  public function executeUnavailable()
  {
    $this->outputFile('unavailable');
  }

  /**
  * retrieves and parses file for output
  *
  * @return string
  * @param $file Base name of file to parse
  */
  public function outputFile($infile)
  {
    require_once('markdown.php');

    $hostPrefix = '/content/';

    if ('sandbox.metadataregistry.org' == $this->getRequest()->getHost())
    {
      $hostPrefix .= 'sandbox_' ;
    }

    $fileRoot = sfConfig::get('sf_data_dir') . $hostPrefix . $infile . '_';
    $file = $fileRoot . $this->getUser()->getCulture() . '.txt';

    if (!is_readable($file))
    {
      $file = $fileRoot . '_en.txt';
    }

    $this->html = markdown(file_get_contents($file));

    $this->getContext()->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $infile);
  }

  /**
  * loads the rss for the home page
  *
  */
  function getRss()
  {
    $RSS_PHP = new rss_php();
    $RSS_PHP->load('http://metadataregistry.org/blog/category/registry-development/the-registry/feed');
    $this->rssItems = $RSS_PHP->getItems();
  }

}
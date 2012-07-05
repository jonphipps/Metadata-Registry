<?php

/**
 * content actions.
 *
 * @package    Registry
 * @subpackage content
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2 2006-04-03 21:07:20Z jphipps $
 */
class contentActions extends sfActions
{
  public function executeHome()
  {
    $this->getRss();
    $this->getChangeFeed();
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

    if (preg_match('/^sandbox/', $this->getRequest()->getHost()))
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
    try
    {
      $feed = $RSS_PHP->load('http://metadataregistry.org/blog/category/registry-development/');
      if ($feed)
      {
        $this->rssItems = $RSS_PHP->getItems();
      }
    }
    catch (Exception $e)
    {
    }
  }

  /**
  * Displays the latest changes to the registry
  *
  * @return return_type
  * @param  var_type $var
  */
  public function executeAllHistoryFeeds()
  {
    $this->setTemplate('allFeeds');
    $this->getChangeFeed();
  }

  /**
  * Displays the latest changes to the registry
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getChangeFeed()
  {
    try
    {
      $feed1 = sfFeedPeer::createFromWeb($this->getRequest()->getUriPrefix() . "/schemahistory/feed.atom");
      $feed2 = sfFeedPeer::createFromWeb($this->getRequest()->getUriPrefix() . "/history/feed.atom");
      if ($feed1 && $feed2)
      { $image = new sfFeedImage();
        $image->setFavicon($this->getRequest()->getUriPrefix() . "/favicon.ico");
        $image->setFeed($this->getRequest()->getUriPrefix() . "/allfeeds.atom");
        $image->setLink($image->getFeed());
        $image->setTitle("Metadata Registry Change History");
        $this->feed = sfFeedPeer::aggregate(array($feed1, $feed2),
          array(
          'limit' => 100,
          'format' => 'atom1',
          'link' => $image->getLink(),
          'title' => $image->getTitle(),
          'feedUrl' => $image->getFeed(),
          'image' => $image,
          'description' => 'A statement-level list of all of the recent changes to the vocabularies and element sets maintained in the Metadata registry.',
          ));
        $this->changeFeedItems = $this->feed->getItems();
      }
    }
    catch (Exception $e)
    {
    }
  }
}
<?php

/**
 * cache actions.
 *
 * @package    project
 * @subpackage cache
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 3098 2006-12-19 22:09:30Z fabien $
 */
class cacheActions extends sfActions
{
  public function executeIndex()
  {
  }

  public function executePage()
  {
  }

  public function executeForward()
  {
    $this->forward('cache', 'page');
  }

  public function executeMulti()
  {
  }

  public function executeMultiBis()
  {
  }

  public function executeSpecificCacheKey()
  {
  }

  public function executeAction()
  {
    $response = $this->getResponse();
    $response->setHttpHeader('symfony', 'foo');
    $response->setContentType('text/plain');
    $response->setTitle('My title');
    $response->addMeta('meta1', 'bar');
    $response->addHttpMeta('httpmeta1', 'foobar');

    sfConfig::set('ACTION_EXECUTED', true);
  }

  public function executeImageWithLayoutCacheWithLayout()
  {
    $this->prepareImage();
    $this->setLayout('image');
  }

  public function executeImageWithLayoutCacheNoLayout()
  {
    $this->prepareImage();
    $this->setLayout('image');
  }

  public function executeImageNoLayoutCacheWithLayout()
  {
    $this->prepareImage();
    $this->setLayout(false);
  }

  public function executeImageNoLayoutCacheNoLayout()
  {
    $this->prepareImage();
    $this->setLayout(false);
  }

  protected function prepareImage()
  {
    $this->getResponse()->setContentType('image/png');
    $this->image = file_get_contents(sfConfig::get('sf_symfony_data_dir').'/web/sf/sf_default/images/icons/ok48.png');
    $this->setTemplate('image');
  }
}

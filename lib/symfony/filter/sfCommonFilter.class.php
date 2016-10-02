<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfCommonFilter automatically adds javascripts and stylesheets information in the sfResponse content.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfCommonFilter.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class sfCommonFilter extends sfFilter
{
  /**
   * Executes this filter.
   *
   * @param sfFilterChain $filterChain A sfFilterChain instance
   */
  public function execute($filterChain)
  {
    // execute next filter
    $filterChain->execute();

    // execute this filter only once
    $response = $this->getContext()->getResponse();

    // include stylesheets and put stylesheets before head
    $content = $response->getContent();
    if (false !== ($pos = strpos($content, '</head>')))
    {
      sfLoader::loadHelpers(array('Tag', 'Asset'));
      $html = '';

      if (!$response->getParameter('stylesheets_included', false, 'symfony/view/asset'))
      {
        $html .= get_stylesheets();
      }

      if ($html)
      {
        $response->setContent(substr($content, 0, $pos).$html.substr($content, $pos));
      }
    }
    //include javascript and put before before </body>
    $content = $response->getContent();
    if (false !== ( $pos = strpos($content, '</body>') )) {
      sfLoader::loadHelpers([ 'Tag', 'Asset' ]);
      $html = '';
      if ( ! $response->getParameter('javascripts_included', false, 'symfony/view/asset')) {
        $html .= get_javascripts();
      }

      if ($html) {
        $response->setContent(substr($content, 0, $pos) . $html . substr($content, $pos));
      }
    }

    $response->setParameter('javascripts_included', false, 'symfony/view/asset');
    $response->setParameter('stylesheets_included', false, 'symfony/view/asset');
  }
}

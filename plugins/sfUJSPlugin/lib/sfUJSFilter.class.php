<?php

/*
 * This file is part of the sfUJSPlugin package.
 * (c) 2007 Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfUJSFilter automatically adds unobstrusive javascript code in the sfResponse content.
 *
 * @package    sfUJSPlugin
 * @subpackage filter
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 */
class sfUJSFilter extends sfFilter
{
  /**
   * Executes this filter.
   *
   * @param sfFilterChain A sfFilterChain instance
   */
  public function execute($filterChain)
  {
    // execute next filter
    $filterChain->execute();

    $response = $this->getContext()->getResponse();
    $content = $response->getContent();

    // include UJS
    if ((false !== ($pos = strpos($content, '</body>'))) && !$response->getParameter('included', false, 'symfony/view/UJS'))
    {
      sfLoader::loadHelpers(array('Tag', 'UJS'));

      if ($html = get_UJS())
      {
        $response->setContent(substr($content, 0, $pos).$html.substr($content, $pos));
      }
    }
    
    $response->setParameter('included', false, 'symfony/view/UJS');
  }
}

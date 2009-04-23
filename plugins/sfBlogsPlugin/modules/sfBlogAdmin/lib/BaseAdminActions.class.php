<?php

/*
 * This file is part of the sfBlog package.
 * (c) 2004-2006 Francois Zaninotto <francois.zaninotto@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Backend actions helpers
 *
 * @package    sfBlog
 * @subpackage plugin
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @version    SVN: $Id$
 */
class BaseAdminActions extends sfActions
{
  
  protected function getFilters($request, $namespace)
  {
    if ($request->hasParameter('filter'))
    {
      // Get filters from request
      $filters = $request->getParameter('filters');
      
      // Process date filters
      if (isset($filters['created_at']['from']) && $filters['created_at']['from'] !== '')
      {
        $filters['created_at']['from'] = sfI18N::getTimestampForCulture($filters['created_at']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['created_at']['to']) && $filters['created_at']['to'] !== '')
      {
        $filters['created_at']['to'] = sfI18N::getTimestampForCulture($filters['created_at']['to'], $this->getUser()->getCulture());
      }
      $this->getContext()->getConfiguration()->loadHelpers(array('I18N'));
      if(isset($filters['text']) && $filters['text'] == __('search'))
      {
        $filters['text'] = '';
      }

      // Store in the session
      $this->getUser()->getAttributeHolder()->removeNamespace($namespace);
      $this->getUser()->getAttributeHolder()->add($filters, $namespace);
    }
    
    return $this->getUser()->getAttributeHolder()->getAll($namespace);
  }
  
  protected function getSort($request, $namespace)
  {
    if ($request->hasParameter('sort'))
    {
      // Store in the session
      $this->getUser()->setAttribute('sort', $request->getParameter('sort'), $namespace);
      $this->getUser()->setAttribute('type', $request->getParameter('type', 'asc'), $namespace);
    }
    elseif(!$this->getUser()->hasAttribute('sort', $namespace))
    {
      $this->getUser()->setAttribute('sort', 'default', $namespace);
      $this->getUser()->setAttribute('type', 'desc', $namespace);
    }
    
    return $this->getUser()->getAttributeHolder()->getAll($namespace);
  }
  
  protected function getObjectFromRequest($request, $class)
  {
    $object = DbFinder::from($class)->
      managedBy($this->getUser())->
      findPk($request->getParameter('id'));
    $this->forward404Unless($object);
    
    return $object;
  }
  
}

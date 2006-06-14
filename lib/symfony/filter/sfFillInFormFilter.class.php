<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage filter
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfFillInFormFilter extends sfFilter
{
  private $escapers = array();

  public function executeBeforeRendering($filterChain)
  {
    $context  = $this->getContext();
    $response = $context->getResponse();
    $request  = $context->getRequest();

    $doc = new DomDocument('1.0', 'UTF-8');
    @$doc->loadHTML($response->getContent());
    $xpath = new DomXPath($doc);

    // load converters
    foreach ($this->getParameter('converters', array()) as $functionName => $parameters)
    {
      if (!is_array($parameters))
      {
        $parameters = array($parameters);
      }

      foreach ($parameters as $parameter)
      {
        $this->escapers[$parameter][] = $functionName;
      }
    }

    $skip_fields = $this->getParameter('skip_fields', array());

    $exclude_types = $this->getParameter('exclude_types', array('hidden', 'password'));
    $check_types   = $this->getParameter('check_types',   array('text', 'checkbox', 'radio', 'password', 'hidden'));
    $types = array_diff($check_types, $exclude_types);
    $query = 'descendant::input[@name and (not(@type)';
    foreach ($types as $type)
    {
      $query .= ' or @type="'.$type.'"';
    }
    $query .= ')] | descendant::textarea[@name] | descendant::select[@name]';

    // find our form
    $xpath_query = $this->getParameter('name') ? '//form[@name="'.$this->getParameter('name').'"]' : '//form';
    if ($form = $xpath->query($xpath_query)->item(0))
    {
      foreach($xpath->query($query, $form) as $element)
      {
        // skip fields specified in the 'skip_fields' attribute
        if ($request->hasParameter($element->getAttribute('name')) && in_array($element->getAttribute('name'), $skip_fields))
        {
          continue;
        }

        if ($element->nodeName == 'input')
        {
          if ($element->getAttribute('type') == 'checkbox' || $element->getAttribute('type') == 'radio')
          {
            // checkbox and radio
            $name = $element->getAttribute('name');
            $element->removeAttribute('checked');
            if ($request->hasParameter($name) && ($request->getParameter($name) == $element->getAttribute('value') || !$element->hasAttribute('value')))
            {
              $element->setAttribute('checked', 'checked');
            }
          }
          else
          {
            // text input
            $element->removeAttribute('value');
            if ($request->hasParameter($element->getAttribute('name')))
            {
              $element->setAttribute('value', $this->espaceRequestParameter($request, $element->getAttribute('name')));
            }
          }
        }
        else if ($element->nodeName == 'textarea')
        {
          foreach ($element->childNodes as $child_node)
          {
            $element->removeChild($child_node);
          }
          $element->appendChild($doc->createTextNode($this->espaceRequestParameter($request, $element->getAttribute('name'))));
        }
        else if ($element->nodeName == 'select')
        {
          // select
          $name     = $element->getAttribute('name');
          $value    = $request->getParameter($name);
          $multiple = $element->hasAttribute('multiple');
          foreach ($xpath->query('descendant::option', $element) as $option)
          {
            $option->removeAttribute('selected');
            if ($multiple && is_array($value))
            {
              if (in_array($option->getAttribute('value'), $value))
              {
                $option->setAttribute('selected', 'selected');
              }
            }
            else if ($value == $option->getAttribute('value'))
            {
              $option->setAttribute('selected', 'selected');
            }
          }
        }
      } // foreach
    }

    $response->setContent($doc->saveHTML());

    unset($doc);

    // execute next filter
    $filterChain->execute();
  }

  private function espaceRequestParameter($request, $name)
  {
    $value = $request->getParameter($name);
    if (isset($this->escapers[$name]))
    {
      foreach ($this->escapers[$name] as $function)
      {
        $value = $function($value);
      }
    }

    return $value;
  }
}

<?php

require_once(dirname(__FILE__).'/../../../bootstrap/functional.php');

$testFile = dirname(__FILE__).'/view_test.yml';

$config = sfYaml::load($testFile);

//merge the global selectors into $selectors[$selector_name][$selector][$value -- string or boolean]
$selectors = array();
//merge $config['objects']['selectors']
if (isset($config['objects']['selectors']))
{
  $selectors = setSelectors($selectors, $config['objects']['selectors'], 'object_');
}
  //merge $config['tables'[$table]['selectors']
if (isset($config['tables']))
{
  foreach ($config['tables'] as $table => $tableSelectors)
  {
    $selectors = setSelectors($selectors, $tableSelectors['selectors'], $table . '_');
  }
}

/**
* Adds selectors to the selectors array
*
* @return array The selector array
* @param array $selectorsMain the array to add the selector to
* @param array $selectorsArray the selectors to add
* @param string $keyPrefix a prefix to add to the key
*/
function setSelectors($selectorsMain, $selectorsArray, $keyPrefix)
{
  foreach ($selectorsArray as $key => $selector)
  {
    if (is_array($selector))
    {
      $selectorsMain[$keyPrefix . $key]  = $selector;
    }
    elseif (!is_null($selector))
    {
      $selectorsMain[$keyPrefix . $key] = array($selector, true);
    }
  }

  return $selectorsMain;
}

$initSelectors = $selectors;

foreach ($config['roles'] as $role => $roleArray)
{
  //merge the action selectors into $selectors
  foreach ($config['actions'] as $action => $actionArray)
  {
    $selectors = $initSelectors;
    //merge $action['objects']['selectors']
    if (isset($actionArray['objects']['selectors']))
    {
      $selectors = setSelectors($selectors, $actionArray['objects']['selectors'], 'object_');
    }

    //merge $action['tables'][$table]['selectors']
    if (isset($actionArray['tables']))
    {
      foreach ($actionArray['tables'] as $table => $tableSelectors)
      {
        $selectors = setSelectors($selectors, $tableSelectors['selectors'], $table . '_');
      }
    }

    //merge the content selectors
    if (isset($actionArray['contents']['selectors']))
    {
      $selectors = setSelectors($selectors, $actionArray['contents']['selectors'], 'content_');
    }

    //set 'valid' as the default
    if (!isset($actionArray['roles'][$role]['valid']))
    {
      $temp = $actionArray['roles'][$role];
      unset($actionArray['roles'][$role]);
      $actionArray['roles'][$role]['valid'] = $temp;
    }

    foreach ($actionArray['roles'][$role] as $key => $tests)
    {
      //hide the hidden things
      if (isset($actionArray['roles'][$role][$key]['hide']['objects']))
        {
        foreach ($actionArray['roles'][$role][$key]['hide']['objects'] as $selector)
        {
          $selectors['object_' . $selector][1] = false;
        }
      }
      if (isset($actionArray['roles'][$role][$key]['hide']['tables']))
      {
        foreach ($actionArray['roles'][$role][$key]['hide']['tables'] as $table => $tableSelectors)
        {
          foreach ($tableSelectors as $selector)
          {
            $selectors[$table . '_' . $selector][1] = false;
          }
        }
      }
      if (isset($actionArray['roles'][$role][$key]['hide']['contents']))
      {
        foreach ($actionArray['roles'][$role][$key]['hide']['contents'] as $selector)
        {
          $selectors['content_' . $selector][1] = false;
        }
      }
      //show only the show things
      //build $tempSelectors
      if (isset($actionArray['roles'][$role][$key]['show']['objects']))
      {
        foreach ($actionArray['roles'][$role][$key]['show']['objects'] as $key)
        {
          $tempSelectors['object_' . $key] = false;
        }
      }
      if (isset($actionArray['roles'][$role][$key]['show']['contents']))
      {
        foreach ($actionArray['roles'][$role][$key]['show']['contents'] as $key)
        {
          $tempSelectors['content_' . $key] = false;
        }
      }
      if (isset($actionArray['roles'][$role][$key]['show']['tables']))
      {
        foreach ($actionArray['roles'][$role][$key]['show']['tables'] as $table => $tableSelectors)
        {
          foreach ($tableSelectors as $selector)
          {
            $tempSelectors[$table . '_' . $selector] = false;
          }
        }
      }

      //get the diff between $tempSelectors and $selectors
      if (isset($tempSelectors))
      {
        $diff = array_diff_key($tempSelectors, $selectors);
        foreach ($diff as $diffKey => $selector)
        {
          $selector[$diffKey][1] = false;
        }
      }

      echo "\n==========\nTesting -- "  . $role . " :: " . $key . " Access :: " . $action . "\n";
      flush();

      $browser = new sfTestBrowser();
      $browser->initialize();

      if (isset($config['roles'][$role]['login']))
      {
        //$browser->setAuth($config['roles'][$role]['login'], $config['roles'][$role]['password']);
        //login as role
  //      $browser->
  //        get('/login')->
  //        isStatusCode(200);

        $browser->post('/login', array(
          'nickname' => $config['roles'][$role]['login'],
          'password' => $config['roles'][$role]['password'],
          'password_bis' => '',
          'email' => '',
          'referer' => 'http%3A%2F%2Fregistry%2F',
          'commit' => 'sign+in' ))->
          isRedirected()->
          followRedirect();
      }
      //is the url an array?
      if (!is_array($actionArray['url']))
      {
        $actionArray['url'] = array('valid' => $actionArray['url']);
      }

      if (isset($actionArray['roles'][$role][$key]))
      {
        //get the url
        $browser->get($actionArray['url'][$key]);

        //if it's forbidden
        $forwardTo = $actionArray['roles'][$role][$key]['forwardTo'];
        if (is_array($forwardTo))
        {
          //we should get forwarded to login
          $browser->
            isStatusCode(200)->
            isForwardedTo($forwardTo[0], $forwardTo[1])->
            isStatusCode(200)
            ;

           echo "\n******  Forbidden OK -- " . $role . " :: " . $key . " Access :: " . $action . "\n";
        }
        else if (isset($selectors))
        {
          // test everything for this role
          foreach ($selectors as $selector => $test)
          {
            $browser->checkResponseElement($test[0], $test[1]);
          }
        }
      }
    }

      //foreach $selectors as $selector => $test
        //checkResponseElement($test[0], $test[1], 'Checking -- ' . $selector)->
  }
}


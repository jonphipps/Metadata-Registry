<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$_test_dir = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..');
require_once($_test_dir.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
require_once($sf_symfony_lib_dir.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'lime'.DIRECTORY_SEPARATOR.'lime.php');
require_once($sf_symfony_lib_dir.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'sfConfig.class.php');
require_once($sf_symfony_data_dir.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constants.php');
sfConfig::set('sf_symfony_lib_dir', $sf_symfony_lib_dir);
sfConfig::set('sf_symfony_data_dir', $sf_symfony_data_dir);

require_once(dirname(__FILE__).'/testAutoloader.class.php');

testAutoloader::initialize();


function __autoload($class)
{
  return testAutoloader::__autoload($class);
}

class sfException extends Exception
{
  private $name = null;

  protected function setName ($name)
  {
    $this->name = $name;
  }

  public function getName ()
  {
    return $this->name;
  }
}

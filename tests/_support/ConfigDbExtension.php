<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-02-02
 * Time: 4:55 PM
 */

namespace _support;


use Codeception\Event\SuiteEvent;
use Codeception\Event\TestEvent;
use Codeception\Extension;

class ConfigDbExtension extends Extension
{
// list events to listen to
  public static $events = [
      'suite.before' => 'beforeSuite',
      'suite.after'  => 'afterSuite',
      'test.start' => 'startTest',
      'test.end'   => 'endTest',
      'test.before' => 'beforeTest',
      'test.after'   => 'afterTest',
  ];


  public function beforeSuite(SuiteEvent $e)
    {
        //\Codeception\Configuration::config()
        $this->config['user']=getenv('DB_USER');
        $this->config['password'] = getenv('DB_PASS');
    }


  public function afterSuite(SuiteEvent $e)
  {

    xdebug_break();
  }


  public function startTest(TestEvent $e)
  {
    xdebug_break();
  }


  public function endTest(TestEvent $e)
  {
    xdebug_break();
  }


  public function beforeTest(TestEvent $e)
  {
    xdebug_break();
  }


  public function afterTest(TestEvent $e)
  {
    xdebug_break();
  }

}


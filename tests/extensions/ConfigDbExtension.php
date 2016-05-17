<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-02-02
 * Time: 4:55 PM
 */

namespace tests\extensions;


use Codeception\Event\SuiteEvent;
use Codeception\Extension;

class ConfigDbExtension extends Extension
{
// list events to listen to
    public static $events = array(
        'suite.before' => 'beforeSuite',
    );

    public function beforeSuite(SuiteEvent $e)
    {
        //\Codeception\Configuration::config()
        $this->config['user']=getenv('DB_USER');
        $this->config['password'] = getenv('DB_PASS');
    }

}


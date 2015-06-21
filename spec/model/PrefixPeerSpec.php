<?php

namespace spec\model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

// This is global bootstrap for autoloading
define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG',       isset($debug) ? $debug : true);
//initialize composer
require_once( SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );
// initialize symfony
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
//$databaseManager = new \sfDatabaseManager();
//$databaseManager->initialize();


class PrefixPeerSpec extends ObjectBehavior
{
    function let()
    {
        // initialize database manager
        $databaseManager = new \sfDatabaseManager();
        $databaseManager->initialize();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('\PrefixPeer');
    }
}

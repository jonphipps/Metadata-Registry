<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Configuration;

class DbHelper extends \Codeception\Module\Db
{
    public function __construct()
    {
        //grab the global config file
        $config = Configuration::config();
        //get  the unit settings
        $settings = Configuration::suiteSettings("unit", $config);
        //get the settings for the db module
        $dbConfig = (isset($settings['modules']['config']['Db'])) ? $settings['modules']['config']['Db'] : array();
        //reset the dump file location
        $dbConfig['dump'] = 'tests/_data/swregistry_test_update.sql';
        //set the config for the helper module
        $this->_setConfig($dbConfig);
    }

    public function _initialize()
    {
        //make sure we initialize all of the settings
        parent::_initialize();
    }

    /**
     * @param $dumpFile
     * @throws \Codeception\Exception\Module
     */
    public function resetDatabase($dumpFile)
    {
        $this->config['dump'] = 'tests/_data/' . $dumpFile;
        $this->_initialize();
    }
}

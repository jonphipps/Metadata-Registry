<?php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Configuration;
class Db extends \Codeception\Module\Db
{
    public function __construct()
    {
        //grab the global config file
        $config = Configuration::config();
        //get  the unit settings
        $settings = Configuration::suiteSettings("import", $config);
        //get the settings for the db module
        $dbConfig = (isset($settings['modules']['config']['Db'])) ? $settings['modules']['config']['Db'] : array();
        $dbConfig['user'] = $_ENV['db_user'];
        $dbConfig['password'] = $_ENV['db_password'];
        $this->_reconfigure($dbConfig);

        //$this->_setConfig($dbConfig);
        //$this->_initialize();
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

<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Codecept;

class UnitHelper extends \Codeception\Module
{
    /**
     * @param $table
     * @param $TestCount
     * @param array $criteria Optional, Associative
     *
     * $criteria array looks like:
     * ['column']     <-- the column to use for selection
     * ['value']       <-- the value to compare with on ['column']
     * ['comparison'] <-- use constants like \Criteria::NOT_EQUAL
     *
     * May be an array of criteria
     *
     * If no $criteria, then returns count of all rows in the table
     */
    public function seeRecordCountInDatabaseTable($table, $TestCount, array $criteria = [])
    {
        $tablePeer = '\\' . $table . 'Peer';
        $propTable = new $tablePeer();
        $c = new \Criteria();
        if (!empty($criteria)) {
            foreach ($criteria as $param) {
                $c->add($param['column'], $param['value'], $param['comparison']);
            }
        }

        $res = $propTable::doCount($c);
        \PHPUnit_Framework_Assert::assertEquals($TestCount, $res);
    }

    /**
     * @param $dumpFile
     * @throws \Codeception\Exception\Module
     */
    public function resetDatabase2($dumpFile)
    {
        /** @var \Codeception\Module\Db $db */
        $db = $this->getModule('Db');
        $config['dump'] = 'tests/_data/' . $dumpFile;
        $db->_reconfigure($config);
        $db->_initialize();
    }
}

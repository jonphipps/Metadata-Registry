<?php

use Codeception\Module\Db;
use Codeception\Module\Dbh;
use Codeception\Module\DbHelper;
use Ddeboer\DataImport\Reader\ArrayReader;

class importUpdateRelatedTest extends \Codeception\TestCase\Test
{
    /**
     * @var \ImportTester
     */
    protected $tester;
    protected $importId;

    protected function _before()
    {
        $this->importId = 1;
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        $I = $this->tester;
        $sql = "INSERT INTO `reg_schema_property_element` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_user_id`, `updated_user_id`, `schema_property_id`, `profile_property_id`, `is_schema_property`, `object`, `related_schema_property_id`, `language`, `status_id`) VALUES
	(110489,'2014-01-19 03:45:21','2014-01-18 22:45:21',NULL,422,422,14603,1,1,'respondentOf',NULL,'en',1);";
        $data = $I->getArrayFromSql($sql);
        //$I->haveInDatabase('reg_schema_property_element', $data);
        /** @var SchemaPropertyElement $element */
        $element = SchemaPropertyElementPeer::retrieveByPK(110489);
        $element->importId = $this->importId;
        $element->updateReciprocal("deleted", 422, 81);
    }

}

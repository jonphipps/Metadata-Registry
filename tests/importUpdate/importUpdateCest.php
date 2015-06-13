<?php
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;
use ImportVocab\UpdateRelatedJob;

class importUpdateCest
{
    /**
     * @var ImportVocab
     */
    protected $import;

    public function _before(ImportTester $I)
    {
    }

    public function _after(ImportTester $I)
    {
    }

    // tests

    public function TestOriginalData(ImportTester $I)
    {
        $I->wantToTest("that the original data for a single row is in a known state");
        $CsvHeader =
              'id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_id,name,label,definition,comment,type,is_subproperty_of,parent_uri,uri,status_id,language,note,domain,orange,is_deprecated,url,lexical_alias';
        $CsvNullMe = '0,1,0,1,1,1,0,0,0,1,0,0,1,1,0,0,0,0,1,1,1,1,1';
        $CsvValues[] =
              '"15536","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","81","respondentOf","is respondent of","Relates a candidate for a degree who defends or opposes a thesis provided by the praeses in an academic disputation to the work.",,"Property","14069","http://rdaregistry.info/Elements/a/P50204","http://rdaregistry.info/Elements/a/P50001","1","en",,"http://rdaregistry.info/Elements/c/C10004","http://rdaregistry.info/Elements/c/C10001",,,';
        $this->TestData('reg_schema_property', $CsvHeader, $CsvValues, $I, $CsvNullMe);

        //reg_schema_property_element

        $CsvValues = array();
        $CsvHeader =
              'id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_property_id,profile_property_id,is_schema_property,object,related_schema_property_id,language,status_id';
        $CsvNullMe = '0,1,0,1,1,1,0,0,1,0,1,0,1';
        $CsvValues[] =
              '"121276","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","1","1","respondentOf",,"en","1"';
        $CsvValues[] =
              '"121277","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","2","1","is respondent of",,"en","1"';
        $CsvValues[] =
              '"121278","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","3","1","Relates a candidate for a degree who defends or opposes a thesis provided by the praeses in an academic disputation to the work.",,"en","1"';
        $CsvValues[] =
              '"121279","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","4","1","Property",,,"1"';
        $CsvValues[] =
              '"121280","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","11","1","http://rdaregistry.info/Elements/c/C10004","14331",,"1"';
        $CsvValues[] =
              '"121281","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","12","1","http://rdaregistry.info/Elements/c/C10001","14328",,"1"';
        $CsvValues[] =
              '"121282","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","13","1","http://rdaregistry.info/Elements/a/P50001","15536",,"1"';
        $CsvValues[] = '"121283","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","14","1","1",,,"1"';
        $CsvValues[] =
              '"121284","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","6","1","http://rdaregistry.info/Elements/a/P50204","14069",,"1"';
        $CsvValues[] =
              '"121285","2014-01-19 11:31:45","2014-01-19 06:31:45",,"422","422","15536","6",,"http://rdaregistry.info/Elements/u/P60001","14603",,"1"';
        $CsvValues[] =
              '"121286","2014-01-19 11:33:14","2014-01-19 06:33:14",,"422","422","15536","15",,"http://rdaregistry.info/Elements/w/P10001","15304",,"1"';
        $CsvValues[] =
              '"122794","2014-04-26 06:27:36","2014-04-26 02:27:36",,"422","422","15536","16",,"http://rdaregistry.info/Elements/a/respondentOf",,,"1"';
        $this->TestData('reg_schema_property_element', $CsvHeader, $CsvValues, $I, $CsvNullMe, [
              'created_at',
              'updated_at',
              'deleted_at',
        ]);

        //reg_schema_property_element_history

        $CsvValues = array();
        $CsvHeader =
              'id,created_at,created_user_id,action,schema_property_element_id,schema_property_id,schema_id,profile_property_id,object,related_schema_property_id,language,status_id,change_note,import_id';
        $CsvNullMe = '0,0,1,1,1,1,1,1,1,1,0,1,1,1';
        $CsvValues[] =
              '"139292","2014-01-19 06:29:58","422","added","121276","15536","81","1","respondentOf",,"en","1",,';
        $CsvValues[] =
              '"139293","2014-01-19 06:29:58","422","added","121277","15536","81","2","is respondent of",,"en","1",,';
        $CsvValues[] =
              '"139294","2014-01-19 06:29:58","422","added","121278","15536","81","3","Relates a candidate for a degree who defends or opposes a thesis provided by the praeses in an academic disputation to the work.",,"en","1",,';
        $CsvValues[] =
              '"139295","2014-01-19 06:29:58","422","added","121279","15536","81","4","subproperty",,"en","1",,';
        $CsvValues[] =
              '"139296","2014-01-19 06:29:58","422","added","121280","15536","81","11","http://rdaregistry.info/Elements/c/C10004","14331","en","1",,';
        $CsvValues[] =
              '"139297","2014-01-19 06:29:58","422","added","121281","15536","81","12","http://rdaregistry.info/Elements/c/C10001","14328","en","1",,';
        $CsvValues[] =
              '"139298","2014-01-19 06:29:58","422","added","121282","15536","81","13","http://rdaregistry.info/Elements/a/P50001","15536","en","1",,';
        $CsvValues[] = '"139299","2014-01-19 06:29:58","422","added","121283","15536","81","14","1",,"en","1",,';
        $CsvValues[] =
              '"139300","2014-01-19 06:29:58","422","added","121284","15536","81","6","http://rdaregistry.info/Elements/a/P50204","14069","en","1",,';
        $CsvValues[] =
              '"139301","2014-01-19 06:31:45","422","added","121285","15536","81","6","http://rdaregistry.info/Elements/u/P60001","14603","en","1",,';
        $CsvValues[] =
              '"139302","2014-01-19 06:33:14","422","added","121286","15536","81","15","http://rdaregistry.info/Elements/w/P10001","15304","en","1",,';
        $CsvValues[] =
              '"141444","2014-04-26 02:27:36","422","added","122794","15536","81","16","http://rdaregistry.info/Elements/a/respondentOf",,"en","1",,';
        $this->TestData('reg_schema_property_element_history', $CsvHeader, $CsvValues, $I, $CsvNullMe, [
              'created_at',
              'updated_at',
              'deleted_at',
        ]);
    }

    public function TestUnchanged(ImportTester $I)
    {
        $import = new ImportVocab("schema", "updatedata_nochange.CSV", 77);
        $import->importFolder = Fixtures::get("importFolder");
        $import->importId = 41;
        $import->setCsvReader($import->file);
        $import->processProlog();
        $import->getDataColumnIds();
        $results = $import->processData();
        verify("There were 1 rows processed", $results->getSuccessCount())->equals(1);

        $CsvHeader =
              "id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_id,name,label,definition,comment,type,is_subproperty_of,parent_uri,uri,status_id,language,note,domain,orange,is_deprecated,url,lexical_alias";
        $CsvNullMe = '0,1,0,1,1,1,0,0,0,1,0,0,1,1,0,0,0,0,1,1,1,1,1';
        $CsvValues[] =
              '"15536","2014-01-19 11:29:58","2015-06-12 16:06:08",,"422","422","81","respondentOf","is respondent of","Relates a candidate for a degree who defends or opposes a thesis provided by the praeses in an academic disputation to the work.",,"Property","14069","http://rdaregistry.info/Elements/a/P50204","http://rdaregistry.info/Elements/a/P50001","1","en",,"http://rdaregistry.info/Elements/c/C10004","http://rdaregistry.info/Elements/c/C10001",,,"http://rdaregistry.info/Elements/a/respondentOf"';
        //$import->processParents();
        $this->TestData('reg_schema_property', $CsvHeader, $CsvValues, $I, $CsvNullMe, [
              'created_at',
              'updated_at',
              'deleted_at',
              'created_user_id',
        ]);

        //reg_schema_property_element

        $CsvValues = array();
        $CsvHeader =
              'id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_property_id,profile_property_id,is_schema_property,object,related_schema_property_id,language,status_id';
        $CsvNullMe = '0,1,0,1,1,1,0,0,1,0,1,0,1';
        $CsvValues[] =
              '"121276","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","1","1","respondentOf",,"en","1"';
        $CsvValues[] =
              '"121277","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","2","1","is respondent of",,"en","1"';
        $CsvValues[] =
              '"121278","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","3","1","Relates a candidate for a degree who defends or opposes a thesis provided by the praeses in an academic disputation to the work.",,"en","1"';
        $CsvValues[] =
              '"121279","2014-01-19 11:29:58","2015-06-12 16:06:08",,"422","422","15536","4","1","property",,,"1"';
        $CsvValues[] =
              '"121280","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","11","1","http://rdaregistry.info/Elements/c/C10004","14331",,"1"';
        $CsvValues[] =
              '"121281","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","12","1","http://rdaregistry.info/Elements/c/C10001","14328",,"1"';
        $CsvValues[] =
              '"121282","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","13","1","http://rdaregistry.info/Elements/a/P50001","15536",,"1"';
        $CsvValues[] = '"121283","2014-01-19 11:29:58","2014-01-19 06:29:58",,"422","422","15536","14","1","1",,,"1"';
        $CsvValues[] =
              '"121284","2014-01-19 11:29:58","2015-06-12 16:06:06","2015-06-12 16:06:06","422","422","15536","6","1","http://rdaregistry.info/Elements/a/P50204","14069",,"1"';
        $CsvValues[] =
              '"121285","2014-01-19 11:31:45","2015-06-12 16:06:08","2015-06-12 16:06:08","422","422","15536","6",,"http://rdaregistry.info/Elements/u/P60001","14603",,"1"';
        $CsvValues[] =
              '"121286","2014-01-19 11:33:14","2014-01-19 06:33:14",,"422","422","15536","15",,"http://rdaregistry.info/Elements/w/P10001","15304",,"1"';
        $CsvValues[] =
              '"122794","2014-04-26 06:27:36","2015-06-12 16:06:08","2015-06-12 16:06:08","422","422","15536","16",,"http://rdaregistry.info/Elements/a/respondentOf",,,"1"';
        $CsvValues[] =
              '"122968","2015-06-12 16:06:08","2015-06-12 16:06:08",,"422","422","15536","27",,"http://rdaregistry.info/Elements/a/respondentOf",,"en","1"';
        $CsvValues[] =
              '"122969","2015-06-12 16:06:08","2015-06-12 16:06:08",,"422","422","15536","26",,"http://rdaregistry.info/Elements/u/P60001",,"","1"';
        $dateFields = [
              'created_at' => [
                    122968,
                    122969,
              ],
              'updated_at' => [
                    121284,
                    121285,
                    122794,
                    122968,
                    122969,
              ],
              'deleted_at' => [
                    121284,
              ],
        ];
        $this->TestData('reg_schema_property_element', $CsvHeader, $CsvValues, $I, $CsvNullMe, [], $dateFields);

        //reg_schema_property_element_history

        $CsvValues = array();
        $CsvHeader =
              'id,created_at,created_user_id,action,schema_property_element_id,schema_property_id,schema_id,profile_property_id,object,related_schema_property_id,language,status_id,change_note,import_id';
        $CsvNullMe = '0,0,1,1,1,1,1,1,1,1,0,1,1,1';
        $CsvValues[] =
              '"141929","2015-06-12 19:24:42","422","deleted","121284","15536","81","6","http://rdaregistry.info/Elements/a/P50204","14069",,"1",,"41"';
        $CsvValues[] =
              '"141930","2015-06-12 19:24:42","422","deleted","121285","15536","81","6","http://rdaregistry.info/Elements/u/P60001","14603",,"1",,"41"';
        $CsvValues[] =
              '"141931","2015-06-12 19:24:42","422","deleted","122794","15536","81","16","http://rdaregistry.info/Elements/a/respondentOf",,,"1",,"41"';
        $CsvValues[] =
              '"141932","2015-06-12 19:24:43","422","added","122968","15536","81","27","http://rdaregistry.info/Elements/a/respondentOf",,"en","1",,"41"';
        $CsvValues[] =
              '"141933","2015-06-12 19:24:43","422","added","122969","15536","81","26","http://rdaregistry.info/Elements/u/P60001",,,"1",,"41"';

        $table = 'reg_schema_property_element_history';
        $this->TestData($table, $CsvHeader, $CsvValues, $I, $CsvNullMe, [], [
              'created_at' => [
                    141929,
                    141930,
                    141931,
                    141932,
                    141933,
                    141934,
              ],
        ]);

        //this history element should not exist. The element should not have been updated -- property should have been Property
        //'id,created_at,created_user_id,action,schema_property_element_id,schema_property_id,schema_id,profile_property_id,object,related_schema_property_id,language,status_id,change_note,import_id
        //"141932","2015-06-12 22:38:40","422","updated","121279","15536","81","4","property",,,"1",,"41"'
        $I->dontSeeInDatabase($table,['id'=>141932, 'object'=> 'property']);

        //this schema_property_element should not have been deleted -- it's the parent property
        //it's still listed as the parent_uri in the form
        //id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_property_id,profile_property_id,is_schema_property,object,related_schema_property_id,language,status_id
        //"121284","2014-01-19 11:29:58","2015-06-12 22:38:40","2015-06-12 22:38:40","422","422","15536","6","1","http://rdaregistry.info/Elements/a/P50204","14069",,"1"
        //count of schema_property_element schema_property_id = 14603 should be 9


    }

    public function unchangedAfterUpdateRelatedTest()
    {

        $job = new UpdateRelatedJob();
        $job->perform(array(
              SF_ENVIRONMENT,
              41,
        ));
        //these two rows should have their related...ids updated
//        id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_property_id,profile_property_id,is_schema_property,object,related_schema_property_id,language,status_id
//"122968","2015-06-12 22:55:26","2015-06-12 22:55:26",,"422","422","15536","27",,"http://rdaregistry.info/Elements/a/respondentOf","15536","en","1"
//"122969","2015-06-12 22:55:26","2015-06-12 22:55:29",,"422","422","15536","26",,"http://rdaregistry.info/Elements/u/P60001","14603",,"1"

        //this row should not be there -- updating the related_id shouldn't trigger a history event
//        id,created_at,created_user_id,action,schema_property_element_id,schema_property_id,schema_id,profile_property_id,object,related_schema_property_id,language,status_id,change_note,import_id
//"141935","2015-06-12 22:55:29","422","updated","122969","15536","81","26","http://rdaregistry.info/Elements/u/P60001","14603",,"1",,"41"

        //this row should have been added
//        id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_property_id,profile_property_id,is_schema_property,object,related_schema_property_id,language,status_id
//"122970","2015-06-12 23:04:17","2015-06-12 23:04:17",,"422","422","14603","8",,"http://rdaregistry.info/Elements/a/P50001","15536",,"1"
        //this row should have been added
//        id,created_at,created_user_id,action,schema_property_element_id,schema_property_id,schema_id,profile_property_id,object,related_schema_property_id,language,status_id,change_note,import_id
//"141936","2015-06-12 23:04:17","422","added","122970","14603","82","8","http://rdaregistry.info/Elements/a/P50001","15536",,"1",,



        //count of schema_property_element schema_property_id = 14603 should be 10
        //count of schema_property_element schema_property_id = 15536 should be 14


    }

    /**
     * @param               $table
     * @param               $CsvHeader
     * @param array         $CsvValues
     * @param \ImportTester $I
     * @param array         $nullMe
     *
     * @param array         $exclude
     *
     * @param array         $dateFields a list of fields to check a date on
     *
     * @internal param array $dateIds a list of ids to check a date on
     * @internal param array $compare
     */
    private function TestData(
          $table,
          $CsvHeader,
          $CsvValues,
          ImportTester $I,
          $nullMe,
          $exclude = array(),
          $dateFields = array()
    ) {
        foreach ($CsvValues as $CsvValue) {
            $originalData = $I->getArrayFromCsv($CsvHeader, $CsvValue, $exclude);
            $nullData = $I->getArrayFromCsv($CsvHeader, $nullMe);
            foreach ($originalData as $key => $value) {
                if ($key !== 'id') {
                    $value = ($nullData[$key] and empty($value)) ? null : $value;
                    if (array_key_exists($key, $dateFields)) {
                        if (in_array($originalData['id'], $dateFields[$key])) {
                            $columnData = $I->grabFromDatabase($table, $key, [
                                  'id' => $originalData['id'],
                            ]);
                            if ($columnData) {
                                $dbTime = new DateTime($columnData);
                                $now = new DateTime();
                                $diff = date_diff($now, $dbTime);
                                //here we're looking to see if the date recorded was in the last 10 hours
                                $I->assertTrue($diff->h < 10, "This row was updated in the last 10 hours");
                            }
                        }
                    } else {
                        //here we're just looking for an exact match. Can't use it for dates, whicch aren't stable
                        $I->canSeeInDatabase($table, [
                              'id' => $originalData['id'],
                              $key => $value,
                        ]);
                    }
                }
            }
        }
    }
}

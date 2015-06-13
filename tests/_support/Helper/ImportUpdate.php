<?php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module;

class ImportUpdate extends Module
{
    /**
     * Takes a SQL import string for a single row and returns a properly formatted array for insertion
     * via $I->haveInDatabase()
     *
     * Input string should look like:
     * INSERT INTO `reg_schema_property_element` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_user_id`, `updated_user_id`, `schema_property_id`, `profile_property_id`, `is_schema_property`, `object`, `related_schema_property_id`, `language`, `status_id`) VALUES
    (110489,'2014-01-19 03:45:21','2014-01-18 22:45:21',NULL,422,422,14603,1,1,'respondentOf',NULL,'en',1);
     *
     * @param $sql
     *
     * @return array|bool
     */
    public function getArrayFromSql($sql)
    {
        preg_match("/^INSERT INTO .*\\((.*)\\).*\\((.*)\\)\\;/uis", $sql, $matches);
        if (isset($matches[1])) {
            $matches[1] = preg_replace("/, `/ui", ",`", $matches[1]);
            $keys = explode(',', preg_replace("/`/uis", "", $matches[1]));
            $values = str_getcsv($matches[2]);
            $values = explode(',', $matches[2]);
            $values = array_map(function ($value) {
                preg_match("/^'?(.*)'?$/ui", $value, $matches);

                return $matches[1];
            }, $values);

            return array_combine($keys, $values);
        }

        return false;
    }

    /**
     * @param       $CsvHeader
     * @param       $CsvValues
     *
     * @param array $exclude
     *
     * @return array
     */
    public function getArrayFromCsv($CsvHeader, $CsvValues, array $exclude = [])
    {
        $keys = str_getcsv($CsvHeader);
        $values = str_getcsv($CsvValues);

        $array = array_combine($keys, $values);
        if ( count($exclude)) {
            foreach ($exclude as $key) {
                if (isset($array[$key])) {
                    unset($array[$key]);
                }
            }
        }

        return $array;
    }
}

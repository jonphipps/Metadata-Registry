<?php

/**
 * importmarc batch script
 *
 * Here goes a brief description of the purpose of the batch script
 *
 * @package    registry
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
require_once 'Console/Getopt.php';
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
//     insert jon's user id
$userId = 36;


$cg = new Console_Getopt();
$args = $cg->readPHPArgv();
array_shift($args);

$shortOpts = 's::v::f:d';
$longOpts  = array('schema_id==', 'vocab_id==', 'file=', 'delete_missing');

$params = $cg->getopt2($args, $shortOpts, $longOpts);
if (PEAR::isError($params)) {
    echo 'Error: ' . $params->getMessage() . "\n";
    exit(1);
}

var_dump(condense_arguments($params));
debugbreak();
//     concept scheme or element set selected (get from command line)
//        schema_id= vocab_id= file=     -delete_missing
//       -snnnnn    -vnnnnnn  -fnnnnnnnn -d

//     Select a file (get from the command line)
//     determine/ask the file type (rdf, xml, json, csv) (get from file extension)
//     determine/ask the object type (get from command line)

/* From here on the process is the same regardless of UI */

//execute
//     parse file to get the fields/columns and data
//     check to see if file has been uploaded before
//          check import history for file name
//          if reimport
//               get last import history for filename
//               unserialize column map
//               match column names to AP based on map
//     look for matches in unmatched field/column names to AP (ideal)
//     csv table of data --
//          row1: parsed field names/column headers
//          row2: select dropdown with available fields from object AP (pre-select known matches)
//                each select identified by column number
//          row3: display datatype of selected field (updated dynamically when field selected)
//          row4-13: first 10 rows of parsed data from file
//     require a column that can match to 'URI' (maybe we'll allow an algorithm later)
//     require columns that are required by AP
//     on reimport there should be a flag to 'delete missing properties' from the current data
//     note: at some point there will be a reimport process that allows URI changing
//          this will require that there be an OMR identifier embedded in the incoming data
//executeImport:
//     serialize the column map
//     try...
//       parse the file again
//       for each line
//          lookup the URI (or the OMR ID if available) for a match
//          if no match
//               create a new concept or element
//               create a new property for each matched column
//          else
//               lookup and update concept or element
//               lookup and update each property
//          update the history for each property, action is 'import', should be a single timestamp for all (this should be automatic)
//          if 'delete missing properties' is true
//               delete each existing, non-required property that wasn't updated by the import
//          catch
//            if there's an error of any kind, write to error log and continue
//     save the import history file (match timestamp to history entries)

/* output to stdout*/
//          number of objects imported (link to history, filtered on timestamp of import)
//          number of errors (link to error log)

/**
 * Make a key-value array.
 * Since Console_Getopt does not provide such a method,
 * we implement it ourselves.
 *
 * @params array $params Array of parameters from Console_Getopt::getopt2()
 *
 * @return array key-value pair array
 */
function &condense_arguments($params)
{
    $new_params = array();
    foreach ($params[0] as $param) {
        $new_params[$param[0]] = $param[1];
    }
    return $new_params;
}


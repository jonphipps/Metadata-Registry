<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ImportVocab\ImportVocab;

class importVocabulary implements ShouldQueue
{
  use InteractsWithQueue, Queueable, SerializesModels;
  /**
   * @var int
   */
  private $schemaId;
  /**
   * @var string
   */
  private $filePath;
  /**
   * @var int
   */
  private $importId;
  /**
   * @var string
   */
  private $environment;
  /**
   * @var string
   */
  private $type;


  /**
   * Create a new job instance.
   *
   * @param int $schemaId
   * @param string $filePath
   * @param int $importId
   * @param string $environment
   * @param string $type
   */
  public function __construct($schemaId, $filePath, $importId, $environment, $type)
  {

    $this->schemaId    = $schemaId;
    $this->filePath    = $filePath;
    $this->importId    = $importId;
    $this->environment = $environment;
    $this->type        = $type;
  }


  /**
   * Execute the job.
   *
   * @throws \Exception
   * @throws \PropelException
   */
  public function handle()
  {
    // Set up environment for this job
    define('SF_ROOT_DIR', __DIR__ . '/../..');
    define('SF_APP', 'frontend');
    define('SF_ENVIRONMENT', $this->environment);
    define('SF_DEBUG', false);

    //initialize composer
    require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    // initialize symfony
    require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
    // initialize database manager
    $databaseManager = new \sfDatabaseManager();
    $databaseManager->initialize();

    $import = new ImportVocab($this->type, $this->filePath, $this->schemaId);
    try {
      $fileImportHistory = \FileImportHistoryPeer::retrieveByPK($this->importId);
    }
    catch (\PropelException $e) {
      //exit the job with an error
      throw $e;
    }

    try {
      if ('schema' == $this->type) {
        $schema = \SchemaPeer::retrieveByPK($this->schemaId);
      } else {
        $schema = \VocabularyPeer::retrieveByPK($this->schemaId);
      }
    }
    catch (\PropelException $e) {
      //exit the job with an error
      throw $e;
    }

    // Perform some job
    $import->importId = $this->importId;
    //todo update the prefixes table with prefixes
    //todo update the schema table with prefixes
    $schemaPrefixes      = $schema->getPrefixes();
    $countSchemaPrefixes = count($schemaPrefixes);
    /** @var string[] $importPrefixes */
    $importPrefixes = $import->prolog['prefix'];
    foreach ($importPrefixes as $prefix => $url) {
      if (trim($prefix)) {
        if ( ! array_key_exists($prefix, $schemaPrefixes)) {
          $schemaPrefixes[$prefix] = $url;
        }
      }
    }
    if (count($schemaPrefixes) != $countSchemaPrefixes) {
      $schema->setPrefixes($schemaPrefixes);
      $schema->save();
    }
    try {

      $import->processProlog();
      $import->processData();
      $fileImportHistory->setResults($import->results);
      $fileImportHistory->setMap($import->mapping);
      $fileImportHistory->setTotalProcessedCount($import->DataWorkflowResults->getTotalProcessedCount());
      $fileImportHistory->setErrorCount($import->DataWorkflowResults->getErrorCount());
      $fileImportHistory->setSuccessCount($import->DataWorkflowResults->getSuccessCount());
      $fileImportHistory->setResults('Your file has been imported. It took us: ' . $import->DataWorkflowResults->getElapsed()
                                                                                                               ->format("%h hours; %i minutes; %s seconds"));
      $fileImportHistory->save();
    }
    catch (\Exception $e) {
      $fileImportHistory->setResults("There was an error processing the import. Message: " . $e->getMessage());
      $fileImportHistory->save();
      throw $e;
    }
    $agentId     = ( $fileImportHistory->getSchema() ) ? $fileImportHistory->getSchema()
                                                                           ->getAgentId() : $fileImportHistory->getVocabulary()
                                                                                                              ->getAgentId();
    $newFilePath = \sfConfig::get('sf_repos_dir') . DIRECTORY_SEPARATOR . 'agents' . DIRECTORY_SEPARATOR . $agentId . DIRECTORY_SEPARATOR . $fileImportHistory->getSourceFileName();
    $request     = new \myWebRequest();
    $result      = $request->moveToRepo($this->filePath, $newFilePath);
    $schema      = \SchemaPeer::retrieveByPK($this->schemaId);
    if ($schema) {
      $schema->setUpdatedAt(time());
      $schema->setUpdatedUserId($import->userId);
      $schema->save();
    }

    unset ($import);
    unset ($request);
    unset($databaseManager);

  }
}

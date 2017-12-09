<?php

namespace App\Jobs;

use App\Models\VocabsModel;
use apps\frontend\lib\services\jsonldElementsetService;
use apps\frontend\lib\services\jsonldVocabularyService;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use sfContext;

class GenerateRdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const VOCABULARY = 'Vocabulary';
    public const ELEMENTSET = 'Elementset';

    private const URLARRAY = [ self::VOCABULARY => 'vocabularies/', self::ELEMENTSET => 'elementsets/' ];

     /** @var int $projectId */
    private $projectId;

    /** @var string $class */
    private $class;

    /** @var int $id */
    private $id;

    /** @var string $filePath */
    private $filePath;

    /** @var string $fileName */
    private $fileName;


    /**
     * Create a new job instance.
     *
     * @param $class
     * @param $id
     */
    public function __construct($class, $id)
    {
        $this->id        = $id;
        $this->class     = $class;
        /** @var VocabsModel $vocab */
        $vocab           = "\\App\\Models\\{$class}";
        $model           = $vocab::findOrFail($id);
        $this->projectId = $model->project_id;
        $basePath        = parse_url($model->base_domain)['path'];
        $this->filePath  = rtrim(parse_url($model->uri)['path'],'/');
        $this->fileName  = str_replace_first($basePath, '', parse_url($model->uri)['path']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //make sure we have a repo and create one if we don't
        //get the rdf/xml and store it in the repo
        $this->saveXml();

        //get the jsonld and store it in the repo
        //run the translators to generate the other flavours and store in the repo
        //store the jsonld (default) or any other flavour of RDF on the vocabulary
    }

     public function getStoragePath($mimeType)
    {
        return storage_path("repos/projects/{$this->projectId}/{$mimeType}{$this->filePath}.$mimeType");
    }

    public function saveXml()
    {
        $storagePath = $this->getStoragePath('xml');
        $client      = new Client();
        $res         = $client->get(url(self::URLARRAY[ $this->class ] . $this->id . '.rdf'));
        Storage::put($storagePath, $res->getBody());
    }

    public function saveJsonLd()
    {
        $storagePath = $this->getStoragePath('jsonld');
        initSymfonyDb();
        if ($this->class === self::VOCABULARY) {
            $vocabulary = \VocabularyPeer::retrieveByPK($this->id);
            $jsonLdService = new jsonldVocabularyService($vocabulary);
        }
        if ($this->class === self::ELEMENTSET) {
            $elementset = \SchemaPeer::retrieveByPK($this->id);
            $jsonLdService = new jsonldElementsetService($elementset);
        }
        Storage::put($storagePath, $jsonLdService->getJsonLd());
    }
}

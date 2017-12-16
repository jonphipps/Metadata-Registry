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
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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
    private $disk;

    /**
     * Create a new job instance.
     *
     * @param $class
     * @param $id
     * @param $disk
     */
    public function __construct($class, $id, $disk = 'repos')
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
        $this->disk = $disk;
        $this->initDir();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        //make sure we have a repo and create one if we don't
        //get the rdf/xml and store it in the repo
        $this->saveXml();

        //get the jsonld and store it in the repo
        //run the translators to generate the other flavours and store in the repo
        //store the jsonld (default) or any other flavour of RDF on the vocabulary
    }

    /**
     * @param $mimeType
     *
     * @return string
     */
    public function getStoragePath($mimeType): string
    {
        return "{$this->getProjectPath()}{$mimeType}{$this->filePath}.$mimeType";
    }

    public function getProjectPath()
    {
        return "projects/{$this->projectId}/";
    }

    /**
     * @return $this
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     */
    public function initDir()
    {
        if (! Storage::disk($this->disk)->exists($this->getProjectPath())) {
            Storage::disk($this->disk)->createDir($this->getProjectPath());

            $dir = Storage::disk($this->disk)->path($this->getProjectPath());

            $process = new Process('git init', $dir);
            $process->run();

            // executes after the command finishes
            if ( ! $process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }
        return $this;
    }

    public function saveXml()
    {
        $storagePath = $this->getStoragePath('xml');
        $client      = new Client();
        $res         = $client->get(url(self::URLARRAY[ $this->class ] . $this->id . '.rdf'));
        Storage::disk($this->disk)->put($storagePath, $res->getBody());
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
        Storage::disk($this->disk)->put($storagePath, $jsonLdService->getJsonLd());
    }

    public function saveTtl()
    {
        $this->runRapper('ttl', 'turtle');
    }

    public function saveNt()
    {
        $this->runRapper('nt', 'ntriples');
    }

    public function saveN3()
    {
        $this->runCurl('n3');
    }

    public function saveRdfJson()
    {
        $this->runCurl('rdf-json');
    }

    public function saveMicrodata()
    {
        $this->runCurl('microdata');
    }

    public function saveRdfa()
    {
        $this->runCurl('rdfa');
    }

    /**
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    private function runRapper($mimeType, $rapperType)
    {
        $outputPath = $this->getStoragePath($mimeType);
        //just to make sure the path exists
        Storage::disk($this->disk)->put($outputPath, ' ');
        //make sure rapper has the full paths
        $sourcePath = Storage::disk($this->disk)->path($this->getStoragePath('xml'));
        $outputPath = Storage::disk($this->disk)->path($this->getStoragePath($mimeType));
        $process    = new Process("rapper -o {$rapperType} {$sourcePath} > {$outputPath}");
        $process->run();

        // executes after the command finishes
        if ( ! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    public function runCurl($mimeType)
    {
        $outputPath = $this->getStoragePath($mimeType);
        //just to make sure the path exists
        Storage::disk($this->disk)->put($outputPath, ' ');
        //make sure we have the full paths
        $sourcePath = Storage::disk($this->disk)->path($this->getStoragePath('xml'));
        $outputPath = Storage::disk($this->disk)->path($this->getStoragePath($mimeType));
        $process    = new Process("curl --data-urlencode content@{$sourcePath} http://rdf-translator.appspot.com/convert/xml/{$mimeType}/content > {$outputPath}");
        $process->run();

        // executes after the command finishes
        if ( ! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    /**
     * @param $vocab
     */
    private function updateRelease(VocabsModel $vocab)
    {
        $vocab->releases()->updateExistingPivot($this->release->id, [ 'published_at' => Carbon::now()->format('F j, Y') ]);
    }
}

<?php

namespace Tests\Feature\OMR;

use App\Jobs\GenerateRdf;
use Illuminate\Support\Facades\Storage;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Process\Process;
use Tests\TestCase;

class RDFGeneratorServiceTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp(): void
    {
        $this->dontSetupDatabase();

        parent::setUp();
    }

    /** @test
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function runGeneratorTests()
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);

        //start with an empty test directory
        storage::disk('test')->deleteDirectory('projects');

        $this->it_creates_a_new_project_directory_and_inits_git();

        $this->it_creates_a_new_vocabulary_job_and_stores_xml();
        $this->it_creates_a_new_elementset_job_and_stores_xml();
        $this->it_creates_a_new_vocabulary_job_and_stores_jsonld();
        $this->it_creates_a_new_elementset_job_and_stores_jsonld();
        $this->it_creates_a_new_elementset_job_and_stores_ttl();
        $this->it_creates_a_new_vocabulary_job_and_stores_ttl();
        $this->it_creates_a_new_elementset_job_and_stores_nt();
        $this->it_creates_a_new_vocabulary_job_and_stores_nt();
        $this->it_creates_a_new_elementset_job_and_stores_n3();
        $this->it_creates_a_new_vocabulary_job_and_stores_n3();

        //These tests don't generate consistent results when checking file contents
        $this->it_creates_a_new_elementset_job_and_stores_rdf_json();
        $this->it_creates_a_new_vocabulary_job_and_stores_rdf_json();
        $this->it_creates_a_new_elementset_job_and_stores_microdata();
        $this->it_creates_a_new_vocabulary_job_and_stores_microdata();
        $this->it_creates_a_new_elementset_job_and_stores_rdfa();
        $this->it_creates_a_new_vocabulary_job_and_stores_rdfa();

    }

    private function it_creates_a_new_project_directory_and_inits_git()
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37, 'test');
        Storage::disk('test')->assertExists($job->getProjectPath().'.git');
        // $dir = Storage::disk('test')->path($job->getProjectPath());
        // $process = new Process('git status', $dir);
        // $process->run();
        // $this->assertTrue($process->isSuccessful());
    }
    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_vocabulary_job_and_stores_xml(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37, 'test');
        dispatch($job);
        $this->assertSame(storage_path('test/projects/177/xml/termList/RDAMediaType.xml'), Storage::disk('test')->path($job->getStoragePath('xml')));
        $file = Storage::disk('test')->get($job->getStoragePath('xml'));
        $this->assertMatchesXmlSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */    private function it_creates_a_new_elementset_job_and_stores_xml(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83, 'test');
        dispatch($job);
        $this->assertSame(storage_path('test/projects/177/xml/Elements/c.xml'), Storage::disk('test')->path($job->getStoragePath('xml')));
        $file = Storage::disk('test')->get($job->getStoragePath('xml'));
        $this->assertMatchesXmlSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_vocabulary_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveJsonLd();
        $this->assertSame('projects/177/jsonld/termList/RDAMediaType.jsonld',
            $job->getStoragePath('jsonld'));
        $file = Storage::disk('test')->get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_elementset_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83, 'test');
        $job->saveJsonLd();
        $this->assertSame('projects/177/jsonld/Elements/c.jsonld', $job->getStoragePath('jsonld'));
        $file = Storage::disk('test')->get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_elementset_job_and_stores_ttl(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveTtl();
        $this->assertSame(storage_path('test/projects/177/ttl/Elements/c.ttl'), Storage::disk('test')->path($job->getStoragePath('ttl')));
        $file = Storage::disk('test')->get($job->getStoragePath('ttl'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
   private function it_creates_a_new_vocabulary_job_and_stores_ttl(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveTtl();
        $this->assertSame(storage_path('test/projects/177/ttl/termList/RDAMediaType.ttl'), Storage::disk('test')->path($job->getStoragePath('ttl')));
        $file = Storage::disk('test')->get($job->getStoragePath('ttl'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_elementset_job_and_stores_nt(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveNt();
        $this->assertSame(storage_path('test/projects/177/nt/Elements/c.nt'), Storage::disk('test')->path($job->getStoragePath('nt')));
        $file = Storage::disk('test')->get($job->getStoragePath('nt'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
   private function it_creates_a_new_vocabulary_job_and_stores_nt(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveNt();
        $this->assertSame(storage_path('test/projects/177/nt/termList/RDAMediaType.nt'), Storage::disk('test')->path($job->getStoragePath('nt')));
        $file = Storage::disk('test')->get($job->getStoragePath('nt'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function it_creates_a_new_elementset_job_and_stores_n3(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveN3();
        $this->assertSame(storage_path('test/projects/177/n3/Elements/c.n3'), Storage::disk('test')->path($job->getStoragePath('n3')));
        $file = Storage::disk('test')->get($job->getStoragePath('n3'));
        $this->assertMatchesSnapshot($file);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
   private function it_creates_a_new_vocabulary_job_and_stores_n3(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveN3();
        $this->assertSame(storage_path('test/projects/177/n3/termList/RDAMediaType.n3'), Storage::disk('test')->path($job->getStoragePath('n3')));
        $file = Storage::disk('test')->get($job->getStoragePath('n3'));
        $this->assertMatchesSnapshot($file);
    }

    private function it_creates_a_new_elementset_job_and_stores_rdf_json(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveRdfJson();
        $this->assertSame(storage_path('test/projects/177/rdf-json/Elements/c.rdf-json'), Storage::disk('test')->path($job->getStoragePath('rdf-json')));
        Storage::disk('test')->assertExists($job->getStoragePath('rdf-json'));
        //$file = Storage::disk('test')->get($job->getStoragePath('rdf-json'));
        //$this->assertMatchesSnapshot($file);
    }

   private function it_creates_a_new_vocabulary_job_and_stores_rdf_json(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveRdfJson();
        $this->assertSame(storage_path('test/projects/177/rdf-json/termList/RDAMediaType.rdf-json'), Storage::disk('test')->path($job->getStoragePath('rdf-json')));
        //we can't check the file contents because the results are different everytime
        Storage::disk('test')->assertExists($job->getStoragePath('rdf-json'));
    }

    private function it_creates_a_new_elementset_job_and_stores_microdata(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveMicrodata();
        $this->assertSame(storage_path('test/projects/177/microdata/Elements/c.microdata'), Storage::disk('test')->path($job->getStoragePath('microdata')));
        //we can't check the file contents because the results are different everytime
        Storage::disk('test')->assertExists($job->getStoragePath('microdata'));
        //$file = Storage::disk('test')->get($job->getStoragePath('microdata'));
        //$this->assertMatchesSnapshot($file);
    }

   private function it_creates_a_new_vocabulary_job_and_stores_microdata(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveMicrodata();
        $this->assertSame(storage_path('test/projects/177/microdata/termList/RDAMediaType.microdata'), Storage::disk('test')->path($job->getStoragePath('microdata')));
        Storage::disk('test')->assertExists($job->getStoragePath('microdata'));
        //$file = Storage::disk('test')->get($job->getStoragePath('microdata'));
        //$this->assertMatchesSnapshot($file);
    }

    private function it_creates_a_new_elementset_job_and_stores_rdfa(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveRdfa();
        $this->assertSame(storage_path('test/projects/177/rdfa/Elements/c.rdfa'), Storage::disk('test')->path($job->getStoragePath('rdfa')));
        //we can't check the file contents because the results are different everytime
        Storage::disk('test')->assertExists($job->getStoragePath('rdfa'));
        //$file = Storage::disk('test')->get($job->getStoragePath('rdfa'));
        //$this->assertMatchesSnapshot($file);
    }

   private function it_creates_a_new_vocabulary_job_and_stores_rdfa(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveRdfa();
        $this->assertSame(storage_path('test/projects/177/rdfa/termList/RDAMediaType.rdfa'), Storage::disk('test')->path($job->getStoragePath('rdfa')));
        Storage::disk('test')->assertExists($job->getStoragePath('rdfa'));
        //$file = Storage::disk('test')->get($job->getStoragePath('microdata'));
        //$this->assertMatchesSnapshot($file);
    }

    public function tearDown(): void
    {
        //if (\function_exists('xdebug_break')) xdebug_break();
        //this is necessary because the laravel test suite always starts session output capture
        if (ob_get_level() > 1) {
            ob_end_clean();
        }
    }
}

<?php

namespace Tests\Feature\OMR;

use App\Jobs\GenerateRdf;
use Illuminate\Support\Facades\Storage;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class RDFGeneratorServiceTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp(): void
    {
        //self::$setupDatabase = true;
        $this->dontSetupDatabase();

        parent::setUp();
    }

    /** @test */
    public function runGeneratorTests()
    {
        $this->it_creates_a_new_vocabulary_job_and_stores_xml();
        $this->it_creates_a_new_elementset_job_and_stores_xml();
        $this->it_creates_a_new_vocabulary_job_and_stores_jsonld();
        $this->it_creates_a_new_elementset_job_and_stores_jsonld();
        $this->it_creates_a_new_elementset_job_and_stores_ttl();
        $this->it_creates_a_new_vocabulary_job_and_stores_ttl();

    }
    private function it_creates_a_new_vocabulary_job_and_stores_xml(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37, 'test');
        dispatch($job);
        $this->assertSame(storage_path('test/projects/177/xml/termList/RDAMediaType.xml'), Storage::disk('test')->path($job->getStoragePath('xml')));
        $file = Storage::disk('test')->get($job->getStoragePath('xml'));
        $this->assertMatchesXmlSnapshot($file);
    }

    private function it_creates_a_new_elementset_job_and_stores_xml(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83, 'test');
        dispatch($job);
        $this->assertSame(storage_path('test/projects/177/xml/Elements/c.xml'), Storage::disk('test')->path($job->getStoragePath('xml')));
        $file = Storage::disk('test')->get($job->getStoragePath('xml'));
        $this->assertMatchesXmlSnapshot($file);
    }

    private function it_creates_a_new_vocabulary_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37);
        $job->saveJsonLd();
        $this->assertSame('projects/177/jsonld/termList/RDAMediaType.jsonld',
            $job->getStoragePath('jsonld'));
        $file = Storage::disk('repos')->get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }

    private function it_creates_a_new_elementset_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83);
        $job->saveJsonLd();
        $this->assertSame('projects/177/jsonld/Elements/c.jsonld', $job->getStoragePath('jsonld'));
        $file = Storage::disk('repos')->get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }

    private function it_creates_a_new_elementset_job_and_stores_ttl(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83,'test');
        $job->saveTtl();
        $this->assertSame(storage_path('test/projects/177/ttl/Elements/c.ttl'), Storage::disk('test')->path($job->getStoragePath('ttl')));
        $file = Storage::disk('test')->get($job->getStoragePath('ttl'));
        $this->assertMatchesSnapshot($file);
    }
   private function it_creates_a_new_vocabulary_job_and_stores_ttl(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37,'test');
        $job->saveTtl();
        $this->assertSame(storage_path('test/projects/177/ttl/termList/RDAMediaType.ttl'), Storage::disk('test')->path($job->getStoragePath('ttl')));
        $file = Storage::disk('test')->get($job->getStoragePath('ttl'));
        $this->assertMatchesSnapshot($file);
    }

    public function tearDown()
    {
        //if (\function_exists('xdebug_break')) xdebug_break();
        if (ob_get_level() > 1) {
            ob_end_clean();
        }
    }
}

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
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_creates_a_new_vocabulary_job_and_stores_xml(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37);
        dispatch($job);
        $this->assertSame(storage_path('repos/projects/177/xml/termList/RDAMediaType.xml'),
            $job->getStoragePath('xml'));
        $file = Storage::get($job->getStoragePath('xml'));
        $this->assertMatchesXmlSnapshot($file);
    }

    /** @test */
    public function it_creates_a_new_vocabulary_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37);
        $job->saveJsonLd();
        $this->assertSame(storage_path('repos/projects/177/jsonld/termList/RDAMediaType.jsonld'),
            $job->getStoragePath('jsonld'));
        $file = Storage::get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }

    /** @test */
    public function it_creates_a_new_elementset_job_and_stores_jsonld(): void
    {
        $job = new GenerateRdf(GenerateRdf::ELEMENTSET, 83);
        $job->saveJsonLd();
        $this->assertSame(storage_path('repos/projects/177/jsonld/termList/RDAMediaType.jsonld'),
            $job->getStoragePath('jsonld'));
        $file = Storage::get($job->getStoragePath('jsonld'));
        $this->assertMatchesSnapshot($file);
    }
}

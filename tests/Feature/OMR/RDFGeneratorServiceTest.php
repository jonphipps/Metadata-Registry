<?php

namespace Tests\Feature\OMR;

use App\Jobs\GenerateRdf;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
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
    public function it_creates_a_new_job(): void
    {
        $job = new GenerateRdf(GenerateRdf::VOCABULARY, 37);
        dispatch($job);
    }

}

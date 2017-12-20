<?php

namespace Tests\Feature\OMR;

use App\Models\Elementset;
use apps\frontend\lib\services\jsonldElementsetService;
use apps\frontend\lib\services\jsonldVocabularyService;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class jsonldServiceTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp(): void
    {
        $this->dontSetupDatabase();
        parent::setUp();
        initSymfonyDb();
        $this->seedTestData();
    }

    /** @test */
    public function it_creates_a_jsonld_schema(): void
    {
        $schema = \SchemaPeer::retrieveByPK(83);
        $jsonService = new jsonldElementsetService($schema);
        $this->assertMatchesJsonSnapshot($jsonService->getJsonLd());
    }

    /** @test */
    public function it_creates_a_jsonld_vocabulary(): void
    {
        $vocab = \VocabularyPeer::retrieveByPK(37);
        $jsonService = new jsonldVocabularyService($vocab);
        $this->assertMatchesJsonSnapshot($jsonService->getJsonLd());
    }

}

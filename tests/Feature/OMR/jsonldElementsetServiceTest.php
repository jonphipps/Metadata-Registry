<?php

namespace Tests\Feature\OMR;

use App\Models\Elementset;
use apps\frontend\lib\services\jsonldElementsetService;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class jsonldElementsetServiceTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp(): void
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_creates_a_jsonld_fragment(): void
    {
        initSymfonyEnv();
        $schema = \SchemaPeer::retrieveByPK(83);
        ob_get_clean();
        $jsonService = new jsonldElementsetService($schema);
        $this->assertMatchesJsonSnapshot($jsonService->getJsonLd());
        if (\function_exists('xdebug_break')) xdebug_break();
    }
}

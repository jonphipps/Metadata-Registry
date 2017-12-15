<?php

namespace Tests\Feature\OMR;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class RDFGeneratorTest extends TestCase
{
    use MatchesSnapshots;

    public function setUp(): void
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function it_creates_a_file(): void
    {
        Storage::fake('repos');
        $file = UploadedFile::fake()->create('foobar.xml');
        $upload = Storage::disk('repos')->putFileAs('', $file, $file->name);
        Storage::disk('repos')->assertExists($upload);
    }

   /** @test */
    public function it_creates_an_rdf_xml_file_for_download(): void
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);

        $client = new Client();
        $res = $client->get(url('vocabularies/37.rdf'));
        $this->assertMatchesXmlSnapshot((string) $res->getBody());
        $this->assertSame(['attachment; filename="RDAMediaType.xml"'], $res->getHeader('Content-Disposition'));

        $res = $client->get(url('elementsets/83.rdf'));
        $this->assertMatchesXmlSnapshot((string) $res->getBody());
        $this->assertSame([ 'attachment; filename="c.xml"' ], $res->getHeader('Content-Disposition'));

        $res = $client->get(url('vocabularies/37/concepts/475.rdf'));
        $this->assertMatchesXmlSnapshot((string) $res->getBody());
        $this->assertArrayNotHasKey('Content-Disposition', $res->getHeaders());

        $res = $client->get(url('elementsets/83/elements/14329.rdf'));
        $this->assertMatchesXmlSnapshot((string) $res->getBody());
        $this->assertArrayNotHasKey('Content-Disposition', $res->getHeaders());

        Storage::fake('repos');
        $file = UploadedFile::fake()->create('foobar.xml');
        $upload = Storage::disk('repos')->putFileAs('', $file, $file->name);
        Storage::disk('repos')->assertExists($upload);
    }

}

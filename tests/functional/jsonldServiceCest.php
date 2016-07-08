<?php

use apps\frontend\lib\services\jsonldService;

class jsonldServiceCest
{
    private $valueVocabularyId = 58;

    /** @var \Vocabulary $vocab */
    private $vocab;

    public function _before(FunctionalTester $I)
    {
        $this->vocab = \VocabularyPeer::retrieveByPK($this->valueVocabularyId);
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function testFullJsonLD(FunctionalTester $I)
    {
        //i have a value vocabulary
        $vocab = $this->vocab;

        //then I retrieve the attributes for the vocabulary
        $GuzzleClient = new GuzzleHttp\Client(['base_uri'=> 'https://api.github.com']);
        $response = $GuzzleClient->request('GET', '/repos/RDARegistry/RDA-Vocabularies/releases/latest');
        $repoRelease = json_decode($response->getBody());
        $releaseVersion = $repoRelease->tag_name;
        $releaseDate = DateTime::createFromFormat(DateTime::W3C, $repoRelease->published_at)->format('F j, Y');
        $vocab->setRepo('RDARegistry/RDA-Vocabularies');
        $I->assertInstanceOf('Vocabulary', $vocab);

        //then I pass it to a new jsonld builder
        $jsonLdService = new jsonldService($vocab);
        $I->assertInstanceOf("Vocabulary", $jsonLdService->getVocabulary());
        //then I initialize the master array
        //then I build the attributes array
        $I->assertEquals($jsonLdService->jsonArray['@id'], "http://rdaregistry.info/termList/AspectRatio/","expected @id doesn't match URI");
        $I->assertEquals($jsonLdService->jsonArray['@type'], "ConceptScheme");
        $I->assertEquals($jsonLdService->jsonArray['title'], [ "en" => 'RDA Aspect Ratio' ]);
        $I->assertEquals($jsonLdService->jsonArray['description'], [ "en" => 'The ratio of the width to the height of a moving image.' ]);
        $I->assertEquals($jsonLdService->jsonArray['prefix'], "rdaar");
        //$I->assertEquals($jsonLdService->jsonArray['dateOfPublication'], "03/01/2016");
        $I->assertEquals($jsonLdService->jsonArray['token'], "AspectRatio");
        $I->assertEquals($jsonLdService->jsonArray['status'],
                         [
                             "@id"          => 'http://metadataregistry.org/uri/RegStatus/1001',
                             "label"        => "Published"
                         ]);
        $I->assertEquals("http://api.metadataregistry.org/vocabularies/58", $jsonLdService->jsonArray['api']);
        $I->assertEquals("http://www.rdaregistry.info/termList/AspectRatio/", $jsonLdService->jsonArray['url']);
        $I->assertEquals(
                         [
                               "en"=> [
                                   "Libraries",
                                   "Information Services"
                               ]
                         ],
                         $jsonLdService->jsonArray['tags']);
        $I->assertEquals("3", $jsonLdService->jsonArray['count']);
        $I->assertEquals([
        [
            "code"=> "ar",
          "lang"=> "Arabic",
          "source"=> $releaseVersion,
          "version"=> "WIP"
        ],
        [
            "code"=> "zh",
          "lang"=> "Chinese",
          "source"=> $releaseVersion,
          "version"=> $releaseVersion
        ],
        [
            "code"=> "nl",
          "lang"=> "Dutch",
          "source"=> $releaseVersion,
          "version"=> "WIP"
        ],
        [
            "code"=> "en",
          "lang"=> "English",
          "source"=> $releaseVersion,
          "version"=> $releaseVersion
        ],
        [
            "code"=> "fr",
          "lang"=> "French",
          "source"=> $releaseVersion,
          "version"=> $releaseVersion
        ],
        [
            "code"=> "de",
          "lang"=> "German",
          "source"=> $releaseVersion,
          "version"=> $releaseVersion
        ],
        [
            "code"=> "es",
          "lang"=> "Spanish",
          "source"=> $releaseVersion,
          "version"=> $releaseVersion
        ],
        [
            "code"=> "sv",
          "lang"=> "Swedish",
          "source"=> $releaseVersion,
          "version"=> "WIP"
        ]
      ],
                         $jsonLdService->jsonArray['languages']);
        $I->assertEquals($jsonLdService->jsonArray['dateOfPublication'], $releaseDate);

        /*
        $I->assertEquals(json_encode($jsonLdService->jsonArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), '{
              "@id": "http://rdaregistry.info/termList/AspectRatio",
              "@type": "ConceptScheme",
              "title": {
                "en": "RDA Aspect Ratio"
              },
              "description": {
                "en": "The ratio of the width to the height of a moving image."
              },
              "prefix":"rdaar",
              "status": "http://metadataregistry.org/uri/RegStatus/1001",
              "dateOfPublication":"03/01/2016",
              "api": "http://api.metadataregistry.org/vocabularies/58",
              "token": "AspectRatio",
              "url": "http://www.rdaregistry.info/termList/AspectRatio/",
              "count":3,
              "tags": {
                "en": [
                  "Libraries",
                  "Information Services"
                ]
              },
              "languages": [
                {
                  "code": "ar",
                  "lang": "Arabic",
                  "source": $releaseVersion,
                  "version": "WIP"
                },
                {
                  "code": "zh",
                  "lang": "Chinese",
                  "source": $releaseVersion,
                  "version": $releaseVersion
                },
                {
                  "code": "nl",
                  "lang": "Dutch",
                  "source": $releaseVersion,
                  "version": "WIP"
                },
                {
                  "code": "en",
                  "lang": "English",
                  "source": $releaseVersion,
                  "version": $releaseVersion
                },
                {
                  "code": "fr",
                  "lang": "French",
                  "source": $releaseVersion,
                  "version": $releaseVersion
                },
                {
                  "code": "de",
                  "lang": "German",
                  "source": $releaseVersion,
                  "version": $releaseVersion
                },
                {
                  "code": "es",
                  "lang": "Spanish",
                  "source": $releaseVersion,
                  "version": $releaseVersion
                },
                {
                  "code": "sv",
                  "lang": "Swedish",
                  "source": $releaseVersion,
                  "version": "WIP"
                }
              ]
            }');
        */



        //then I add it to the main array
        //then I retrieve each of the Concepts joined with their ConceptProfileProperty for the vocabulary
        //then I build the attributes array for each Concept
        //then I add it to the master array
        //when all done I export it to a file in the repo

        //i request a jsonld context representation of the profile for that vocabulary
        //i see a jsonld context file in the repository for that vocabulary
        //i see that the file contains the correct data
    }


    public function testGetTags(FunctionalTester $I)
    {
        $jsonLdService = new jsonldService($this->vocab);

        $I->assertEmpty($jsonLdService->getTags(''));
    }
    
}

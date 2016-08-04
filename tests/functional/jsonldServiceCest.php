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
        $I->assertEquals($jsonLdService->vocabArray['@id'], "http://rdaregistry.info/termList/AspectRatio/", "expected @id doesn't match URI");
        $I->assertEquals($jsonLdService->vocabArray['@type'], "ConceptScheme");
        $I->assertEquals($jsonLdService->vocabArray['title'], [ "en" => 'RDA Aspect Ratio' ]);
        $I->assertEquals($jsonLdService->vocabArray['description'], [ "en" => 'The ratio of the width to the height of a moving image.' ]);
        $I->assertEquals($jsonLdService->vocabArray['prefix'], "rdaar");
        $I->assertEquals($jsonLdService->vocabArray['dateOfPublication'], "July 28, 2016");
        $I->assertEquals($jsonLdService->vocabArray['token'], "AspectRatio");
        $I->assertEquals($jsonLdService->vocabArray['status'],
                         [
                             "@id"          => 'http://metadataregistry.org/uri/RegStatus/1001',
                             "label"        => "Published"
                         ]);
        $I->assertEquals("http://api.metadataregistry.org/vocabularies/58", $jsonLdService->vocabArray['omr_api']);
        $I->assertEquals("http://metadataregistry.org/vocabulary/show/id/58.html", $jsonLdService->vocabArray['omr_home']);
        $I->assertEquals("http://www.rdaregistry.info/termList/AspectRatio/", $jsonLdService->vocabArray['documentation']);
        $I->assertEquals(
                         [
                               "en"=> [
                                   "Libraries",
                                   "Information Services"
                               ]
                         ],
                         $jsonLdService->vocabArray['tags']);
        $I->assertEquals("3", $jsonLdService->vocabArray['count']);
        $I->assertEquals([
        [
            "code"=> "ar",
          "lang"=> "Arabic",
          "version"=> "WIP"
        ],
        [
            "code"=> "zh",
          "lang"=> "Chinese",
          "version"=> $releaseVersion
        ],
        [
            "code"=> "nl",
          "lang"=> "Dutch",
          "version"=> "WIP"
        ],
        [
            "code"=> "en",
          "lang"=> "English",
          "version"=> $releaseVersion
        ],
        [
            "code"=> "fr",
          "lang"=> "French",
          "version"=> $releaseVersion
        ],
        [
            "code"=> "de",
          "lang"=> "German",
          "version"=> $releaseVersion
        ],
        [
            "code"=> "es",
          "lang"=> "Spanish",
          "version"=> $releaseVersion
        ],
        [
            "code"=> "sv",
          "lang"=> "Swedish",
          "version"=> "WIP"
        ]
      ],
                         $jsonLdService->vocabArray['languages']);
        $I->assertEquals($jsonLdService->vocabArray['dateOfPublication'], $releaseDate);


        $I->assertEquals('{
  "@context": "http://rdaregistry.info/Contexts/concepts_langmap.jsonld",
  "@graph": [
    {
      "@id": "http://rdaregistry.info/termList/AspectRatio",
      "@type": "ConceptScheme",
      "title": {
        "en": "RDA Aspect Ratio Designation"
      },
      "description": {
        "en": "A general designation of the ratio of the width to the height of a moving image."
      },
      "prefix":"rdaar",
      "token": "AspectRatio",
      "status": "http://metadataregistry.org/uri/RegStatus/1001",
      "dateOfPublication":"07/28/2016",
      "omr_api": "http://api.metadataregistry.org/vocabularies/58",
      "omr_home": "http://metadataregistry.org/vocabulary/show/id/58.html",
      "documentation": "http://www.rdaregistry.info/termList/AspectRatio/",
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
          "version": "WIP"
        },
        {
          "code": "zh",
          "lang": "Chinese",
          "version": "2.4.3"
        },
        {
          "code": "nl",
          "lang": "Dutch",
          "version": "WIP"
        },
        {
          "code": "en",
          "lang": "English",
          "version": "2.4.3"
        },
        {
          "code": "fr",
          "lang": "French",
          "version": "2.4.3"
        },
        {
          "code": "de",
          "lang": "German",
          "version": "2.4.3"
        },
        {
          "code": "es",
          "lang": "Spanish",
          "version": "2.4.3"
        },
        {
          "code": "sv",
          "lang": "Swedish",
          "version": "WIP"
        }
      ]
    },
    {
      "@id": "http://rdaregistry.info/termList/AspectRatio/1003",
      "@type": "Concept",
      "toolkitDefinition": {
        "zh": "在同一资源中动态图像资源包括多种宽高比。",
        "de": "Bildformat einer Bewegtbildressource, die mehrere Bildformate innerhalb derselben Ressource enthält.",
        "es": "Proporción dimensional de un recurso que incluye múltiples proporciones dimensionales dentro del mismo recurso.",
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées comprenant divers formats de l\u2019image à l\u2019intérieur de la même ressource.",
        "en": "Aspect ratio for a moving image resource that includes multiple aspect ratios within thesame resource."
      },
      "toolkitLabel": {
        "en": "mixed",
        "zh": "混合",
        "es": "mixta",
        "de": "gemischt",
        "fr": "mixte"
      },
      "api": "http://api.metadataregistry.org/concepts/729",
      "status": "published",
      "definition": {
        "de": "Bildformat einer Bewegtbildressource, die mehrere Bildformate innerhalb derselben Ressource enthält.",
        "en": "Aspect ratio for a moving image resource that includes multiple aspect ratios within thesame resource.",
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées comprenant divers formats de l\u2019image à l\u2019intérieur de la même ressource.",
        "zh": "在同一资源中动态图像资源包括多种宽高比。",
        "es": "Proporción dimensional de un recurso que incluye múltiples proporciones dimensionales dentro del mismo recurso."
      },
      "inScheme": "http://rdaregistry.info/termList/AspectRatio/",
      "prefLabel": {
        "fr": "mixte",
        "zh": "混合",
        "en": "mixed",
        "es": "mixta",
        "de": "gemischt"
      }
    },
    {
      "@id": "http://rdaregistry.info/termList/AspectRatio/1002",
      "@type": "Concept",
      "toolkitDefinition": {
        "es": "Proporción dimensional de un recurso de imagen en movimiento de 1.5:1 o mayor.",
        "zh": "动态图像的宽高比为1.5:1或更大。",
        "de": "Bildformat einer Bewegtbildressource von 1.5:1 oder höher.",
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées égal ou supérieur à 1,5:1.",
        "en": "Aspect ratio for a moving image resource of 1.5:1 or greater."
      },
      "toolkitLabel": {
        "es": "pantalla ancha",
        "zh": "宽屏",
        "fr": "écran large",
        "de": "Breitbild",
        "en": "wide screen"
      },
      "api": "http://api.metadataregistry.org/concepts/728",
      "status": "published",
      "altLabel": {
        "en": "wide-screen"
      },
      "definition": {
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées égal ou supérieur à 1,5:1.",
        "zh": "动态图像的宽高比为1.5:1或更大。",
        "en": "Aspect ratio for a moving image resource of 1.5:1 or greater.",
        "es": "Proporción dimensional de un recurso de imagen en movimiento de 1.5:1 o mayor.",
        "de": "Bildformat einer Bewegtbildressource von 1.5:1 oder höher."
      },
      "inScheme": "http://rdaregistry.info/termList/AspectRatio/",
      "prefLabel": {
        "en": "wide screen",
        "de": "Breitbild",
        "fr": "écran large",
        "zh": "宽屏",
        "es": "pantalla ancha"
      }
    },
    {
      "@id": "http://rdaregistry.info/termList/AspectRatio/1001",
      "@type": "Concept",
      "toolkitDefinition": {
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "de": "Bildformat einer Bewegtbildressource von weniger als 1.5:1.",
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées inférieur à 1,5:1.",
        "en": "Aspect ratio for a moving image resource of less than 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1"
      },
      "toolkitLabel": {
        "fr": "plein écran",
        "de": "Vollbild",
        "en": "full screen",
        "zh": "全屏",
        "es": "pantalla completa"
      },
      "api": "http://api.metadataregistry.org/concepts/727",
      "status": "published",
      "altLabel": {
        "en": "full-screen"
      },
      "definition": {
        "de": "Bildformat einer Bewegtbildressource von weniger als 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1。",
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "en": "Aspect ratio for a moving image resource of less than 1.5:1.",
        "fr": "Format de l\u2019image d\u2019une ressource d\u2019images animées inférieur à 1,5:1."
      },
      "inScheme": "http://rdaregistry.info/termList/AspectRatio/",
      "prefLabel": {
        "fr": "plein écran",
        "es": "pantalla completa",
        "zh": "全屏",
        "en": "full screen",
        "de": "Vollbild"
      }
    },
    {
      "published": {
        "@id": "http://metadataregistry.org/uri/RegStatus/1001",
        "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
        "url": "http://metadataregistry.org/concept/show/id/412.html",
        "label": "Published"
      }
    }
  ]
}
',
                         $jsonLdService->getJsonLd());




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


    public function testGetConceptPropertiesArray(FunctionalTester $I)
    {
        $concept = ConceptPeer::retrieveByPK(727);
        $propertyArray = jsonldService::getConceptPropertyArray($concept);
        $I->assertEquals(json_encode($propertyArray,
                                     JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), '{
    "@id": "http://rdaregistry.info/termList/AspectRatio/1001",
    "@type": "Concept",
    "api": "http://api.metadataregistry.org/concepts/727",
    "inScheme": "http://rdaregistry.info/termList/AspectRatio/",
    "status": "Published",
    "prefLabel": {
        "en": "full screen",
        "de": "Vollbild",
        "fr": "plein écran",
        "es": "pantalla completa",
        "zh": "全屏"
    },
    "scopeNote": {
        "en": "Use for standard format, i.e., 1.33:1 or 4:3."
    },
    "definition": {
        "en": "Aspect ratio for a moving image resource of less than 1.5:1.",
        "de": "Bildformat einer Bewegtbildressource von weniger als 1.5:1.",
        "fr": "Format de l’image d’une ressource d’images animées inférieur à 1,5:1.",
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1。"
    },
    "ToolkitLabel": {
        "en": "full screen",
        "fr": "plein écran",
        "de": "Vollbild",
        "es": "pantalla completa",
        "zh": "全屏"
    },
    "ToolkitDefinition": {
        "en": "Aspect ratio for a moving image resource of less than 1.5:1.",
        "fr": "Format de l’image d’une ressource d’images animées inférieur à 1,5:1.",
        "de": "Bildformat einer Bewegtbildressource von weniger als 1.5:1.",
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1。"
    },
    "altLabel": {
        "en": [
            "full-screen",
            "full-screen",
            "fullscreen",
            "full-screen"
        ]
    }
}');
    }
}

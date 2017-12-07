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
        $I->assertEquals("http://rdaregistry.info/termList/AspectRatio",
            $jsonLdService->vocabArray['@id'], "expected @id doesn't match URI");
        $I->assertEquals("ConceptScheme", $jsonLdService->vocabArray['@type']);
        $I->assertEquals([ "en" => 'RDA Aspect Ratio Designation' ], $jsonLdService->vocabArray['title']);
        $I->assertEquals([ "en" => 'A general designation of the ratio of the width to the height of a moving image.' ],
            $jsonLdService->vocabArray['description']);
        $I->assertEquals("rdaar", $jsonLdService->vocabArray['prefix']);
        $I->assertEquals("October 17, 2017", $jsonLdService->vocabArray['dateOfPublication']);
        $I->assertEquals("AspectRatio", $jsonLdService->vocabArray['token']);
        $I->assertEquals([
            "@id"          => 'http://metadataregistry.org/uri/RegStatus/1001',
            "label"        => "Published"
        ],
            $jsonLdService->vocabArray['status']);
        $I->assertEquals("http://api.metadataregistry.org/vocabularies/58", $jsonLdService->vocabArray['omr_api']);
        $I->assertEquals("http://metadataregistry.org/vocabulary/show/id/58.html",
            $jsonLdService->vocabArray['omr_home']);
        $I->assertEquals("http://www.rdaregistry.info/termList/AspectRatio/",
            $jsonLdService->vocabArray['documentation']);
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
            "code"=> "en",
            "lang"=> "English",
            "version"=> $releaseVersion
        ], $jsonLdService->vocabArray['languages'][5]);
        $I->assertEquals($releaseDate, $jsonLdService->vocabArray['dateOfPublication']);


        $I->assertEquals(<<<'JSON'
{
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
            "token": "AspectRatio",
            "prefix": "rdaar",
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "label": "Published"
            },
            "omr_api": "http://api.metadataregistry.org/vocabularies/58",
            "omr_home": "http://metadataregistry.org/vocabulary/show/id/58.html",
            "documentation": "http://www.rdaregistry.info/termList/AspectRatio/",
            "tags": {
                "en": [
                    "Libraries",
                    "Information Services"
                ]
            },
            "count": 3,
            "languages": [
                {
                    "code": "ar",
                    "lang": "Arabic",
                    "version": "WIP"
                },
                {
                    "code": "ca",
                    "lang": "Catalan",
                    "version": "v2.7.3"
                },
                {
                    "code": "zh",
                    "lang": "Chinese",
                    "version": "v2.7.3"
                },
                {
                    "code": "da",
                    "lang": "Danish",
                    "version": "v2.7.3"
                },
                {
                    "code": "nl",
                    "lang": "Dutch",
                    "version": "v2.7.3"
                },
                {
                    "code": "en",
                    "lang": "English",
                    "version": "v2.7.3"
                },
                {
                    "code": "fi",
                    "lang": "Finnish",
                    "version": "v2.7.3"
                },
                {
                    "code": "fr",
                    "lang": "French",
                    "version": "v2.7.3"
                },
                {
                    "code": "de",
                    "lang": "German",
                    "version": "v2.7.3"
                },
                {
                    "code": "el",
                    "lang": "Greek",
                    "version": "WIP"
                },
                {
                    "code": "he",
                    "lang": "Hebrew",
                    "version": "WIP"
                },
                {
                    "code": "hu",
                    "lang": "Hungarian",
                    "version": "WIP"
                },
                {
                    "code": "it",
                    "lang": "Italian",
                    "version": "v2.7.3"
                },
                {
                    "code": "no",
                    "lang": "Norwegian",
                    "version": "v2.7.3"
                },
                {
                    "code": "pl",
                    "lang": "Polish",
                    "version": "WIP"
                },
                {
                    "code": "pt",
                    "lang": "Portuguese",
                    "version": "WIP"
                },
                {
                    "code": "sk",
                    "lang": "Slovak",
                    "version": "WIP"
                },
                {
                    "code": "es",
                    "lang": "Spanish",
                    "version": "v2.7.3"
                },
                {
                    "code": "sv",
                    "lang": "Swedish",
                    "version": "v2.7.3"
                },
                {
                    "code": "uk",
                    "lang": "Ukrainian",
                    "version": "WIP"
                },
                {
                    "code": "vi",
                    "lang": "Vietnamese",
                    "version": "v2.7.3"
                }
            ],
            "dateOfPublication": "October 17, 2017"
        },
        {
            "@id": "http://rdaregistry.info/termList/AspectRatio/1001",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/727",
            "inScheme": "http://rdaregistry.info/termList/AspectRatio",
            "status": "Published",
            "prefLabel": {
                "en": "full screen",
                "de": "Vollbild",
                "fr": "plein écran",
                "es": "pantalla completa",
                "zh": "全屏",
                "nl": "full screen",
                "it": "a tutto schermo",
                "fi": "full screen",
                "sv": "normalbild",
                "vi": "toàn màn hình",
                "ca": "pantalla completa",
                "no": "fullskjerm",
                "da": "fuldskærm"
            },
            "definition": {
                "en": "An aspect ratio designation for a moving image resource of less than 1.5:1.",
                "de": "Ein Bildformat einer Bewegtbildressource von weniger als 1,5:1.",
                "fr": "Désignation de format d’image pour une ressource d’images animées dont le format d’image est inférieur à 1,5:1.",
                "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
                "zh": "动态图像资源的宽高比小于1.5：1。",
                "nl": "Aspectratio voor een resource met bewegend beeld minder dan 1.5:1",
                "vi": "Định danh tỷ lệ bề ngoài cho tài nguyên hình ảnh động nhỏ hơn 1,5:1.",
                "ca": "Relació d’aspecte d’un recurs d’imatge en moviment de menys d’1,5:1.",
                "no": "En betegnelse for bildesideforhold på under 1,5:1 for en levende bilde-ressurs.",
                "da": "Billedformat for en levende billedressource på mindre end 1,5:1.",
                "fi": "Liikkuvan kuvan kuvasuhde, joka on pienempi kuin 1.5:1."
            },
            "ToolkitLabel": {
                "en": "full screen",
                "fr": "plein écran",
                "de": "Vollbild",
                "es": "pantalla completa",
                "zh": "全屏",
                "nl": "full screen",
                "it": "a tutto schermo",
                "fi": "full screen",
                "sv": "normalbild",
                "vi": "toàn màn hình",
                "ca": "pantalla completa",
                "no": "fullskjerm",
                "da": "fuldskærm"
            },
            "ToolkitDefinition": {
                "en": "An aspect ratio designation for a moving image resource of less than 1.5:1.",
                "fr": "Désignation de format d’image pour une ressource d’images animées dont le format d’image est inférieur à 1,5:1.",
                "de": "Ein Bildformat einer Bewegtbildressource von weniger als 1,5:1.",
                "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
                "zh": "动态图像资源的宽高比小于1.5：1。",
                "nl": "Aspectratio voor een resource met bewegend beeld minder dan 1.5:1",
                "vi": "Định danh tỷ lệ về ngoài cho tài nguyên hình ảnh động nhỏ hơn 1,5:1.",
                "ca": "Relació d’aspecte d’un recurs d’imatge en moviment de menys d’1,5:1.",
                "no": "En betegnelse for bildesideforhold på under 1,5:1 for en levende bilde-ressurs.",
                "da": "Billedformat for en levende billedressource på mindre end 1,5:1.",
                "fi": "Liikkuvan kuvan kuvasuhde, joka on pienempi kuin 1.5:1."
            },
            "altLabel": {
                "en": "full-screen",
                "vi": "toàn-màn-hình"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/AspectRatio/1003",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/729",
            "inScheme": "http://rdaregistry.info/termList/AspectRatio",
            "status": "Published",
            "prefLabel": {
                "en": "mixed aspect ratio",
                "de": "gemischt",
                "fr": "format d’image mixte",
                "es": "mixta",
                "zh": "混合",
                "nl": "gemengd",
                "it": "misto",
                "fi": "yhdistelmä (kuvasuhde)",
                "sv": "blandade bildförhållanden",
                "vi": "tỷ lệ bề ngoài hỗn hợp",
                "ca": "relació d’aspecte mixta",
                "no": "blandet bildesideforhold",
                "da": "blandet billedformat"
            },
            "definition": {
                "en": "An aspect ratio designation for a moving image resource that includes multiple aspect ratios within the same resource.",
                "de": "Ein Bildformat einer Bewegtbildressource, die mehrere Bildformate innerhalb derselben Ressource enthält.",
                "fr": "Désignation de format d’image pour une ressource d’images animées comprenant divers formats d’image à l’intérieur de la même ressource.",
                "zh": "在同一资源中动态图像资源包括多种宽高比。",
                "es": "Proporción dimensional de un recurso que incluye múltiples proporciones dimensionales dentro del mismo recurso.",
                "nl": "Aspectratio voor een resource met bewegend beeld dat meerdere aspectratio's bevat binnen dezelfde resource",
                "vi": "Định danh tỷ lệ bề ngoài cho tài nguyên hình ảnh động bao gồm nhiều tỷ lệ bề ngoài bên trong cùng tài nguyên.",
                "ca": "Relació d’aspecte d’un recurs d’imatges en moviment que inclou diverses relacions d’aspecte dins del mateix recurs.",
                "no": "En betegnelse for bildesideforhold for en levende bilde-ressurs som har flere ulike bildesideforhold innenfor samme ressurs.",
                "da": "Billedformat for en levende billedressource, der omfatter flere billedformater inden for samme ressource",
                "fi": "Kuvasuhde liikkuvaa kuvaa sisältävälle aineistolle, joka käsittää useita eri kuvasuhteita."
            },
            "ToolkitLabel": {
                "en": "mixed aspect ratio",
                "fr": "format d’image mixte",
                "de": "gemischt",
                "es": "mixta",
                "zh": "混合",
                "nl": "gemengd",
                "it": "misto",
                "fi": "yhdistelmä (kuvasuhde)",
                "sv": "blandade bildförhållanden",
                "vi": "tỷ lệ bề ngoài hỗn hợp",
                "ca": "relació d’aspecte mixta",
                "no": "blandet bildesideforhold",
                "da": "blandet billedformat"
            },
            "ToolkitDefinition": {
                "en": "An aspect ratio designation for a moving image resource that includes multiple aspect ratios within the same resource.",
                "fr": "Désignation de format d’image pour une ressource d’images animées comprenant divers formats d’image à l’intérieur de la même ressource.",
                "de": "Ein Bildformat einer Bewegtbildressource, die mehrere Bildformate innerhalb derselben Ressource enthält.",
                "zh": "在同一资源中动态图像资源包括多种宽高比。",
                "es": "Proporción dimensional de un recurso que incluye múltiples proporciones dimensionales dentro del mismo recurso.",
                "nl": "Aspectratio voor een resource met bewegend beeld dat meerdere aspectratio's bevat binnen dezelfde resource",
                "vi": "Định danh tỷ lệ về ngoài cho tài nguyên hình ảnh động bao gồm các tỷ lệ bề ngoài khác nhau bên trong cùng tài nguyên.",
                "ca": "Relació d’aspecte d’un recurs d’imatges en moviment que inclou diverses relacions d’aspecte dins del mateix recurs.",
                "no": "En betegnelse for bildesideforhold for en levende bilde-ressurs som har flere ulike bildesideforhold innenfor samme ressurs.",
                "da": "Billedformat for en levende billedressource, der omfatter flere billedformater inden for samme ressource",
                "fi": "Kuvasuhde liikkuvaa kuvaa sisältävälle aineistolle, joka käsittää useita eri kuvasuhteita."
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/AspectRatio/1002",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/728",
            "inScheme": "http://rdaregistry.info/termList/AspectRatio",
            "status": "Published",
            "prefLabel": {
                "en": "wide screen",
                "de": "Breitbild",
                "fr": "écran large",
                "es": "pantalla ancha",
                "zh": "宽屏",
                "nl": "widescreen",
                "it": "a schermo panoramico",
                "fi": "wide screen",
                "sv": "bredbild",
                "vi": "màn hình rộng",
                "ca": "pantalla panoràmica",
                "no": "widescreen",
                "da": "wide screen"
            },
            "definition": {
                "en": "An aspect ratio designation for a moving image resource of 1.5:1 or greater.",
                "de": "Ein Bildformat einer Bewegtbildressource von 1,5:1 oder höher.",
                "fr": "Désignation de format d’image d’une ressource d’images animées dont le format d’image est égal ou supérieur à 1,5:1.",
                "zh": "动态图像的宽高比为1.5:1或更大。",
                "es": "Proporción dimensional de un recurso de imagen en movimiento de 1.5:1 o mayor.",
                "nl": "Aspectratio voor een resource met bewegend beeld van 1.5:1 of meer",
                "vi": "Định danh tỷ lệ bề ngoài cho tài nguyên hình ảnh động bằng 1,5:1 hoặc lớn hơn.",
                "ca": "Relació d’aspecte d’un recurs d’imatges en moviment igual o superior 1,5:1.",
                "no": "En betegnelse for bildesideforhold på 1,5:1 eller mer for en levende bilde-ressurs.",
                "da": "Billedformat for en levende billedressource på 1,5:1 eller større.",
                "fi": "Liikkuvan kuvan kuvasuhde, joka on 1.5:1 tai suurempi."
            },
            "ToolkitLabel": {
                "en": "wide screen",
                "fr": "écran large",
                "de": "Breitbild",
                "es": "pantalla ancha",
                "zh": "宽屏",
                "nl": "widescreen",
                "it": "a schermo panoramico",
                "fi": "wide screen",
                "sv": "bredbild",
                "vi": "màn hình rộng",
                "ca": "pantalla panoràmica",
                "no": "widescreen",
                "da": "wide screen"
            },
            "ToolkitDefinition": {
                "en": "An aspect ratio designation for a moving image resource of 1.5:1 or greater.",
                "fr": "Désignation de format d’image d’une ressource d’images animées dont le format d’image est égal ou supérieur à 1,5:1.",
                "de": "Ein Bildformat einer Bewegtbildressource von 1,5:1 oder höher.",
                "zh": "动态图像的宽高比为1.5:1或更大。",
                "es": "Proporción dimensional de un recurso de imagen en movimiento de 1.5:1 o mayor.",
                "nl": "Aspectratio voor een resource met bewegend beeld van 1.5:1 of meer",
                "vi": "Định danh tỷ lệ về ngoài cho tài nguyên hình ảnh động là 1,5:1 hoặc lớn hơn.",
                "ca": "Relació d’aspecte d’un recurs d’imatges en moviment igual o superior 1,5:1.",
                "no": "En betegnelse for bildesideforhold på 1,5:1 eller mer for en levende bilde-ressurs.",
                "da": "Billedformat for en levende billedressource på 1,5:1 eller større.",
                "fi": "Liikkuvan kuvan kuvasuhde, joka on 1.5:1 tai suurempi."
            },
            "altLabel": {
                "en": "wide-screen",
                "vi": "màn-hình-rộng"
            }
        }
    ]
}
JSON
            , $jsonLdService->getJsonLd());




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
        $I->assertEquals(<<<'JSON'
{
    "@id": "http://rdaregistry.info/termList/AspectRatio/1001",
    "@type": "Concept",
    "api": "http://api.metadataregistry.org/concepts/727",
    "inScheme": "http://rdaregistry.info/termList/AspectRatio",
    "status": "Published",
    "prefLabel": {
        "en": "full screen",
        "de": "Vollbild",
        "fr": "plein écran",
        "es": "pantalla completa",
        "zh": "全屏",
        "nl": "full screen",
        "it": "a tutto schermo",
        "fi": "full screen",
        "sv": "normalbild",
        "vi": "toàn màn hình",
        "ca": "pantalla completa",
        "no": "fullskjerm",
        "da": "fuldskærm"
    },
    "definition": {
        "en": "An aspect ratio designation for a moving image resource of less than 1.5:1.",
        "de": "Ein Bildformat einer Bewegtbildressource von weniger als 1,5:1.",
        "fr": "Désignation de format d’image pour une ressource d’images animées dont le format d’image est inférieur à 1,5:1.",
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1。",
        "nl": "Aspectratio voor een resource met bewegend beeld minder dan 1.5:1",
        "vi": "Định danh tỷ lệ bề ngoài cho tài nguyên hình ảnh động nhỏ hơn 1,5:1.",
        "ca": "Relació d’aspecte d’un recurs d’imatge en moviment de menys d’1,5:1.",
        "no": "En betegnelse for bildesideforhold på under 1,5:1 for en levende bilde-ressurs.",
        "da": "Billedformat for en levende billedressource på mindre end 1,5:1.",
        "fi": "Liikkuvan kuvan kuvasuhde, joka on pienempi kuin 1.5:1."
    },
    "ToolkitLabel": {
        "en": "full screen",
        "fr": "plein écran",
        "de": "Vollbild",
        "es": "pantalla completa",
        "zh": "全屏",
        "nl": "full screen",
        "it": "a tutto schermo",
        "fi": "full screen",
        "sv": "normalbild",
        "vi": "toàn màn hình",
        "ca": "pantalla completa",
        "no": "fullskjerm",
        "da": "fuldskærm"
    },
    "ToolkitDefinition": {
        "en": "An aspect ratio designation for a moving image resource of less than 1.5:1.",
        "fr": "Désignation de format d’image pour une ressource d’images animées dont le format d’image est inférieur à 1,5:1.",
        "de": "Ein Bildformat einer Bewegtbildressource von weniger als 1,5:1.",
        "es": "Proporción dimensional de un recurso de imagen en movimiento menor que 1.5:1.",
        "zh": "动态图像资源的宽高比小于1.5：1。",
        "nl": "Aspectratio voor een resource met bewegend beeld minder dan 1.5:1",
        "vi": "Định danh tỷ lệ về ngoài cho tài nguyên hình ảnh động nhỏ hơn 1,5:1.",
        "ca": "Relació d’aspecte d’un recurs d’imatge en moviment de menys d’1,5:1.",
        "no": "En betegnelse for bildesideforhold på under 1,5:1 for en levende bilde-ressurs.",
        "da": "Billedformat for en levende billedressource på mindre end 1,5:1.",
        "fi": "Liikkuvan kuvan kuvasuhde, joka on pienempi kuin 1.5:1."
    },
    "altLabel": {
        "en": "full-screen",
        "vi": "toàn-màn-hình"
    }
}
JSON
, json_encode($propertyArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-05-18
 * Time: 11:34 AM
 */

namespace apps\frontend\lib\services;

use GuzzleHttp\Client;

class jsonldService
{

    private $vocab;

    private $release;

    private $masterArray = [];

    public $vocabArray = [];

    public $itemArray = [];


    public function __construct(\Vocabulary $vocab)
    {
        $this->itemArray["@context"] = "http://rdaregistry.info/Contexts/concepts_langmap.jsonld";
        $this->vocab                 = $vocab;
        $this->setReleaseFromGithub();
        $this->vocabArray["@id"]               = $vocab->getUri();
        $this->vocabArray["@type"]             = "ConceptScheme";
        $this->vocabArray['title']             = [ $vocab->getLanguage() => $vocab->getName() ];
        $this->vocabArray['description']       = [ $vocab->getLanguage() => $vocab->getNote() ];
        $this->vocabArray["token"]             = $vocab->getToken();
        $this->vocabArray["prefix"]            = $vocab->getPrefix();
        $status                                = \ConceptPeer::getConceptByUri($vocab->getStatus()->getUri());
        $this->vocabArray['status']            = [
            "@id"   => $status->getUri(),
            "label" => $status->getPrefLabel()
        ];
        $this->vocabArray['omr_api']           = "http://api.metadataregistry.org/vocabularies/" . $vocab->getId();
        $this->vocabArray['omr_home']          = "http://metadataregistry.org/vocabulary/show/id/" . $vocab->getId() . ".html";
        $this->vocabArray['documentation']     = $vocab->getUrl();
        $this->vocabArray['tags']              = [
            "en" => $this->getTags($this->vocab->getCommunity())
        ];
        $this->vocabArray["count"]             = $vocab->countConcepts();
        $this->vocabArray["languages"]         = $this->getLanguages($vocab->getLanguages());
        $this->vocabArray["dateOfPublication"] = $this->getDateOfPublication();
        $this->itemArray["@graph"][]           = $this->vocabArray;

        $concepts = $this->getConcepts();
        if ($concepts) {
            foreach ($concepts as $concept) {
                $this->itemArray["@graph"][] = $this->getConceptPropertyArray($concept);
            }
        }
    }


    public function getVocabulary()
    {
        return $this->vocab;
    }


    public function getTags($vocabTags)
    {
        return array_map('trim', array_filter(explode(",", $vocabTags)));
    }


    /**
     * @param array $languages
     *
     * @return array
     */
    public function getLanguages($languages)
    {
        $lang = [];
//TODO 06/09/2016: This needs to lookup the actual published version that was translated as well as the published version of the language. Right now it's a fixed field
        foreach ($languages as $language) {
            $languageCount = $this->getLanguageCount($language);
            $version       = ( $languageCount ) ? $this->getReleaseTag() : "WIP";
            $lang[]        = [
                "code"    => $language,
                "lang"    => self::format_language($language),
//TODO 07/28/2016: rather than get the current release tag, this needs to get the actual release associated with the language translation
//                               "source"  => $this->getReleaseTag(),
                "version" => $version
            ];
        }

        return $lang;

    }


    /**
     * @param string $language
     *
     * @return int
     */
    private function getLanguageCount($language)
    {
        $c = new \Criteria();
        $c->add(\ConceptPropertyPeer::LANGUAGE, $language);
        $c->addJoin(\ConceptPropertyPeer::CONCEPT_ID, \ConceptPeer::ID);

        return $this->vocab->countConcepts($c);
    }


    /**
     * @return string
     */
    private function getReleaseTag()
    {
        if ($this->release) {
            return $this->release->tag_name;
        }

        return '';

    }


    /**
     * @return string|\DateTime
     */
    private function getDateOfPublication()
    {
        if ($this->release) {
            return $releaseDate = \DateTime::createFromFormat(\DateTime::W3C, $this->release->published_at)
                                           ->format('F j, Y');;
        }

        return '';

    }


    private function setReleaseFromGithub()
    {
        $GuzzleClient = new Client([ 'base_uri' => 'https://api.github.com' ]);
        try {
            $response = $GuzzleClient->request('GET', '/repos/' . $this->vocab->getRepo() . '/releases/latest');
            if ($response) {
                $this->release = json_decode($response->getBody());
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $this->release = false;
        }
    }


    /**
     * @return array
     */
    private function getConcepts()
    {
        $concepts = $this->vocab->getConcepts();

        return count($concepts) ? $concepts : [];
    }


    public static function getConceptPropertyArray(\Concept $concept, $collapse = true)
    {
        $c = new \Criteria();
        $c->add(\ConceptPropertyPeer::DELETED_AT,  \Criteria::ISNULL);
        $properties = $concept->getConceptPropertysRelatedByConceptIdJoinProfilePropertyRelatedBySkosPropertyId($c);
        /** @var array $properties */
        $properties        = $properties ?: [];
        $array['@id']      = $concept->getUri();
        $array['@type']    = 'Concept';
        $array['api']      = 'http://api.metadataregistry.org/concepts/' . $concept->getId();
        $array['inScheme'] = $concept->getVocabulary()->getUri();
        $array['status']   = $concept->getStatus()->getDisplayName();
        if ($properties) {
            foreach ($properties as $property) {
                /** @var \ProfileProperty $profile */
                $profile = $property->getProfileProperty();
                if ($profile->getHasLanguage()) {
                    if ($profile->getIsSingleton()) {
                        $array[$profile->getName()][$property->getLanguage()] = $property->getObject();
                    } else {
                        $array[$profile->getName()][$property->getLanguage()][] = $property->getObject();
                    }
                } else {
                    if ($profile->getIsSingleton()) {
                        $array[$profile->getName()] = $property->getObject();
                    } else {
                        $array[$profile->getName()][] = $property->getObject();
                    }
                }
            }
        }
        if ($collapse) {
            $collapsedArray = [];
            foreach ($array as $key => $element) {
                if (is_array($element)) {
                    foreach ($element as $index => $item) {
                        if (is_array($item) && count($item) == 1) {
                            $collapsedArray[$key][$index] = $item[0];
                        } else {
                            $collapsedArray[$key][$index] = $item;
                        }
                    }
                } else {
                    $collapsedArray[$key] = $element;
                }
            }

            return $collapsedArray;
        }

        return $array;
    }


    public function getJsonLd()
    {
        return json_encode($this->itemArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }


    private static function format_language($language_iso, $culture = null)
    {
        $c         = new \sfCultureInfo($culture === null ? \sfContext::getInstance()
                                                                    ->getUser()
                                                                    ->getCulture() : $culture);
        $languages = $c->getLanguages();

        return isset( $languages[$language_iso] ) ? $languages[$language_iso] : '';
    }

}

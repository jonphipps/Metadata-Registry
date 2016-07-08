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

    private $masterArray = [ ];

    public $jsonArray = [ ];


    public function __construct(\Vocabulary $vocab)
    {
        $this->vocab                    = $vocab;
        $this->setReleaseFromGithub();
        $this->jsonArray["@id"]         = $vocab->getUri();
        $this->jsonArray["@type"]       = "ConceptScheme";
        $this->jsonArray['title']       = [ $vocab->getLanguage() => $vocab->getName() ];
        $this->jsonArray['description'] = [ $vocab->getLanguage() => $vocab->getNote() ];
        $this->jsonArray["token"] = $vocab->getToken();
        $this->jsonArray["prefix"] = $vocab->getPrefix();
        $status                         = \ConceptPeer::getConceptByUri($vocab->getStatus()->getUri());
        $this->jsonArray['status']      = [
            "@id"   => $status->getUri(),
            "label" => $status->getPrefLabel()
        ];
        $this->jsonArray['api']         = "http://api.metadataregistry.org/vocabularies/" . $vocab->getId();
        $this->jsonArray['url']         = $vocab->getUrl();
        $this->jsonArray['tags']        = [
            "en" => $this->getTags($this->vocab->getCommunity())
        ];
        $this->jsonArray["count"]       = $vocab->countConcepts();
        $this->jsonArray["languages"] = $this->getLanguages($vocab->getLanguages());
        $this->jsonArray["dateOfPublication"] = $this->getDateOfPublication();

    }


    public function getVocabulary()
    {
        return $this->vocab;
    }


    public function getTags($vocabTags)
    {
        return array_map('trim', array_filter(explode(",", $vocabTags)));
    }


    public function getLanguages($languages)
    {
        require_once( \sfConfig::get('sf_symfony_lib_dir') . '/helper/I18NHelper.php' );
        $lang = [ ];
        //TODO 06/09/2016: This needs to lookup the actual published version that was translated as well as the published version of the language. Right now it's a fixed field
        foreach ($languages as $language) {
            $languageCount = $this->getLanguageCount($language);
            $version       = ( $languageCount ) ? $this->getReleaseTag() : "WIP";
            $lang[]        = [ "code"    => $language,
                               "lang"    => format_language($language),
                               "source"  => $this->getReleaseTag(),
                               "version" => $version
            ];
        }

        return $lang;

    }


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
}

<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-05-18
 * Time: 11:34 AM
 */

namespace apps\frontend\lib\services;

class jsonldService
{

    private $vocab;

    private $version;

    private $masterArray = [ ];

    public $jsonArray = [ ];


    public function __construct(\Vocabulary $vocab, $publishedVersion)
    {
        $this->vocab                    = $vocab;
        $this->version                  = $publishedVersion;
        $this->jsonArray["@id"]         = $vocab->getUri();
        $this->jsonArray["@type"]       = "ConceptScheme";
        $this->jsonArray['title']       = [ $vocab->getLanguage() => $vocab->getName() ];
        $this->jsonArray['description'] = [ $vocab->getLanguage() => $vocab->getNote() ];
        $this->jsonArray["token"]       = $vocab->getToken();
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
        $this->jsonArray["languages"]   = $this->getLanguages($vocab->getLanguages());


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
            $version       = ( $languageCount ) ? $this->version : "WIP";
            $lang[]        = [ "code"    => $language,
                               "lang"    => format_language($language),
                               "source"  => $this->version,
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
}

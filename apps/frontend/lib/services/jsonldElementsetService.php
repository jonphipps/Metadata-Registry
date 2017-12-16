<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-05-18
 * Time: 11:34 AM
 */

namespace apps\frontend\lib\services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class jsonldElementsetService
{

    private $vocab;

    private $release;

    public $vocabArray = [];

    public $itemArray = [];

    /**
     * jsonldElementsetService constructor.
     *
     * @param \Schema $vocab
     * @param array   $release
     * @param string  $useLanguage
     * @param bool    $uselanguageMap
     *
     * @throws \Exception
     * @throws \PropelException
     */
    public function __construct(\Schema $vocab, array $release = [], $useLanguage = null, $uselanguageMap = true)
    {
        $this->vocab   = $vocab;
        $this->release = $release;

        ini_set('memory_limit', '640M');
        ini_set('max_execution_time', 600);

        $propArray   = $vocab::getPropertyArray();
        $statusArray = $vocab::getStatusArray();

        //use the default language if none specified
        $useLanguage = $useLanguage ?? $vocab->getLanguage();

        if ($uselanguageMap) {
            //write the language map context
            $jsonldContext = $vocab->getBaseDomain() . 'Contexts/elements_langmap.jsonld';
            $contextArray  = $jsonldContext;
            $cLang         = $vocab->getCriteriaForLanguage($uselanguageMap, $useLanguage);
        } else {
            //write the nolang context -- this one is what we already have, but it's static at the moment
            $jsonldContext = $vocab->getBaseDomain() . 'Contexts/elements_nolang.jsonld';
            $contextArray  = [ $jsonldContext, [ '@language' => $useLanguage, ], ];
            $cLang = $vocab->getCriteriaForLanguage($uselanguageMap, $useLanguage);
        }

        $this->itemArray['@context'] = $contextArray;
        if (empty($this->release)) {
            $this->setReleaseFromGithub();
        }
        $this->vocabArray['@id']         = $vocab->getUri();
        $this->vocabArray['@type']       = 'ElementSet';
        $this->vocabArray['title']       = [ $vocab->getLanguage() => $vocab->getName() ];
        $this->vocabArray['description'] = [ $vocab->getLanguage() => $vocab->getNote() ];
        $this->vocabArray['prefix']      = $vocab->getPrefix();
        $this->vocabArray['token']      = $vocab->getToken();
        $status                          = $vocab->getStatus();
        if ($status) {
            $this->vocabArray['status'] = [
                '@id'   => $status->getUri(),
                'label' => $status->getDisplayName()
            ];
        }
        $this->vocabArray['omr_api']     = 'http://api.metadataregistry.org/elementsets/' . $vocab->getId();
        $this->vocabArray['omr_home']    = 'http://metadataregistry.org/elementsets/' . $vocab->getId();
        $docs                            = $vocab->getUrl();
        if ($docs) {
            $this->vocabArray['documentation'] = $docs;
        }
        $tags = $this->getTags($this->vocab->getCommunity());
        if ($tags) {
            $this->vocabArray['tags'] = [ 'en' => $tags ];
        }
        $this->vocabArray['count']             = $vocab->countSchemaPropertys();
        $this->vocabArray['languages']         = $this->getLanguages($vocab->getLanguages());
        $this->vocabArray['dateOfPublication'] = $this->getDateOfPublication();
        $this->itemArray['@graph'][]           = $this->vocabArray;

        $elements = $this->getElements();
        if ($elements) {
            foreach ($elements as $element) {
                $success =
                    $vocab->getResourceArray($element,
                        $cLang,
                        $propArray,
                        $statusArray,
                        $uselanguageMap,
                        $useLanguage);
                if ($success) {
                    $this->itemArray['@graph'][] = $success;
                }
            }
        }
    }


    public function getVocabulary(): \Schema
    {
        return $this->vocab;
    }

    /**
     * @param $vocabTags
     *
     * @return array
     */
    public function getTags($vocabTags): array
    {
        return array_map('trim', array_filter(explode(',', $vocabTags)));
    }

    /**
     * @param array $languages
     *
     * @return array
     * @throws \PropelException
     */
    public function getLanguages($languages): array
    {
        $lang = [];
//TODO 06/09/2016: This needs to lookup the actual published version that was translated as well as the published version of the language. Right now it's a fixed field
        foreach ($languages as $language) {
            $languageCount = $this->getLanguageCount($language);
            $version       = $languageCount ? $this->getReleaseTag() : 'WIP';
            $lang[]        = [
                'code'    => $language,
                'lang'    => self::format_language($language),
                //TODO 07/28/2016: rather than get the current release tag, this needs to get the actual release associated with the language translation
                //                               "source"  => $this->getReleaseTag(),
                'version' => $version
            ];
        }

        return $lang;

    }

    /**
     * @param string $language
     *
     * @return int
     * @throws \PropelException
     */
    private function getLanguageCount($language): int
    {
        $c = new \Criteria();
        $c->add(\SchemaPropertyElementPeer::LANGUAGE, $language);
        $c->addJoin(\SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, \SchemaPropertyPeer::ID);

        return $this->vocab->countSchemaPropertys($c);
    }


    private function getReleaseTag(): string
    {
        if ($this->release) {
            return $this->release['tag_name'];
        }

        return '';

    }


    /**
     * @return string|\DateTime
     */
    private function getDateOfPublication()
    {
        if ($this->release) {
            return $this->release['published_at'];
        }

        return '';
    }

    /**
     * @throws \PropelException
     */
    private function setReleaseFromGithub(): void
    {
        $repo = $this->getRepo();
        $this->release = false;

        //TODO: log a warning error if we can't access the repo, because the latest pub date won't be available
        if ($repo) {
            $GuzzleClient = new Client([ 'base_uri' => 'https://api.github.com' ]);
            try {
                $response = $GuzzleClient->request('GET', '/repos/' . $repo . '/releases/latest');
                if ($response) {
                    $this->release = json_decode($response->getBody(), true);
                    $this->release['published_at'] =
                        \DateTime::createFromFormat(\DateTime::W3C, $this->release['published_at'])->format('F j, Y');
                }
            }
            catch (ClientException $e) {
                $this->release = false;
            }
        }
    }

    /**
     * @return array
     * @throws \PropelException
     */
    private function getElements(): array
    {
        //TODO: let the user determine the sort order.
        $c = new \Criteria();
        $c->addAscendingOrderByColumn(\SchemaPropertyPeer::URI);
        $elements = $this->vocab->getSchemaPropertys($c);

        return \count($elements) ? $elements : [];
    }

    public function getJsonLd(): string
    {
        return json_encode($this->itemArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param             $language_iso
     * @param string|null $culture
     *
     * @return string
     */
    private static function format_language($language_iso, $culture = null): string
    {
        $c         = new \sfCultureInfo($culture ?? self::getCulture());
        $languages = $c->getLanguages();

        return $languages[ $language_iso ] ?? '';
    }

    public static function getCulture(): string
    {
        $instance = \sfContext::getInstance();
        if ($instance) {
            $user = $instance->getUser();
            if ($user) {
                return $user->getCulture();
            }
        }

        return 'en';
    }

    /**
     * @throws \PropelException
     */
    private function getRepo(): string
    {
        return $this->vocab->getAgent()->getRepo() ?? $this->vocab->getRepo();
    }

}

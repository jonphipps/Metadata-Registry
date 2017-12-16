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

class jsonldVocabularyService
{
    //TODO: revise jsonldVocabularyService to more closely resemble jsonldElementsetService and then refactor both for Illuminate DB access

    private $vocab;

    private $release;

    public $vocabArray = [];

    public $itemArray = [];

    /**
     * jsonldVocabularyService constructor.
     *
     * @param \Vocabulary $vocab
     * @param array       $release
     *
     * @throws \PropelException
     */
    public function __construct(\Vocabulary $vocab, array $release = [])
    {
        $this->vocab                 = $vocab;
        $this->release = $release;

        ini_set('memory_limit', '640M');
        ini_set('max_execution_time', 600);

        $this->itemArray['@context'] = $vocab->getBaseDomain() . 'Contexts/concepts_langmap.jsonld';
        if (empty($this->release)) {
            $this->setReleaseFromGithub();
        }
        $this->vocabArray['@id']           = $vocab->getUri();
        $this->vocabArray['@type']         = 'ConceptScheme';
        $this->vocabArray['title']         = [ $vocab->getLanguage() => $vocab->getName() ];
        $this->vocabArray['description']   = [ $vocab->getLanguage() => $vocab->getNote() ];
        $this->vocabArray['prefix']        = $vocab->getPrefix();
        $this->vocabArray['token']         = $vocab->getToken();
        $status                            = $vocab->getStatus();
        if ($status) {
            $this->vocabArray['status'] = [
                '@id'   => $status->getUri(),
                'label' => $status->getDisplayName(),
            ];
        }
        $this->vocabArray['omr_api']       = 'http://api.metadataregistry.org/vocabularies/' . $vocab->getId();
        $this->vocabArray['omr_home']      = 'http://metadataregistry.org/vocabularies/' . $vocab->getId();
        $docs = $vocab->getUrl();
        if ($docs) {
            $this->vocabArray['documentation'] = $docs;
        }
        $tags = $this->getTags($this->vocab->getCommunity());
        if ($tags) {
            $this->vocabArray['tags'] = [ 'en' => $tags ];
        }
        $this->vocabArray['count']             = $vocab->countConcepts();
        $this->vocabArray['languages']         = $this->getLanguages($vocab->getLanguages());
        $this->vocabArray['dateOfPublication'] = $this->getDateOfPublication();
        $this->itemArray['@graph'][]           = $this->vocabArray;

        $concepts = $this->getConcepts();
        if ($concepts) {
            foreach ($concepts as $concept) {
                $success = static::getConceptPropertyArray($concept);
                if (!empty($success)) {
                    ksort($success, SORT_FLAG_CASE | SORT_NATURAL);
                    $this->itemArray['@graph'][] = $success;
                }
            }
        }
    }


    public function getVocabulary(): \Vocabulary
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
        $c->add(\ConceptPropertyPeer::LANGUAGE, $language);
        $c->addJoin(\ConceptPropertyPeer::CONCEPT_ID, \ConceptPeer::ID);

        return $this->vocab->countConcepts($c);
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
    private function getConcepts(): array
    {
        //TODO: let the user determine the sort order.
        $c = new \Criteria();
        $c->addAscendingOrderByColumn(\ConceptPeer::URI);
        $concepts = $this->vocab->getConcepts($c);

        return \count($concepts) ? $concepts : [];
    }

    /**
     * @param \Concept $concept
     * @param bool     $collapse
     *
     * @return array
     * @throws \PropelException
     */
    public static function getConceptPropertyArray(\Concept $concept, $collapse = true): array
    {
        $properties = $concept->getConceptPropertysRelatedByConceptIdJoinProfilePropertyRelatedByProfilePropertyId();
        /** @var array $properties */
        $properties        = $properties ?: [];
        $array['@id']      = $concept->getUri();
        $array['@type']    = 'Concept';
        $array['api']      = 'http://api.metadataregistry.org/concepts/' . $concept->getId();
        $array['inScheme'] = $concept->getVocabulary()->getUri();
        $array['status']   = $concept->getStatus()->getDisplayName();
        if ($properties) {
            foreach ($properties as $property) {
                if (!$property->getDeletedAt()) {
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
        }
        if ($collapse) {
            $collapsedArray = [];
            foreach ($array as $key => $element) {
                if (\is_array($element)) {
                    foreach ($element as $index => $item) {
                        if (\is_array($item) && \count($item) === 1) {
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

<?php
  namespace WebDev;

  class VocabSteps extends \WebDev {

    public static $contentSelector    = '#sf_admin_content';

    function seeEmptyVocabList() {
      $I = $this;
    }

    function seeSingleVocabList() {
      $I = $this;
      $I->see('No results', self::$contentSelector);
    }

    function amOnVocabListPage() {
      $I = $this;
      $I->amOnPage('/vocabulary/list.html');
      $I->seeInTitle('The Registry! :: Vocabularies :: List');
    }
  }

<?php
namespace Page\Acceptance;

class Home
{
    // include url of current page
    public static $URL = '/';
    public static $pageTitle = 'The Registry! :: home';
    public static $elementLatestActivity = 'h1';
    public static $elementRegistryNews = 'h1';
    public static $elementSideMenu = 'h1';
    public static $elementWelcome = 'h1';
    public static $elementSignin = 'a';
    public static $elementSearchVocabForm = 'input#concept_term';
    public static $elementSearchElementForm = 'input';
    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
    }

    public static function latestActivity()
    {
        return 'Latest Activity';

    }

    public static function registryNews()
    {
        return 'Registry News';
    }

    public static function sideMenu()
    {
        return 'Browse...';

    }

    public static function welcome()
    {
        return 'Welcome to the Registry';
    }

    public static function signin()
    {
        return 'sign in / register';

    }

    public static function searchVocabForm()
    {
        return 'Search Vocabularies';

    }

    public static function searchElementForm()
    {
        return 'Search';

    }

}

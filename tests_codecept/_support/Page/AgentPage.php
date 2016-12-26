<?php
namespace Page;

use FunctionalTester;

class AgentPage extends PageMaster
{

  // include url of current page
  public static $url = ' /agents';


  /**
   * Basic route example for your current URL
   * You can append any additional parameter to URL
   * and use it in tests like: Page\Edit::route('/123-agent');
   */
  public static function route($param)
  {
    return static::$url . $param;
  }

  public static $allFormFields = [ 'type' => '#title',
                                   'body' => 'Body:' ];

  public static $showFields = [ 'type' => '#title',
                                'body' => 'Body:' ];

  public static $listFields = [ 'type' => '#title',
                                'body' => 'Body:' ];

  /**
   * Declare UI map for this page here. CSS or XPath allowed.
   * public static $usernameField = '#username';
   * public static $formSubmitButton = "#mainForm input[type=submit]";
   */

  /**
   * @var FunctionalTester;
   */
  protected $tester;


  public function __construct(FunctionalTester $I)
  {
    $this->tester = $I;
  }


  public function createAgent($fields = [])
  {
    $I = $this->tester;
    $I->amOnPage(static::$url);
    $I->click('Add new agent');
    $this->fillAllFormFields($fields);
    $I->click('Submit');
  }


  public function editAgent($id, $fields = [])
  {
    $I = $this->tester;
    $I->amOnPage(self::route("/$id/edit"));
    $I->see('Edit Agent', 'h1');
    $this->fillAllFormFields($fields);
    $I->click('Update');
  }


  public function deleteAgent($id)
  {
    $I = $this->tester;
    $I->amOnPage(self::route("/$id"));
    $I->click('Delete');
  }


  protected function fillAllFormFields($data)
  {
    foreach ($data as $field => $value) {
      if ( ! isset( static::$allFormFields[$field] )) {
        throw new \Exception("Form field  $field does not exist");
      }
      $this->tester->fillField(static::$allFormFields[$field], $value);
    }
  }

}

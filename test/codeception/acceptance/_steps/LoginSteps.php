<?php
  namespace WebDev;

  class LoginSteps extends \WebDev {

    public static $loginLinkText    = 'sign in / register';
    public static $logoutLinkText   = 'sign out';
    public static $usernameField    = '#nickname';
    public static $passwordField    = '#password';
    public static $formSubmitButton = '#login_form input[type=submit]';

    public static $vocabAdminData = array(
      'id'                   => 5,
      'deleted_at'           => NULL,
      'nickname'             => 'vocabadmin',
      'salutation'           => NULL,
      'first_name'           => 'Vocab',
      'last_name'            => 'Admin',
      'email'                => 'vocab_admin@example.com',
      'sha1_password'        => '071f11084209952d276aabdb5c7658df578729d2',
      'salt'                 => 'ce8ba65d3e637233f807a2eab706e87b',
      'want_to_be_moderator' => 0,
      'is_moderator'         => 0,
      'is_administrator'     => 0,
      'deletions'            => 0,
      'password'             => NULL,
      'culture'              => 'en_US',
    );

    /**
     * @param string $user
     * @param string $password
     */
    function loginAs($user, $password) {
      $I = $this;
      $I->click(self::$loginLinkText);
      $I->seeInCurrentUrl('login');
      $I->fillField(self::$usernameField, $user);
      $I->fillField(self::$passwordField, $password);
      $I->click(self::$formSubmitButton);
      $I->seeLink($user . ' profile');
    }

    function loginAsVocabAdmin() {
      $I = $this;
      $I->haveInDatabase("reg_user", self::$vocabAdminData);
      $I->seeInDatabase("reg_user", array('nickname' => 'vocabadmin'));
      $I->loginAs("vocabadmin", "admin");
    }

    public function logout() {
      $I = $this;
      $I->click(self::$logoutLinkText);
      $I->waitForText("sign in / register", 5);
      $I->seeLink("sign in / register");
    }
  }

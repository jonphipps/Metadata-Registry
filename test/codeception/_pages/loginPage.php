<?php

  class LoginPage {
    // include url of current page
    static $URL = '/';

    public static $loginLinkText        = 'sign in';
    public static $usernameField        = '#nickname';
    public static $passwordField        = '#password';
    public static $passwordConfirmField = '#password_bis';
    public static $emailField           = '#email';
    public static $formSubmitButton     = '#login_form input[type=submit]';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    public static function route($param) {
      return static::$URL . $param;
    }
  }

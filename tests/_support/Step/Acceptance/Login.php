<?php
namespace Step\Acceptance;

class Login extends \AcceptanceTester
{

    public function loginAsUser()
    {
        $I = $this;
    }


    public function loginAsVocabAdmin()
    {
        $I = $this;
        $I->haveInDatabase('reg_user',
                           [
                               'id'            => '41',
                               'created_at'    => '2016-09-06 19:28',
                               'updated_at'    => '2016-09-06 19:28',
                               'last_updated'  => '2016-09-06 19:28',
                               'nickname'      => 'vocab_admin',
                               'email'         => 'jphipps@madcreek.com',
                               'sha1_password' => '205916eb9b3f71861dbd9bff818c91c3c5f10141',
                               'salt'          => '7ee52e5f78295f21cb25b40c079ff65c',
                               'culture'       => 'en_US'
                           ]);
        $I->click('sign in / register');
        $I->submitForm('#login_form', [ 'nickname' => "vocab_admin", 'password' => "12345" ]);
    }


    public function loginAsVocabMaintainer()
    {
        $I = $this;
    }


    public function loginAsAdmin()
    {
        $I = $this;
    }


    public function loginAsVocabLanguageMaintainer()
    {
        $I = $this;
    }


    public function loginAsAgentAdmin()
    {
        $I = $this;
        $I->haveInDatabase('reg_user',
                           [
                               'id'            => '41',
                               'created_at'    => '2016-09-06 19:28',
                               'updated_at'    => '2016-09-06 19:28',
                               'last_updated'  => '2016-09-06 19:28',
                               'nickname'      => 'vocab_admin',
                               'email'         => 'jphipps@madcreek.com',
                               'sha1_password' => '205916eb9b3f71861dbd9bff818c91c3c5f10141',
                               'salt'          => '7ee52e5f78295f21cb25b40c079ff65c',
                               'culture'       => 'en_US'
                           ]);
        $I->click('sign in / register');
        $I->submitForm('#login_form', [ 'nickname' => "vocab_admin", 'password' => "12345" ]);
        $I->seeInTitle("The Registry! :: vocab_admin :: Home");
    }


    public function loginAsProjectAdmin()
    {
        $I = $this;
    }

}

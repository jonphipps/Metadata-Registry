<?php
namespace Step\Acceptance;

class login extends \AcceptanceTester
{

    public function asAdmin()
    {
        $I = $this;
        $I->click('sign in / register');
        $I->fillField('login name:', 'jonphipps');
        $I->fillField('password:','phipj121');
        $I->click('sign in');

    }

}

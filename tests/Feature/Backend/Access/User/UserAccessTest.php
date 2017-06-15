<?php

namespace Tests\Feature\Backend\Access\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class UserAccessTest.
 */
class UserAccessTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function testUserCantAccessAdminDashboard()
    {
        $this->visit('/')
             ->actingAs($this->user)
             ->visit('/admin/dashboard')
             ->seePageIs('/dashboard')
             ->see('Unauthorized access');
    }

    public function testExecutiveCanAccessAdminDashboard()
    {
        $this->visit('/')
             ->actingAs($this->executive)
             ->visit('/admin/dashboard')
             ->seePageIs('/admin/dashboard')
             ->see($this->executive->name);
    }

    public function testExecutiveCantAccessManageRoles()
    {
        $this->visit('/')
             ->actingAs($this->executive)
             ->visit('/admin/dashboard')
             ->seePageIs('/admin/dashboard')
             ->visit('/admin/access/role')
             ->seePageIs('/admin/dashboard')
             ->see('Unauthorized access');
    }
}

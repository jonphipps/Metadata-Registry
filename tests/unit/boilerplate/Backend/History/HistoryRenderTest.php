<?php

namespace Tests\unit\boilerplate\Backend\History;

use App\Repositories\Backend\History\Facades\History;
use Tests\BrowserKitTest;

/**
 * Class HistoryRenderTest
 */
class HistoryRenderTest extends BrowserKitTest
{
    public function testDashboardDisplaysHistory()
    {
        $this->actingAs($this->admin);

        History::log('User', 'trans("history.backend.users.created") ' . $this->user->name, $this->user->id, 'plus', 'bg-green');

        $this->visit('/admin/dashboard')
            ->see('<strong>'.$this->admin->name.'</strong> created user ' . $this->user->name);
    }

    public function testTypeDisplaysHistory()
    {
        $this->actingAs($this->admin);

        History::log('User', 'trans("history.backend.users.created") ' . $this->user->name, $this->user->id, 'plus', 'bg-green');

        $this->visit('/admin/access/user')
            ->see('<strong>'.$this->admin->name.'</strong> created user ' . $this->user->name);
    }

    public function testEntityDisplaysHistory()
    {
        $this->actingAs($this->admin);

        History::log('User', 'trans("history.backend.users.created") ' . $this->user->name, $this->user->id, 'plus', 'bg-green');

        $this->visit('/admin/access/user/3')
            ->see('<strong>'.$this->admin->name.'</strong> created user ' . $this->user->name);
    }
}

<?php

namespace Tests\Feature\OMR;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
      $this->dontSetupDatabase();
      parent::setUp();
    }

    /** @test */
    public function get_notification_from_route()
    {
        DatabaseNotification::truncate();
        create(DatabaseNotification::class);
        $this->visit(route('frontend.index'));
        $this->assertPageLoaded(route('frontend.index'));
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1,
            $this->getJson("/profiles/" . auth()->user()->name . "/notifications")->json());
    }
}

<?php

namespace Tests\Feature\OMR;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Notifications\DatabaseNotification;
use Tests\BrowserKitTestCase;
use Tests\TestCase;

class NotificationTest extends BrowserKitTestCase
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
        $this->actingAs($this->executive);
        $notification = create(DatabaseNotification::class);
        $response = $this->get(url("/users/{$this->executive->id}/notifications"));

        $this->assertCount(
            1,
            $this->json('GET', url("/users/{$this->executive->id}/notifications"))->response->getData()
        );
    }
}

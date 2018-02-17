<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RedirectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testRedirects(): void
    {
        //NOT USING THIS -- too slow, but it does check the page content as well as the URL
        $this->browse(function (Browser $browser) {
            $browser->visit('/schema/list.html')->assertPathIs('/elementsets')->assertSeeIn('h1', 'Element Sets');
            $browser->visit('/vocabulary/list.html')->assertPathIs('/vocabularies')->assertSeeIn('h1', 'Vocabularies');
            $browser->visit('/vocabulary/show/id/37.html')->assertSee('RDA Media Type');
            $browser->visit('/agent/show/id/177.html')->assertPathIs('/projects/177')->assertSeeIn('h1', 'ALA Publishing');
            $browser->visit('/agent/list.html')->assertPathIs('/projects')->assertSeeIn('h1', 'Projects');
        });
    }
}

<?php

namespace Tests\Browser\Pages;

use App\Models\Project;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ProjectPage extends BasePage
{
    private $project;

    /**
     * ProjectPage constructor.
     */
    public function __construct(Project $project )
    {
        $this->project=$project;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/projects/'. $this->project->id;
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser $browser
     *
     * @return void
     */
    public function assert( Browser $browser )
    {
        $browser->assertPathIs( $this->url() );
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [ '@element' => '#selector', ];
    }
}

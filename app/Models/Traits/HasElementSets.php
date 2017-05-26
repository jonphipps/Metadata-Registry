<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Elementset;
use App\Models\Project;

trait HasElementsets
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementsets()
    {
        return $this->hasMany( Elementset::class, 'agent_id', 'id' );
    }

    /**
     * @return string
     */
    public function getElementColumn()
    {
        $count = $this->elementsets()->count();

        return $count ?
            '<a href="' .
            url( 'projects/' . $this->id . '/elementsets' ) .
            '">' .
            Project::badge( $count ) : '&nbsp;';
    }
}

<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementSet;
use App\Models\Project;

trait HasElementSets
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementSets()
    {
        return $this->hasMany( ElementSet::class, 'agent_id', 'id' );
    }

    /**
     * @return string
     */
    public function getElementColumn()
    {
        $count = $this->elementSets()->count();

        return $count ?
            '<a href="' .
            url( 'projects/' . $this->id . '/elementsets' ) .
            '">' .
            Project::badge( $count ) : '&nbsp;';
    }
}

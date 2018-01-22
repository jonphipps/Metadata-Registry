<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Elementset;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasElementSets
{
    public function elementsets(): ?HasMany
    {
        return $this->hasMany(Elementset::class, 'agent_id', 'id');
    }

    /**
     * @return string
     */
    public function getElementColumn()
    {
        $count = $this->elementsets()->count();

        return $count ?
            '<a href="' .
            url('projects/' . $this->id . '/elementsets') .
            '">' .
            Project::badge($count) : '&nbsp;';
    }
}

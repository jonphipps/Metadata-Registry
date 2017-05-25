<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Project;
use App\Models\Vocabulary;

trait HasVocabularies
{

    /**
     * @return string
     */
    public function getVocabColumn()
    {
        $count = $this->vocabularies()->count();

        return $count ?
            '<a href="' .
            url( 'projects/' . $this->id . '/vocabularies' ) .
            '">' .
            Project::badge( $count ) : '&nbsp;';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vocabularies()
    {
        return $this->hasMany( Vocabulary::class, 'agent_id', 'id' );
    }

}

<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Project;
use App\Models\Vocabulary;

trait Vocabularies
{

    /**
     * @return array
     */
    public function conceptsForSelect()
    {
        return \DB::table( ConceptAttribute::TABLE )
            ->join( Concept::TABLE, Concept::TABLE . '.id', '=', ConceptAttribute::TABLE . '.concept_id' )
            ->join( Vocabulary::TABLE, Vocabulary::TABLE . '.id', '=', Concept::TABLE . '.vocabulary_id' )
            ->select( ConceptAttribute::TABLE . '.concept_id as id',
                Vocabulary::TABLE . '.name as vocabulary',
                ConceptAttribute::TABLE . '.language',
                ConceptAttribute::TABLE . '.object as label' )
            ->where( [ [ ConceptAttribute::TABLE . '.profile_property_id', 45, ], [ Vocabulary::TABLE . '.agent_id', $this->id, ], ] )
            ->orderBy( Vocabulary::TABLE . '.name' )
            ->orderBy( ConceptAttribute::TABLE . '.language' )
            ->orderBy( ConceptAttribute::TABLE . '.object' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [ $item->id . '_' . $item->language => $item->vocabulary . ' - (' . $item->language . ') ' . $item->label, ];
            } )
            ->toArray();
    }

    public function getVocabColumn()
    {
        $count = $this->vocabularies()->count();

        return $count ? '<a href="' . url( 'projects/' . $this->id . '/vocabularies' ) . '">' . Project::badge( $count ) : '&nbsp;';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vocabularies()
    {
        return $this->hasMany( Vocabulary::class, 'agent_id', 'id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function vocabulariesForSelect()
    {
        return Vocabulary::select( [ 'id', 'name', ] )->where( 'agent_id', $this->id )->orderBy( 'name' )->get()->mapWithKeys( function( $item ) {
            return [ $item['id'] => $item['name'] ];
        } );
    }
}

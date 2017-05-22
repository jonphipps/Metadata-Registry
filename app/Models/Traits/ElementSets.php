<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-22,  Time: 11:44 AM */

namespace App\Models\Traits;

use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementSet;
use App\Models\Project;

trait ElementSets
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementSets()
    {
        return $this->hasMany( ElementSet::class, 'agent_id', 'id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function elementSetsForSelect()
    {
        return ElementSet::select( [ 'id', 'name', ] )->where( 'agent_id', $this->id )->orderBy( 'name' )->get()->mapWithKeys( function( $item ) {
            return [ $item['id'] => $item['name'] ];
        } );
    }

    /**
     * @return array
     */
    public function elementsForSelect()
    {
        return \DB::table( ElementAttribute::TABLE )
            ->join( Element::TABLE,
                Element::TABLE . '.id',
                '=',
                ElementAttribute::TABLE . '.schema_property_id' )
            ->join( ElementSet::TABLE, ElementSet::TABLE . '.id', '=', Element::TABLE . '.schema_id' )
            ->select( ElementAttribute::TABLE .
                '.schema_property_id as id',
                ElementSet::TABLE . '.name as ElementSet',
                ElementAttribute::TABLE . '.language',
                ElementAttribute::TABLE . '.object as label' )
            ->where( [ [ ElementAttribute::TABLE . '.profile_property_id', 2, ], [ ElementSet::TABLE . '.agent_id', $this->id, ], ] )
            ->orderBy( ElementSet::TABLE . '.name' )
            ->orderBy( ElementAttribute::TABLE . '.language' )
            ->orderBy( ElementAttribute::TABLE . '.object' )
            ->get()
            ->mapWithKeys( function( $item ) {
                return [ $item->id . '_' . $item->language => $item->ElementSet . ' - (' . $item->language . ') ' . $item->label, ];
            } )
            ->toArray();
        // $elements = [];
        // /** @var ElementSet[] $elementsets */
        // $elementsets =
        //     ElementSet::with('elements')
        //         ->where('agent_id', $this->id)
        //         ->orderBy('name')
        //         ->get()
        //         ->groupBy('name');
        // foreach ($elementsets as $key => $elementset) {
        //   $elements[$key] =  $elementset->first()->elements->mapWithKeys(function ($item) use($key) {
        //     if (!empty($item['label'])) {
        //       return [ $item['id'] => "{$key} - " . $item['label'] ];
        //     }
        //   })->toArray();
        //   }
        // return $elements;
    }

    public function getElementColumn()
    {
        $count = $this->elementSets()->count();

        return $count ? '<a href="' . url( 'projects/' . $this->id . '/elementsets' ) . '">' . Project::badge( $count ) : '&nbsp;';
    }
}

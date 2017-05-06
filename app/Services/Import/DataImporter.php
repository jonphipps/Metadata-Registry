<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:49 PM */

namespace App\Services\Import;


use Illuminate\Support\Collection;

class DataImporter
{
    /** @var String $exportName */
    private $exportName;
    /** @var Collection $data */
    private $data;

    public function __construct(collection $data)
    {
        $this->data = $data;

    }

    /**
     * Returns an associative array of data based on the data supplied for import
     *
     * @return Collection
     */
    public function getDataForImport(): Collection
    {
        $h = $this->data->first();

        return $this->data->slice(1)->transform(function ($item, $key) use ($h) {
            return collect($item)->mapWithKeys(function ($item, $key) use ($h) {
                return [ $h[$key] => $item ];
            });
        });
    }

}

<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:49 PM */

namespace App\Services\Import;

use App\Models\Concept;
use App\Models\Export;
use Illuminate\Database\Eloquent\Collection as DBCollection;
use Illuminate\Support\Collection;
use function collect;

class DataImporter
{
    /** @var String $exportName */
    private $exportName;

    /** @var Collection $data */
    private $data;

    /** @var Export */
    private $export;

    /** @var Collection $rowMap */
    private $rowMap;

    /** @var Collection $rows */
    private $rows;

    /** @var Collection $addRows */
    private $addRows;

    /** @var Collection $updateRows */
    private $updateRows;

    /** @var Collection $updateRows */
    private $deleteRows;

    /** @var DBCollection $statements */
    private $statements;

    public function __construct(collection $data, Export $export = null)
    {
        $this->data    = $data;
        $this->rows    = $this->getDataForImport();
        $this->addRows = $this->getAddRows(); //only gets data rows with no row_id

        $this->export = $export;
        if ($export) {
            $this->rowMap     = self::getRowMap($export->map);
            $this->updateRows = $this->getUpdateRows(); //gets data rows with matching map
            $this->deleteRows = $this->getDeleteRows(); //gets map rows with no matching row
            $this->statements = $this->getStatements();

        }
    }

    /**
     * return a collection of rows that have no reg_id
     *
     * @return Collection
     */
    public function getAddRows()
    {
        //only keep rows that have no reg_id
        return collect($this->rows->filter(function ($row, $key) {
            return empty($row['reg_id']);
        }))->values();
    }

    /**
     * @return Collection
     * @internal param Collection $map
     * @internal param array $rowMap
     */
    public function getChageset(): Collection
    {
        $rows   = $this->updateRows;
        $rowMap = $this->rowMap;
        $statements = $this->statements;

        return $rows->transform(function (Collection $row, $key) use ($rowMap) {
            $map = $rowMap[$key];

            return $row->map(function ($value, $column) use ($map) {
                return [
                    'new value'    => $value,
                    'statement_id' => $map->get($column),
                ];
            })->reject(function ($array) {
                return empty($array['new value']) && empty($array['statement_id']);
            })->reject(function ($array, $arrayKey) {
                return $arrayKey === 'reg_id';
            });
        });

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

    public function getDeleteRows()
    {

        //only keep rows that are in the rowmap but are missing from the supplied data
        $updateRows = $this->updateRows;

        return collect($this->rowMap->reject(function ($row, $key) use ($updateRows) {
            return isset($updateRows[$key]);
        }));

    }

    /**
     * @param Collection $map
     *
     * @return Collection
     */
    public static function getHeaderFromMap(Collection $map)
    {
        return collect($map->first());
    }

    /**
     * @param Collection $map
     *
     * @return Collection
     */
    public static function getRowMap(Collection $map)
    {
        $p = self::getHeaderFromMap($map);

        return $map->slice(1)->transform(function ($item, $key) use ($p) {
            return collect($item)->mapWithKeys(function ($item, $key) use ($p) {
                return [ $p[$key]['label'] => $item ];
            });
        });
    }

    public function getStatements()
    {
        return Concept::whereVocabularyId($this->export->vocabulary_id)->with('properties.profileProperty')->get()->keyBy('id')->map(function ($concept, $key) {
                return $concept->properties->keyBy('id')->map(function ($property) {
                        return [
                            'old value'  => $property->object,
                            'updated_at' => $property->updated_at,
                        ];
                    });
            });
    }

    public function getUpdateRows()
    {
        //only keep rows that have a non-empty reg_id
        return $this->rows->reject(function ($row) {
            return empty($row['reg_id']);
        })->keyBy('reg_id');

    }

}

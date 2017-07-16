<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:49 PM */

namespace App\Services\Import;

use App\Models\Concept;
use App\Models\Element;
use App\Models\Export;
use Illuminate\Database\Eloquent\Collection as DBCollection;
use Illuminate\Support\Collection;
use const null;
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

    /** @var Collection $errors */
    private $errors;

    /** @var DBCollection $statements */
    private $statements;

    /** @var array $prefixes */
    private $prefixes = [];
    private $stats = [];
    /** @var Collection $columnProfileMap */
    private $columnProfileMap;

    public function __construct(collection $data, Export $export = null)
    {
        $this->data    = $data;
        $this->rows    = $this->getDataForImport();
        $this->addRows = $this->getAddRows(); //only gets data rows with no row_id

        $this->export = $export;
        if ($export) {
            $this->rowMap     = self::getRowMap($export->map);
            $this->columnProfileMap = self::getColumnProfileMap($export->map);
            $this->updateRows = $this->getUpdateRows(); //gets data rows with matching map
            $this->deleteRows = $this->getDeleteRows(); //gets map rows with no matching row
            if ($export->vocabulary_id) {
                $this->prefixes   = $export->vocabulary->prefixes;
                $this->statements = $this->getVocabularyStatements();
            } else {
                $this->prefixes   = $export->elementset->prefixes;
                $this->statements = $this->getElementSetStatements();
            }
        }
        $this->stats['deleted'] = $this->deleteRows === null ? 0 : $this->deleteRows->count();
        $this->stats['updated'] = $this->updateRows === null ? 0: $this->updateRows->count();
        $this->stats['added']   = $this->addRows === null ? 0: $this->addRows->count();
        $this->stats['errors']   = $this->errors === null ? 0: $this->errors->count();
    }

    /**
     * return a collection of rows that have no reg_id
     *
     * @return Collection
     */
    public function getAddRows(): Collection
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
    public function getChangeset(): Collection
    {
        $rows       = $this->updateRows;
        $rowMap     = $this->rowMap;
        $columnMap  = $this->columnProfileMap;
        $statements = $this->statements;

        $changes = $rows->map(function (Collection $row, $key) use ($rowMap, $columnMap, $statements) {
            $map          = $rowMap[$key];
            $statementRow = $statements[$key];

            return $row->map(function ($value, $column) use ($map, $columnMap, $statementRow) {
                // this is to correct for export maps that have '0' for a statement cell reference, but do have data in the statement row
                $statementId = ( $map->get($column) !== 0 ) ? $map->get($column) : $column;
                $statement   = $statementId ? collect($statementRow->pull($statementId)) : null;

                return [
                    'new value'    => $value,
                    'old value'    => $statement ? $statement->get('old value') : null,
                    'statement_id' => $statementId,
                    'language'     => $columnMap[$column]['language'],
                    'property_id'  => $columnMap[$column]['id'],
                    'updated_at'   => $statement ? $statement->get('updated_at') : null,
                ];
            })->reject(function ($array) {
                return empty($array['new value']) && empty($array['statement_id']); //remove all of the items that have been, and continue to be, empty
            })->reject(function ($array, $arrayKey) {
                return $arrayKey === 'reg_id'; //remove all of the reg_id items
            })->reject(function ($array) {
                return $array['new value'] === $array['old value']; //reject every item that has no changes
            })->reject(function ($array) {
                //reset the URI to be fully qualified
                if ($array['statement_id'] === '*uri') {
                    $array['new value'] = self::makeFqn($this->prefixes, $array['new value']);
                }

                return $array['new value'] === $array['old value']; //reject if the URIs match
            });
        })->reject(function (Collection $items) {
            return $items->count() === 0; //reject every row that no longer has items
        });

        return $changeSet;
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

    /**
     * @return Collection
     */
    public function getDeleteRows(): Collection
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
    public static function getHeaderFromMap(Collection $map): Collection
    {
        return collect($map->first());
    }

    public function getStats(): Collection
    {
        return collect($this->stats);
    }
    /**
     * @param Collection $map
     *
     * @return Collection
     */
    public static function getRowMap(Collection $map): Collection
    {
        $p = self::getHeaderFromMap($map);

        return $map->slice(1)->transform(function ($item, $key) use ($p) {
            return collect($item)->mapWithKeys(function ($item, $key) use ($p) {
                return [ $p[$key]['label'] => $item ];
            });
        });
    }

    /**
     * @return Collection
     */
    public function getUpdateRows(): Collection
    {
        //only keep rows that have a non-empty reg_id
        return $this->rows->reject(function ($row) {
            return empty($row['reg_id']);
        })->keyBy('reg_id');
    }

    /**
     * @return Collection
     */
    public function getVocabularyStatements(): Collection
    {
        return Concept::whereVocabularyId($this->export->vocabulary_id)->with('statements.profile_property', 'status')->get()->keyBy('id')->map(function ($concept, $key) {
            return $concept->statements->keyBy('id')->map(function ($property) {
                return [
                    'old value'  => $property->object,
                    'updated_at' => $property->updated_at,
                ];
            })->prepend([
                'old value'  => $concept->uri,
                'updated_at' => $concept->updated_at,
            ],
                '*uri')->prepend([
                    'old value'  => $concept->status->display_name,
                    'updated_at' => $concept->updated_at,
                ],
                    '*status');
        });
    }

    /**
     * @return Collection
     */
    public function getElementSetStatements(): Collection
    {
        return Element::whereSchemaId($this->export->schema_id)->with('statements.profile_property', 'status')->get()->keyBy('id')->map(function ($element, $key) {
            $status = $element->status->display_name;
            $thingy = $element->statements->keyBy('id')->map(function ($property) {
                return [
                    'old value'  => $property->object,
                    'updated_at' => $property->updated_at,
                    'profile_uri' => $property->profile_property->uri,
                    'is_resource' => (bool) $property->profile_property->is_object_prop,
                ];
            })->map(function($item) use ($status){
                if ($item['profile_uri'] === 'reg:status'){
                    $item['old value'] = $status;
                }
                if ($item['is_resource']){
                    $item['old value'] = self::makeCurie($this->prefixes, $item['old value']);
                }
                return $item;
            });
            return $thingy;
        });
    }

    /**
     * @param array  $prefixes
     * @param string $uri
     *
     * @return string
     */
    private static function makeFqn($prefixes, $uri): string
    {
        $result = $uri;
        foreach ($prefixes as $prefix => $fullUri) {
            $result = preg_replace('#' . $prefix . ':#uis', $fullUri, $uri);
            if ($result !== $uri) {
                break;
            }
        }

        return $result;
    }

    /**
     * @param array  $prefixes
     * @param string $uri
     *
     * @return string
     */
    private static function makeCurie($prefixes, $uri): string
    {
        $result = $uri;
        foreach ($prefixes as $prefix => $fullUri) {
            $result = preg_replace('!' . $fullUri . '!uis', $prefix . ':', $uri);
            if ($result !== $uri) {
                break;
            }
        }

        return $result;
    }

}

<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:49 PM */

namespace App\Services\Import;

use App\Exceptions\DuplicateAttributesException;
use App\Exceptions\MissingRequiredAttributeException;
use App\Exceptions\UnknownAttributeException;
use App\Models\Concept;
use App\Models\Element;
use App\Models\Export;
use App\Models\ProfileProperty;
use Illuminate\Database\Eloquent\Collection as DBCollection;
use Illuminate\Support\Collection;
use const null;
use function collect;

class DataImporter
{
    /** @var string $exportName */
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
    private $prefixes = [];
    private $stats    = [];
    /** @var Collection $columnProfileMap */
    private $columnProfileMap;
    /** @var string */
    private $currentColumnName;
    /** @var string */
    private $currentRowName;

    public function __construct(Collection $data, Export $export = null)
    {
        $this->data    = $data;
        $columnHeaders = collect($data[0]);

        $this->rows    = $this->getDataForImport();

        $this->export = $export;
        if ($export) {
            $props = ProfileProperty::whereProfileId($export->profile_id)->get()->keyBy('id');
            $this->rowMap     = self::getRowMap($export->map,$props);
            try {
                $this->columnProfileMap = self::getColumnProfileMap($export, $columnHeaders, $props);
            }
            //these are all fatal errors
            catch (DuplicateAttributesException $e) {
                $this->errors = collect(['fatal' => $e->getMessage()]);
                $this->setStats();

                return;
            } catch (MissingRequiredAttributeException $e) {
                $this->errors = collect(['fatal' => $e->getMessage()]);
                $this->setStats();

                return;
            } catch (UnknownAttributeException $e) {
                $this->errors = collect(['fatal' => $e->getMessage()]);
                $this->setStats();

                return;
            }
            $this->errors     = new Collection();
            $this->addRows    = $this->getAddRows(); //only gets data rows with no row_id
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

        $this->setStats();
    }

    public function setStats()
    {
        $this->stats['deleted'] = $this->deleteRows === null ? 0 : $this->deleteRows->count();
        $this->stats['updated'] = $this->updateRows === null ? 0 : $this->updateRows->count();
        $this->stats['added']   = $this->addRows === null ? 0 : $this->addRows->count();
        $this->stats['errors']  = $this->errors === null ? 0 : $this->errors->count();
    }
    /**
     * return a collection of rows that have no reg_id.
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

        if ($rows === null) {
            return collect([]);
        }

        $changes = $rows->map(function (Collection $row, $key) use ($rowMap, $columnMap, $statements) {
            $map          = $rowMap[$key];
            $statementRow = $statements[$key];
            $this->currentRowName = 'reg_id: ' . $key;

            return $row->map(function ($value, $column) use ($map, $columnMap, $statementRow) {
                // this is to correct for export maps that have '0' for a statement cell reference, but do have data in the statement row
                $statementId = ($map->get($column) !== 0) ? $map->get($column) : $column;
                $statement   = $statementId ? collect($statementRow->pull($statementId)) : null;
                $this->currentColumnName = $column;

                return [
                    'new value'    => $this->validateRequired($value, $columnMap[$column]),
                    'old value'    => $statement ? $statement->get('old value') : null,
                    'statement_id' => $statementId,
                    'language'     => $columnMap[$column]['language'],
                    'property_id'  => $columnMap[$column]['id'],
                    'updated_at'   => $statement ? $statement->get('updated_at') : null,
                    'required'     => $column[0] === '*',
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
                    $array['new value'] = $this->makeFqn($this->prefixes, $array['new value']);
                }

                return $array['new value'] === $array['old value']; //reject if the URIs match
            });
        })->reject(function (Collection $items) {
            return $items->count() === 0; //reject every row that no longer has items
        });

        $rows      = $this->addRows;
        $additions = $rows->map(function (Collection $row, $key) use ($columnMap) {
            $this->currentRowName = 'new row: ' . $key;

            return $row->map(function ($value, $column) use ($columnMap) {
                $this->currentColumnName = $column;
                //reset the URI to be fully qualified
                if ($column === '*uri') {
                    $value = $this->makeFqn($this->prefixes, $value);
                }

                return [
                   'new value'    => $this->validateRequired($value, $columnMap[$column]),
                   'old value'    => null,
                   'statement_id' => null,
                   'language'     => $columnMap[$column]['language'],
                   'property_id'  => $columnMap[$column]['id'],
                   'updated_at'   => null,
                   'required'     => $column[0] === '*',
                ];
            })->reject(function ($array) {
                return empty($array['new value']); //remove all of the items that have been, and continue to be, empty
            })->reject(function ($array, $arrayKey) {
                return $arrayKey === 'reg_id'; //remove all of the reg_id items
            });
        })->reject(function (Collection $items) {
            return $items->count() === 0; //reject every row that no longer has items
        });

        $changeset['update'] = $changes;
        $changeset['delete'] = $this->deleteRows;
        $changeset['add']    = $additions;

        return collect($changeset);
    }

    /**
     * Returns an associative array of data based on the data supplied for import.
     *
     * @return Collection
     */
    public function getDataForImport(): Collection
    {
        $h = $this->data->first();

        return $this->data->slice(1)->transform(function ($item, $key) use ($h) {
            return collect($item)->mapWithKeys(function ($item, $key) use ($h) {
                return [$h[$key] => $item];
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
     * @param Collection                     $map
     * @param \Illuminate\Support\Collection $props
     *
     * @return Collection
     */
    public static function getHeaderFromMap(Collection $map, Collection $props): Collection
    {
        //add the latest required attribute from the profile
        return collect($map->first())->map(function ($item, $key) use ($props) {
            $item['required'] = $item['id'] ? $props[$item['id']]->is_required : null;

            return $item;
        });
    }


    public function getStats(): Collection
    {
        $errorCount = 0;
        if ($this->errors !== null) {
            foreach ($this->errors as $error) {
                $errorCount += \count($error);
            }
        }

        $this->stats['errors'] = $errorCount;

        return collect($this->stats);
    }

    /**
     * @param Collection                     $map
     * @param \Illuminate\Support\Collection $props
     *
     * @return Collection
     */
    public static function getRowMap(Collection $map, Collection $props): Collection
    {
        $p = self::getHeaderFromMap($map, $props);

        return $map->slice(1)->transform(function ($item, $key) use ($p) {
            return collect($item)->mapWithKeys(function ($item, $key) use ($p) {
                return [$p[$key]['label'] => $item];
            });
        });
    }

    /**
     * @param Export                         $export
     * @param Collection                     $columnHeaders
     * @param \Illuminate\Support\Collection $props
     *
     * @return Collection
     * @throws \App\Exceptions\DuplicateAttributesException
     * @throws \App\Exceptions\MissingRequiredAttributeException
     * @throws \App\Exceptions\UnknownAttributeException
     */
    public static function getColumnProfileMap(Export $export, Collection $columnHeaders, Collection $props): Collection
    {
        $map        = $export->map;
        $profile    = $export->profile;
        $mapHeaders = self::getHeaderFromMap($map, $props)->keyBy('label');
        $keys       = $mapHeaders->keys()->toArray();
        //get the map for all new columns
        $newColumns = $columnHeaders->reject(function ($value, $key) use ($keys) {
            return \in_array($value, $keys, false);
        })->map(function ($column) use ($profile) {
            return $profile->getColumnMapFromHeader($column);
        })->keyBy('label');

        //check for duplicate column headers
        $headers = [];
        foreach ($columnHeaders as $columnHeader) {
            if (isset($headers[$columnHeader])) {
                throw new DuplicateAttributesException('"' . $columnHeader . '" is a duplicate attribute column. Columns cannot be duplicated');
            }

            $headers[$columnHeader] = $columnHeader;
        }

        //check for unknown columns
        if (count($newColumns)) {
            if (count($newColumns) > 1) {
                $unknown = 'columns: ';
                foreach ($newColumns as $item) {
                    $unknown .= '"' . $item['label'] . '", ';
                }
                $unknown = rtrim($unknown, ', ') . ' ...are';
            } else {
                $unknown = 'column: ';
                foreach ($newColumns as $item) {
                    $unknown .= '"' . $item['label'] . '" ...is';
                }
            }
            throw new UnknownAttributeException('The ' . $unknown . ' unknown and need to be registered with the Profile');
        }

        //check for missing required columns

        $missingRequired = $mapHeaders->filter(function ($value, $key) use ($columnHeaders) {
            return $value['required'] && ! $columnHeaders->contains($key);
        })->map(function ($item, $key) {
            return $key;
        });

        if (count($missingRequired)) {
            if (count($missingRequired) > 1) {
                $missing = 'columns: ';
                foreach ($missingRequired as $item) {
                    $missing .= '"' . $item . '", ';
                }
                $missing = rtrim($missing, ', ') . ' ...are';
            } else {
                $missing = 'column: ';
                foreach ($missingRequired as $item) {
                    $missing .= '"' . $item . '" ...is';
                }
            }
            throw new MissingRequiredAttributeException('The required attribute ' . $missing . ' missing');
        }

        return $mapHeaders->merge($newColumns);
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
    public function getErrors(): Collection
    {
        return $this->errors;
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
                    'old value'   => $property->object,
                    'updated_at'  => $property->updated_at,
                    'profile_uri' => $property->profile_property->uri,
                    'is_resource' => (bool) $property->profile_property->is_object_prop,
                ];
            })->map(function ($item) use ($status) {
                if ($item['profile_uri'] === 'reg:status') {
                    $item['old value'] = $status;
                }
                if ($item['is_resource']) {
                    $item['old value'] = self::makeCurie($this->prefixes, $item['old value']);
                }

                return $item;
            });

            return $thingy;
        });
    }

    /**
     * @param $message
     *
     * @return string
     */
    protected static function makeErrorMessage($message): string
    {
        return "[ERROR: $message]";
    }

    /**
     * @param $value
     * @param $column
     * @param $row
     * @param $level
     */
    private function logRowError($value, $column, $row, $level): void
    {
        //if this is the first error, initialize the row errors
        if (! $this->errors->get('row')) {
            $this->errors->put('row', collect());
        }

        $this->errors->get('row')->push(collect([$row, $column, $value, $level]));
    }

    /**
     * @param array  $prefixes
     * @param string $uri
     *
     * @return string
     */
    private function makeFqn($prefixes, $uri): string
    {
        $result = $uri;
        foreach ($prefixes as $prefix => $fullUri) {
            $result = preg_replace('#' . $prefix . ':#uis', $fullUri, $uri);
            if ($result !== $uri) {
                break;
            }
        }
        if ($uri === $result && strpos($uri, ':') && ! strpos($uri, '://')) {
            //we have an unregistered prefix
            $prefix = str_before($uri, ':');
            $this->logRowError(self::makeErrorMessage("'$prefix' is an unregistered prefix and cannot be expanded to form a full URI"), $this->currentColumnName, $this->currentRowName, 'warning');
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

    /**
     * @param          $value
     * @param          $column
     *
     * @return string
     */
    private function validateRequired($value, array $column): string
    {
        if (empty($value) && $column['required']) {
            $error = self::makeErrorMessage('Empty required attribute');
            $this->logRowError($error, $column['label'], $this->currentRowName, 'Row Fatal');
        }

        return $value;
    }
}

<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:49 PM */

namespace App\Services\Import;


use App\Models\Export;
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

    public function __construct(collection $data, Export $export = null)
    {
        $this->data = $data;
        $this->export = $export;
        if ($export) {
            $this->rowMap = self::getRowMap($export->map);
        }
    }

    /**
     * @return array
     * @internal param Collection $map
     * @internal param array $rowMap
     */
    public function getChageset()
    {
        $updateValues = [];
        $rows = $this->getDataForImport($this->data)->toArray();
        $rowMap = $this->rowMap->toArray();

        foreach ($rows as $rowkey => $columns) {
            $rowkey = $columns['reg_id'];
            foreach ($columns as $columnKey => $value) {
                $statement_id = $rowMap[$rowkey][$columnKey] ?? null;
                if ($statement_id || $value) {
                    $updateValues[$rowkey][$columnKey]['value']        = $value;
                    $updateValues[$rowkey][$columnKey]['statement_id'] = $statement_id;
                }
            }
        }

        return $updateValues;
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

        return $map->slice(1)
            ->transform(function ($item, $key) use ($p) {
                return collect($item)->mapWithKeys(function ($item, $key) use ($p) {
                    return [ $p[$key]['label'] => $item ];
                });
            });
    }

}

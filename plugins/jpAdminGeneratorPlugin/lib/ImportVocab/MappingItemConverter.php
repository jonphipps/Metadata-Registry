<?php
/**
 * Created by jonphipps, on 2015-05-14 at 11:31 AM
 * for the registry.test project
 */

namespace ImportVocab;


class MappingItemConverter extends \Ddeboer\DataImport\ItemConverter\MappingItemConverter{

    public function getMappings()
    {
        return $this->mappings;
    }
}

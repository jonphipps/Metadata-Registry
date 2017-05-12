<?php

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementSet;
use App\Models\Export;
use App\Models\Project;
use App\Models\Vocabulary;
use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class RDAClassesSeeder extends Seeder
{
    use DisablesForeignKeys;
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Project::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAProject.sql');
        DB::statement($updateStatement);

        Export::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAClassesExports.sql');
        DB::statement($updateStatement);

        ElementSet::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAClassesElementSet.sql');
        DB::statement($updateStatement);

        Element::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAClasses_elements.sql');
        DB::statement($updateStatement);

        ElementAttribute::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAClasses_element_attributes_fr_en.sql');
        DB::statement($updateStatement);

        $this->enableForeignKeys();
    }
}

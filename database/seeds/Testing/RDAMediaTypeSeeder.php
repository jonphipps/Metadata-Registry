<?php

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Export;
use App\Models\Project;
use App\Models\Vocabulary;
use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class RDAMediaTypeSeeder extends Seeder
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

        Export::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaTypeExports.sql');
        DB::statement($updateStatement);

        Vocabulary::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaTypeVocabulary.sql');
        DB::statement($updateStatement);

        Concept::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaType_concepts.sql');
        DB::statement($updateStatement);

        ConceptAttribute::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaType_concept_propertys_fr_en.sql');
        DB::statement($updateStatement);

        Project::truncate();
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaTypeProject.sql');
        DB::statement($updateStatement);

        $this->enableForeignKeys();
    }
}

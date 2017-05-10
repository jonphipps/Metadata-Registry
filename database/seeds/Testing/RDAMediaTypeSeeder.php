<?php

use Illuminate\Database\Seeder;

class RDAMediaTypeSeeder extends Seeder
{

    use \Database\DisablesForeignKeys;


  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $this->disableForeignKeys();

        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaType.sql');
        DB::statement($updateStatement);
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaType_concepts.sql');
        DB::statement($updateStatement);
        $updateStatement = file_get_contents(__DIR__ . '/RDAMediaType_concept_propertys_fr_en.sql');
        DB::statement($updateStatement);

        $this->enableForeignKeys();
    }
}

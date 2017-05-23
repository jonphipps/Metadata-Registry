<?php

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ConceptAttributeHistory;
use App\Models\Vocabulary;
use App\Models\VocabularyHasUser;
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
        $this->call( ProjectSeeder::class );
        $this->call( UserTableSeeder::class );

        $this->disableForeignKeys();

        //adds users specific to the history
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAUsers.sql' );
        DB::statement( $updateStatement );

        VocabularyHasUser::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAMediaTypeUsers.sql' );
        DB::statement( $updateStatement );

        Vocabulary::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAMediaTypeVocabulary.sql' );
        DB::statement( $updateStatement );

        Concept::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAMediaType_concepts.sql' );
        DB::statement( $updateStatement );

        ConceptAttribute::truncate();
        $updateStatement =
            file_get_contents( __DIR__ . '/sql/RDAMediaType_concept_propertys_fr_en.sql' );
        DB::statement( $updateStatement );

        ConceptAttributeHistory::truncate();
        $updateStatement =
            file_get_contents( __DIR__ . '/sql/RDAMediaType_concept_propertys_history_fr_en.sql' );
        DB::statement( $updateStatement );

        $this->enableForeignKeys();

    }
}

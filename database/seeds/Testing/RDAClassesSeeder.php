<?php

use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementAttributeHistory;
use App\Models\Elementset;
use App\Models\ElementSetHasUser;
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
        $this->call( ProjectSeeder::class );

        $this->disableForeignKeys();

        ElementSetHasUser::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAClassesUsers.sql' );
        DB::statement( $updateStatement );

        Elementset::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAClassesElementSet.sql' );
        DB::statement( $updateStatement );

        Element::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAClasses_elements.sql' );
        DB::statement( $updateStatement );

        ElementAttribute::truncate();
        $updateStatement =
            file_get_contents( __DIR__ . '/sql/RDAClasses_element_attributes_fr_en.sql' );
        DB::statement( $updateStatement );

        ElementAttributeHistory::truncate();
        $updateStatement =
            file_get_contents( __DIR__ . '/sql/RDAClasses_element_attributes_history_fr_en.sql' );
        DB::statement( $updateStatement );

        $this->enableForeignKeys();
    }
}

<?php

use App\Models\Export;
use App\Models\Import;
use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class RDAImportExportSeeder extends Seeder
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

        Import::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAImports.sql' );
        DB::statement( $updateStatement );

        Export::truncate();
        $updateStatement = file_get_contents( __DIR__ . '/sql/RDAExports.sql' );
        DB::statement( $updateStatement );

        $this->enableForeignKeys();
    }
}

<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    use \Database\DisablesForeignKeys;

  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $updateStatement = "
INSERT INTO `reg_status` (`id`, `display_order`, `display_name`, `uri`) VALUES
	(1,7,'Published','http://metadataregistry.org/uri/RegStatus/1001'),
	(2,1,'New-Proposed','http://metadataregistry.org/uri/RegStatus/1002'),
	(3,2,'Change-Proposed','http://metadataregistry.org/uri/RegStatus/1003'),
	(4,3,'Deprecate-Proposed','http://metadataregistry.org/uri/RegStatus/1004'),
	(5,4,'New-Under Review','http://metadataregistry.org/uri/RegStatus/1005'),
	(6,5,'Change-Under Review','http://metadataregistry.org/uri/RegStatus/1006'),
	(7,6,'Deprecate-Under Review','http://metadataregistry.org/uri/RegStatus/1007'),
	(8,8,'Deprecated','http://metadataregistry.org/uri/RegStatus/1008'),
	(9,9,'Not Approved','http://metadataregistry.org/uri/RegStatus/1009');
";
        $this->disableForeignKeys();
        Status::truncate();
        DB::statement( $updateStatement );
        $this->enableForeignKeys();
    }
}

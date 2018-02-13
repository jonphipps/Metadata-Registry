<?php

use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    use DisablesForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('profile');

        $updateStatement = "
        INSERT INTO `profile` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `child_updated_at`, `child_updated_by`, `name`, `note`, `uri`, `url`, `base_domain`, `token`, `community`, `last_uri_id`, `status_id`, `language`) VALUES 
	    (1,'2008-04-20 11:52:00','2008-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'NSDL Registry Schema',NULL,'http://registry/uri/profile/registryschema',NULL,'http://registry/uri/profile/registryschema','registryschema','100000',100000,1,'en'),
	    (2,'2015-04-20 11:52:00','2015-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'OMR Vocabulary Profile',NULL,'http://registry/uri/profile/vocabularyprofile',NULL,'http://registry/uri/profile/vocabularyprofile','registryschema','100000',100000,1,'en');
	    ";
        DB::update(DB::raw($updateStatement));

        $this->enableForeignKeys();
    }
}

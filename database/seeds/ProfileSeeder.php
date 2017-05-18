<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
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

        $updateStatement = "
        INSERT INTO `projects` (`id`, `name`, `label`, `description`, `is_private`, `created_at`, `updated_at`, `deleted_at`, `repo`, `url`, `license`, `uri_strategy`, `uri_type`, `uri_prepend`, `uri_append`, `created_by`, `updated_by`, `deleted_by`, `starting_number`, `license_uri`, `default_language`, `google_sheet_url`) VALUES 
	    (58,NULL,'NSDL Registry',NULL,0,'2006-06-05 15:58:02','2006-06-05 22:16:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
       ";
        DB::update(DB::raw($updateStatement));

        $updateStatement = "
        INSERT INTO `project_user` (`id`, `created_at`, `updated_at`, `deleted_at`, `project_id`, `user_id`, `is_registrar_for`, `is_admin_for`) VALUES 
	    (4,'2006-06-05 15:58:02','2006-03-24 20:29:24',NULL,58,36,1,1),
	    (5,'2006-06-05 15:58:02','2006-04-20 20:23:19',NULL,58,39,0,1);
        ";
        DB::update(DB::raw($updateStatement));

        $updateStatement = "
        INSERT INTO `profile` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `child_updated_at`, `child_updated_by`, `name`, `note`, `uri`, `url`, `base_domain`, `token`, `community`, `last_uri_id`, `status_id`, `language`) VALUES 
	    (1,'2008-04-20 11:52:00','2008-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'NSDL Registry Schema',NULL,'http://registry/uri/profile/registryschema',NULL,'http://registry/uri/profile/registryschema','registryschema','100000',100000,1,'en'),
	    (2,'2015-04-20 11:52:00','2015-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'OMR Vocabulary Profile',NULL,'http://registry/uri/profile/vocabularyprofile',NULL,'http://registry/uri/profile/vocabularyprofile','registryschema','100000',100000,1,'en');
	    ";
        DB::update(DB::raw($updateStatement));

        $this->enableForeignKeys();
    }
}

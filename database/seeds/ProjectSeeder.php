<?php

use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
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
        $this->truncateMultiple( [ 'reg_agent', 'reg_agent_has_user' ] );

        $updateStatement = "
        INSERT INTO `reg_agent` (`id`, `name`, `label`, `description`, `is_private`, `created_at`, `updated_at`, `deleted_at`, `repo`, `url`, `license`, `uri_strategy`, `namespace_type`, `uri_prepend`, `uri_append`, `created_by`, `updated_by`, `deleted_by`, `starting_number`, `license_uri`, `default_language`, `google_sheet_url`) VALUES 
	    (58,NULL,'NSDL Registry',NULL,0,'2006-06-05 15:58:02','2006-06-05 22:16:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
       ";
        DB::update(DB::raw($updateStatement));

        $updateStatement = "
        INSERT INTO `reg_agent_has_user` (`id`, `created_at`, `updated_at`, `deleted_at`, `agent_id`, `user_id`, `is_registrar_for`, `is_admin_for`) VALUES 
	    (4,'2006-06-05 15:58:02','2006-03-24 20:29:24',NULL,58,36,1,1),
	    (5,'2006-06-05 15:58:02','2006-04-20 20:23:19',NULL,58,39,0,1);
        ";
        DB::update(DB::raw($updateStatement));

         $this->enableForeignKeys();
    }
}

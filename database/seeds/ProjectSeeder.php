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
        $this->truncateMultiple([ 'reg_agent', 'reg_agent_has_user' ]);

        $updateStatement = <<<SQL
INSERT INTO `reg_agent` (`id`, `description`, `is_private`, `repo`, `license`, `org_email`, `org_name`, `ind_affiliation`, `ind_role`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `phone`, `web_address`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `name`, `label`, `url`, `license_uri`, `base_domain`, `namespace_type`, `uri_strategy`, `uri_prepend`, `uri_append`, `starting_number`, `default_language`, `languages`, `prefixes`, `google_sheet_url`, `repo_is_valid`) VALUES 
	(58,NULL,0,NULL,NULL,'joe.blough@bar.com','NSDL Registry','','','7717 Tracy Creek Rd.','','Vestal','NY','13850','USA','(607) 555-9825','http://metadataregistry.org','ORGANIZATION',NULL,NULL,NULL,'2006-06-05 15:58:02','2006-06-05 22:16:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(177,NULL,0,'OpenMetadataRegistry/test',NULL,'bigcheese@rdatoolkit.org','ALA Publishing','',NULL,'','','','','','US','','','Individual',NULL,NULL,NULL,'2014-01-13 09:58:44','2016-07-08 05:52:17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
	(67,NULL,0,NULL,NULL,'diane.hillmann@cornell.edu','Metadata Management Associates','',NULL,'P.O. Box 282','','Jacksonville','NY','14854','US','(607) 216-4899','','Organization',NULL,NULL,NULL,'2007-12-05 10:48:33','2007-12-12 18:01:18',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

SQL;
        DB::statement($updateStatement);

        $updateStatement = <<<SQL

INSERT INTO `reg_agent_has_user` (`id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `agent_id`, `is_registrar_for`, `is_admin_for`) VALUES 
	(4,'2006-06-05 15:58:02','2006-03-24 20:29:24',NULL,36,58,1,1),
	(5,'2006-06-05 15:58:02','2006-04-20 20:23:19',NULL,39,58,0,1),
	(171,'2014-01-13 09:58:44','2014-01-13 04:58:44',NULL,422,177,1,1),
	(194,'2014-04-15 12:09:02','2014-04-15 08:09:02',NULL,461,177,0,1);
        
SQL;
        DB::statement($updateStatement);

        $this->enableForeignKeys();
    }
}

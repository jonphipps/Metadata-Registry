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
        INSERT INTO `reg_agent` (`id`, `created_at`, `last_updated`, `deleted_at`, `org_email`, `org_name`, `ind_affiliation`, `ind_role`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `phone`, `web_address`, `type`) VALUES
	(58,'2006-06-05 15:58:02','2006-06-06 02:16:33',NULL,'jphipps@madcreek.com','NSDL Registry','','','7717 Tracy Creek Rd.','','Vestal','NY','13850','USA','(607) 555-9825','http://metadataregistry.org','ORGANIZATION');
       ";
    DB::update(DB::raw($updateStatement));

    $updateStatement = "
        INSERT INTO `reg_agent_has_user` (`id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `agent_id`, `is_registrar_for`, `is_admin_for`) VALUES
	(4,'2006-06-05 15:58:02','2006-03-25 01:29:24',NULL,36,58,1,1),
	(5,'2006-06-05 15:58:02','2006-04-21 00:23:19',NULL,39,58,0,1);
        ";
    DB::update(DB::raw($updateStatement));

    $updateStatement = "
        INSERT INTO `profile` (`id`, `agent_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `child_updated_at`, `child_updated_by`, `name`, `note`, `uri`, `url`, `base_domain`, `token`, `community`, `last_uri_id`, `status_id`, `language`) VALUES
	(1,58,'2008-04-20 11:52:00','2008-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'NSDL Registry Schema',NULL,'http://registry/uri/profile/registryschema',NULL,'http://registry/uri/profile/registryschema','registryschema','100000',100000,1,'en'),
	(2,58,'2015-04-20 11:52:00','2015-04-20 11:52:00',NULL,36,36,NULL,NULL,NULL,'OMR Vocabulary Profile',NULL,'http://registry/uri/profile/vocabularyprofile',NULL,'http://registry/uri/profile/vocabularyprofile','registryschema','100000',100000,1,'en');";
    DB::update(DB::raw($updateStatement));

    $this->enableForeignKeys();
  }
}

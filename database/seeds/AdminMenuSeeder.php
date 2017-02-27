<?php

use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    use \database\DisableForeignKeys;

  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {

        $this->disableForeignKeys();

        $updateStatement = "
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES 
	(1,0,4,'Index','fa-bar-chart','/',NULL,'2017-01-29 22:09:43'),
	(2,0,5,'Admin','fa-tasks','',NULL,'2017-01-29 22:09:43'),
	(3,2,6,'Users','fa-users','auth/users',NULL,'2017-01-29 22:09:43'),
	(4,2,7,'Roles','fa-user','auth/roles',NULL,'2017-01-29 22:09:43'),
	(5,2,8,'Permission','fa-user','auth/permissions',NULL,'2017-01-29 22:09:43'),
	(6,2,9,'Menu','fa-bars','auth/menu',NULL,'2017-01-29 22:09:43'),
	(7,2,10,'Operation log','fa-history','auth/logs',NULL,'2017-01-29 22:09:43'),
	(8,10,3,'Users','fa-user','/users','2017-01-29 22:00:25','2017-01-29 22:09:43'),
	(9,10,2,'Projects','fa-bars','/projects','2017-01-29 22:00:46','2017-01-29 22:09:43'),
	(10,0,1,'OMR','fa-cogs','','2017-01-29 22:08:44','2017-01-29 22:09:43');

";
        DB::statement(DB::raw($updateStatement));

      $updateStatement = "
INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES 
	(1,8,NULL,NULL),
	(1,2,NULL,NULL),
	(1,8,NULL,NULL);
";
      DB::statement(DB::raw($updateStatement));

      $this->enableForeignKeys();
    }
}

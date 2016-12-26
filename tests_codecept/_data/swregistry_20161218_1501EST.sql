#
# SQL Export
# Created by Querious (1063)
# Created: December 18, 2016 at 3:01:27 PM EST
# Encoding: Unicode (UTF-8)
#


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `social_logins`;
DROP TABLE IF EXISTS `role_user`;
DROP TABLE IF EXISTS `permission_role`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `history`;
DROP TABLE IF EXISTS `history_types`;
DROP TABLE IF EXISTS `assigned_roles`;


CREATE TABLE `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  KEY `roles_user_id` (`user_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `history_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `entity_id` int(10) unsigned DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_type_id_foreign` (`type_id`),
  KEY `history_user_id` (`user_id`),
  CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `password_resets_email_index` (`email`(191)),
  KEY `password_resets_token_index` (`token`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `social_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_logins_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`) VALUES 
	(1,36,1),
	(2,2,2),
	(3,3,3),
	(4,37,1),
	(5,1000107,3);


INSERT INTO `history_types` (`id`, `name`, `created_at`, `updated_at`) VALUES 
	(1,'User','2016-10-31 17:07:05','2016-10-31 17:07:05'),
	(2,'Role','2016-10-31 17:07:05','2016-10-31 17:07:05');


INSERT INTO `history` (`id`, `type_id`, `user_id`, `entity_id`, `icon`, `class`, `text`, `assets`, `created_at`, `updated_at`) VALUES 
	(1,2,36,3,'save','bg-aqua','trans("history.backend.roles.updated") Subscriber',NULL,'2016-12-16 22:06:21','2016-12-16 22:06:21'),
	(2,2,36,4,'save','bg-aqua','trans("history.backend.roles.updated") agentadmin',NULL,'2016-12-16 22:20:34','2016-12-16 22:20:34'),
	(3,2,36,3,'save','bg-aqua','trans("history.backend.roles.updated") Subscriber',NULL,'2016-12-16 22:20:57','2016-12-16 22:20:57'),
	(4,2,36,5,'save','bg-aqua','trans("history.backend.roles.updated") agentmember',NULL,'2016-12-16 22:23:14','2016-12-16 22:23:14'),
	(5,2,36,6,'save','bg-aqua','trans("history.backend.roles.updated") agentmantainer',NULL,'2016-12-16 22:34:51','2016-12-16 22:34:51'),
	(6,2,36,4,'save','bg-aqua','trans("history.backend.roles.updated") agentadmin',NULL,'2016-12-16 22:36:58','2016-12-16 22:36:58'),
	(7,1,36,38,'save','bg-aqua','trans("history.backend.users.updated") sas1',NULL,'2016-12-16 22:41:26','2016-12-16 22:41:26');




INSERT INTO `permissions` (`id`, `name`, `display_name`, `sort`, `created_at`, `updated_at`) VALUES 
	(0,'edit-self','Edit Self',50,'2016-12-16 22:04:31','2016-12-16 22:31:47'),
	(1,'view-backend','View Backend',100,'2016-12-16 22:02:55','2016-12-16 22:02:55'),
	(2,'manage-users','Manage Users',200,'2016-12-16 22:02:58','2016-12-16 22:02:58'),
	(3,'manage-roles','Manage Roles',300,'2016-12-16 22:03:01','2016-12-16 22:03:01'),
	(4,'create-project','Create a Project',400,'2016-12-16 22:03:05','2016-12-16 22:03:05'),
	(5,'edit-project','Edit a Project',500,'2016-12-16 22:03:10','2016-12-16 22:33:23'),
	(6,'edit-schema','Edit a Schema',600,'2016-12-16 22:03:13','2016-12-16 22:33:28'),
	(7,'edit-vocab','Edit a Vocabulary',700,'2016-12-16 22:03:17','2016-12-16 22:33:33'),
	(9,'view-project','View a Private Project',570,'2016-12-16 22:22:36','2016-12-16 22:32:07'),
	(10,'create-schema','Create an Element Set',580,'2016-12-16 22:26:02','2016-12-16 22:30:45'),
	(11,'create-vocab','Create a Vocabulary',670,'2016-12-16 22:28:35','2016-12-16 22:31:19'),
	(12,'delete-project','Delete a Project',550,'2016-12-16 22:28:58','2016-12-16 22:30:31'),
	(13,'delete-schema','Delete an Element Set',650,'2016-12-16 22:29:24','2016-12-16 22:31:02'),
	(14,'delete-vocab','Delete a Vocabulary',750,'2016-12-16 22:30:12','2016-12-16 22:32:44');


INSERT INTO `roles` (`id`, `name`, `display_name`, `all`, `sort`, `updated_at`) VALUES 
	(1,'Administrator','Administrator',1,1,'2016-12-16 22:19:09'),
	(2,'Executive','Executive',0,2,'2016-12-16 22:19:13'),
	(3,'Subscriber','Subscriber',0,3,'2016-12-16 22:20:57'),
	(4,'agentadmin','Project Administrator',0,400,'2016-12-16 22:36:58'),
	(5,'agentmember','Project Member',0,500,'2016-12-16 22:23:14'),
	(6,'agentmantainer','Project Maintainer',0,600,'2016-12-16 22:34:51'),
	(7,'schemaadmin','Element Set Administrator',0,700,'2016-12-16 22:15:03'),
	(8,'schemamantainer','Element Set Maintainer',0,800,'2016-12-16 22:17:03'),
	(9,'vocabularymantainer','Vocabulary Maintainer',0,900,'2016-12-16 22:18:36'),
	(10,'vocabularyadmin','Vocabulary Administrator',0,700,'2016-12-16 22:15:03');


INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES 
	(1,1,2),
	(2,2,2),
	(7,0,3),
	(8,4,3),
	(9,9,5),
	(10,5,6),
	(11,6,6),
	(12,7,6),
	(13,9,6),
	(14,5,4),
	(15,6,4),
	(16,7,4),
	(17,9,4);


INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES 
	(1,1,1),
	(2,2,2),
	(3,3,3),
	(4,36,1),
	(5,37,1),
	(6,38,3);






SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;



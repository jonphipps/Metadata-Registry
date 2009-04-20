ALTER TABLE `reg_vocabulary_has_user` 
DROP PRIMARY KEY,
ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY(`id`),
ADD UNIQUE `user_resource_id`(`user_id`, `vocabulary_id`);
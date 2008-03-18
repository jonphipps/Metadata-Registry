ALTER TABLE `swregistry2`.`reg_agent_has_user` 
DROP PRIMARY KEY,
ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT FIRST,
ADD PRIMARY KEY(`id`),
ADD UNIQUE `agent_user_id`(`agent_id`, `user_id`);

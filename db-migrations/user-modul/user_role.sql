--
-- Database table: `user_role`
--

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `user_role` UNIQUE (`user_id`,`role_id`)
);


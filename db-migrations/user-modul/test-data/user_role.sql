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

--
-- Test data for the table: `user`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 6),
(2, 5),
(3, 4),
(4, 2),
(4, 3);
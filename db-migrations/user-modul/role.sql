--
-- Database table: `role`
--

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(128) NOT NULL,
    `description` varchar(1024) NOT NULL,
    `created_on` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
);

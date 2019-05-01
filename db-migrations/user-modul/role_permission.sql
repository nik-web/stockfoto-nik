--
-- Database table: `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;

CREATE TABLE `role_permission` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `role_id` int(11) NOT NULL,
    `permission_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
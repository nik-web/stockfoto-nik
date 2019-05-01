--
-- Database table: `role_hierarchy`
-- Contains parent-child relationships between roles
--

DROP TABLE IF EXISTS `role_hierarchy`;

CREATE TABLE `role_hierarchy` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parent_role_id` int(11) NOT NULL,
    `child_role_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);

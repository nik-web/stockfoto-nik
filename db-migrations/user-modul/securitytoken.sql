--
-- Database table: `securitytoken`
--

DROP TABLE IF EXISTS `securitytoken`;

CREATE TABLE `securitytoken` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `identity` varchar(255) NOT NULL,
    `identifier` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_on` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `identity` (`identity`)
);


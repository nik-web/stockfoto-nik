--
-- Database table: `registration`
--

DROP TABLE IF EXISTS `registration`;

CREATE TABLE IF NOT EXISTS `registration` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `alias` varchar(128) NOT NULL,
    `email` varchar(128) NOT NULL,
    `created_on` datetime NOT NULL,
    `token` varchar(32) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `alias` (`alias`)
);
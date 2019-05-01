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

--
-- Test data for the table: `role`
--

INSERT INTO `role` (`name`, `description`, `created_on`) VALUES
('guest', 'Create description here', '2019-04-01 07:34:31'),
('customer', 'Create description here', '2019-04-01 07:34:32'),
('contributor', 'Create description here', '2019-04-01 07:34:33'),
('editor', 'Create description here', '2019-04-01 07:34:34'),
('moderator', 'Create description here', '2019-04-01 07:34:35'),
('admin', 'Create description here', '2017-06-25 07:34:31');
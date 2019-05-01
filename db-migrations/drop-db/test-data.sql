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

--
-- Database table: `user`
--

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(128) NOT NULL,
    `alias` varchar(128) NOT NULL,
    `password` varchar(256) NOT NULL,
    `status` bit NOT NULL,
    `created_on` datetime NOT NULL,
    `updated_on` datetime DEFAULT NULL,
    `pwd_reset_token` varchar(32) DEFAULT NULL,
    `pwd_reset_token_created_on` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `alias` (`alias`)
);

--
-- Test data for the table: `user`
--

INSERT INTO `user` (`email`, `alias`, `password`, `status`, `created_on`, `updated_on`, `pwd_reset_token`, `pwd_reset_token_created_on`) VALUES
('admin@nik-test.de', 'Admin', '$2y$10$fZHNOU.ExLjtKW2xUTOk.uLv8U7WeIiGrfQ28XVmFkyRmfJJ5NRpS', 1, '2017-06-25 07:34:31', null, null, null),
('moderator@nik-test.de', 'Moderator', '$2y$10$UtNh0feAbIdeC6zpWZFQneqZs3X25YUl5rLgL3UxCVRMbhszmFX6O', 1, '2017-06-25 07:43:11', null, null,null),
('editor@nik-test.de', 'Editor', '$2y$10$UtNh0feAbIdeC6zpWZFQneqZs3X25YUl5rLgL3UxCVRMbhszmFX6O', 1, '2017-06-25 07:43:11', null, null,null),
('nik@nik-test.de', 'Nik', '$2y$10$UtNh0feAbIdeC6zpWZFQneqZs3X25YUl5rLgL3UxCVRMbhszmFX6O', 1, '2017-06-25 07:43:20', '2017-06-25 09:43:30', null, null);

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
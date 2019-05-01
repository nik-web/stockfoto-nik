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
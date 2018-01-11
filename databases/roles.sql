/* Таблица `roles` без внешних ключей, её устанавливать в первую очередь! */

CREATE TABLE `roles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` char(255) DEFAULT NULL,
    `label` char(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roles`(`name`, `label`) VALUES
('Admin', 'Администратор'),
('Teacher', 'Преподаватель'),
('Student', 'Студент');

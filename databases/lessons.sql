/* Таблица `lessons` имеет связь с таблицей `users`, её нужно установить после установки таблицы `users` */

CREATE TABLE `lessons` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user__id` int(11) NOT NULL,
    `name` char(255) DEFAULT NULL,
    `description` char(255) DEFAULT NULL,
    `text` text DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user__id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

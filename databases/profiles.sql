/* Таблица `profiles` имеет связь с таблицей `users`, её нужно установить после установки таблицы `users` */

CREATE TABLE `profiles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user__id` int(11) NOT NULL,
    `firstname` char(255) DEFAULT NULL,
    `lastname` char(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user__id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `profiles`(`user__id`, `firstname`, `lastname`) VALUES
(1, 'Николай', 'Федорик'),
(2, 'Иван', 'Чернологов');

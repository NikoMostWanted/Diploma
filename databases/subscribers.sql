/* Таблица `subscribers` имеет связь с таблицей `users` и `lessons`, её нужно установить после установки таблиц `users` и `lessons` */

CREATE TABLE `subscribers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `lesson__id` int(11) DEFAULT NULL,
    `user__id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`lesson__id`) REFERENCES lessons(`id`),
    FOREIGN KEY (`user__id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

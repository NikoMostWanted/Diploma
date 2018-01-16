/* Таблица `files` имеет связь с таблицей `lessons`, её нужно установить после установки таблицы `lessons` */
CREATE TABLE `files` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` int(11) DEFAULT NULL,
    `lesson__id` int(11) NOT NULL,
    `href` char(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`lesson__id`) REFERENCES lessons(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

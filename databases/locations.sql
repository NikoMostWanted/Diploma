/* Таблица `locations` имеет связь с таблицей `sections` и `lessons`, её нужно установить после установки таблиц `sections` и `lessons` */

CREATE TABLE `locations` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `section__id` int(11) NOT NULL,
    `lessons__id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`section__id`) REFERENCES sections(`id`),
    FOREIGN KEY (`lessons__id`) REFERENCES lessons(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

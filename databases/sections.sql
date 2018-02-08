/* Таблица `sections` не имеет связей, её без разницы в какой очередности устанавливать */

CREATE TABLE `sections` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `alias` char(255) DEFAULT NULL,
    `name` char(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `sid` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

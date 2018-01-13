/* Таблица `navigations` не имеет связей, её без разницы в какой очередности устанавливать */

CREATE TABLE `navigations` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `label` char(255) DEFAULT NULL,
    `url` char(255) DEFAULT NULL,
    `own` tinyint(2) DEFAULT NULL COMMENT '1 - админ, 2 - клиент',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `navigations`(`label`, `url`, `own`) VALUES
('Управление пользователями', 'admin/users', 1),
('Управление навигацией', 'admin/navigation', 1),
('Главная', 'site/index', 2),
('Управление разделами', 'admin/section', 1);

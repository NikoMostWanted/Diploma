/* Таблица `navigations` не имеет связей, её без разницы в какой очередности устанавливать */

CREATE TABLE `navigations` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `alias` char(255) DEFAULT NULL,
    `label` char(255) DEFAULT NULL,
    `url` char(255) DEFAULT NULL,
    `own` tinyint(2) DEFAULT NULL COMMENT '1 - админ, 2 - клиент',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `navigations`(`alias`, `label`, `url`, `own`) VALUES
('AdminUser', 'Управление пользователями', 'admin/users', 1),
('AdminNavigation', 'Управление навигацией', 'admin/navigation', 1),
('Index', 'Главная', 'site/index', 2),
('AdminSection','Управление разделами', 'admin/section', 1),
('Authorization', 'Авторизация', 'site/login', 2),
('AdminPanel', 'Админ панель', 'admin/index', 2),
('Lessons', 'Мои уроки', 'site/lesson', 2),
('Contacts', 'Контакты', 'site/contact', 2),
('About', 'Про нас', 'site/about', 2);

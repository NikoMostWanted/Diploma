/* Таблица `profiles` имеет связь с таблицей `users`, её нужно установить после установки таблицы `users` */

CREATE TABLE `profiles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user__id` int(11) NOT NULL,
    `firstname` char(255) DEFAULT NULL,
    `lastname` char(255) DEFAULT NULL,
    `email` char(255) DEFAULT NULL,
    `phone` char(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user__id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `profiles`(`user__id`, `firstname`, `lastname`, `email`, `phone`) VALUES
(1, 'Николай', 'Федорик', 'kolu4ka02031995@gmail.com', '+380936331205'),
(2, 'Иван', 'Чернологов', 'chernologov1994@gmail.com', '+380660067351');

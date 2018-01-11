/* Таблица `users` имеет связь с таблицей `roles`, её нужно установить после установки таблицы `roles` */

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` char(255) NOT NULL,
    `password` char(255) NOT NULL,
    `role__id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`role__id`) REFERENCES roles(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users`(`username`, `password`, `role__id`) VALUES
('niko', 'e10adc3949ba59abbe56e057f20f883e', 1),
('neymar', 'e10adc3949ba59abbe56e057f20f883e', 1);

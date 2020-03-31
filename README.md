# Приложение для выставления лотов и их приобретения

Приложение построено по модели MVC. Использует NGINX, PHP-7.3, MySQL, jQuery.

## Развёртывание приложения

1) Скопировать файлы в папку или сделать `git clone <url>`
2) Создать ползователя и базу данных. Переименовать файл `app/config/db.example.php` в `app/config/db.php` исправить парметры на раннее созданные
3) Создать таблицы и данные

```MySQL
CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `counter` (`id`, `value`) VALUES (1, 0);
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```

```MySQL
CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `rub_ratio` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `currency` (`id`, `name`, `rub_ratio`) VALUES
(1, 'Йена', 0.73),
(2, 'Юань', 11.1),
(3, 'Швейцарский франк', 82.81);

ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```

```MySQL
CREATE TABLE `lots` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `rubles` text NOT NULL,
  `status` varchar(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `currency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `currency_id` (`currency_id`);

ALTER TABLE `lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `lots`
  ADD CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON UPDATE CASCADE;
```

3) Настройка сервера NGINX

```
server {
    listen 80;
    server_name <name>;
    
    access_log /var/log/nginx/<name>.access.log;
    error_log /var/log/nginx/<name>.error.log;
    
    root   /path/to/dir/;
    index  index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$args;
    
    }
    
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass  unix:/var/run/php/php7.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}

```
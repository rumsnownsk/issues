-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 18 2020 г., 11:48
-- Версия сервера: 5.7.26-0ubuntu0.18.10.1
-- Версия PHP: 7.2.19-0ubuntu0.18.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `issues`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `textissue` text NOT NULL,
  `complete` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `username`, `email`, `textissue`, `complete`) VALUES
(1, '1111', 'gпривет@ya.ru1', 'issue #1', 1),
(2, '\0s\0a\0s\0h\0a', '\"ННННН', 'issue #2\r\n', 1),
(5, '\0N\0i\0k\0o\0l\0a', '\0N\0i\0k\0o\0l\0a\0@\0y\0a\0.\0r\0u', 'Исправить', 0),
(6, '\0v\0a\0s\0i\0l\0i\0y', 'vasiliy@vasiliy.com', '\0i\0s\0s\0u\0e\0 \0#\04', 1),
(7, '\0T\0T\0T\0T', '\0T\0T\0T\0T\0T', 'issue #5', 1),
(8, '\0a\0s\0d\0f\0a\0s\0d\0f', '\0a\0s\0d\0f\0a\0s\0d\0f', '\0a\0s\0d\0f\0a\0s\0d\0f', 1),
(9, '\0a\0s\0d\0f\0a\0s\0d', '\0g\0h\0h\0h\0h\0h\0h', '\0h\0h\0h\0h\0h\0h', 1),
(10, '\0J\0J\0J\0J\0j', '\0K\0K\0K\0K\0K', '\0K\0K\0K\0K\0K', 1),
(11, '\0U\0U\0U\0U', '\0U\0U\0U\0U\0U', '\0U\0U\0U\0U\0U', 1),
(12, 'fff', 'fff', 'ffff', 1),
(13, 'fffffff', 'fffffff', 'fffffff', 0),
(14, 'a', 'fffffff', 'fffffff', 0),
(15, 'fffffff', 'fffffff', 'fffffff', 0),
(16, 'YYY', 'YYY', 'YYY', 1),
(17, 'UUU', 'тест', 'UUU', 1),
(18, 'sdf', 'asdf', 'gasdf', 1),
(21, 'VVV1', 'VVV1', 'VVV1', 1),
(24, 'QQQ', 'QQ', 'QQ', 0),
(25, 'QQQ', 'QQ', 'QQ', 0),
(26, 'привет', 'привет', '1111', 1),
(27, '222', '222', '2222', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '2',
  `fio` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password_cookie_token` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `fio`, `avatar`, `phone`, `password_cookie_token`, `created_at`, `updated_at`) VALUES
(1, 'creator', '$2y$10$qY2xDjlNnqSwR4tN/nu4mOFyl7dXE79R77TYRUfc5PhVD.Lc/0lzu', NULL, 0, NULL, NULL, NULL, '', 0, 0),
(4, 'admin', '$2y$10$4lxEoz1ELPByUjtcymt.7uNiz0n3TGVUJ3nxAHGnd3/2OEiHF.KdW', NULL, 0, NULL, NULL, NULL, '', 2, 1579322840),
(5, 'worker', '$2y$10$sldtkzSc9tI.5f2jUBvKC.cyOO9OKoQpBFqUzjhBmkh6h45Kieg6u', NULL, 1, NULL, NULL, NULL, '', 1, 1579322858);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`username`),
  ADD UNIQUE KEY `login_2` (`username`),
  ADD UNIQUE KEY `login_3` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

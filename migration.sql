-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 04 2017 г., 13:56
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_google`
--

-- --------------------------------------------------------

--
-- Структура таблицы `private`
--

CREATE TABLE `private` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `birth` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `post_index` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `private`
--

INSERT INTO `private` (`id`, `user_id`, `birth`, `phone`, `country`, `city`, `adress`, `post_index`, `image`) VALUES
(1, 1, '09.10.1989', '+3124651655', 'Ukraine', 'ZP', 'Secret', 456812, 'uploads/1504509240.jpg'),
(45, 11, '', '', '', '', '', 0, 'uploads/1504522354.jpg'),
(46, 12, '', '', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `password`, `gender`, `locale`, `picture_url`, `profile_url`, `created`, `modified`) VALUES
(1, '', '', 'Sergey', 'Tester', 'root', 'root', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '', '', 'Ivan', '', 'email', 'password', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'google', '114011428814675343742', 'Сергей', 'Ермаков', 'erm.sergey1989@gmail.com', '', 'male', 'ru', 'https://lh3.googleusercontent.com/-JbkSMkPOplY/AAAAAAAAAAI/AAAAAAAAAMw/G-4OwImn_a0/photo.jpg', 'https://plus.google.com/114011428814675343742', '2017-09-04 13:53:09', '2017-09-04 13:56:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `private`
--
ALTER TABLE `private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

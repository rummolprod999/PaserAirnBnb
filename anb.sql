-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 04 2019 г., 13:56
-- Версия сервера: 10.4.10-MariaDB-1:10.4.10+maria~eoan-log
-- Версия PHP: 7.2.25-1+ubuntu19.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `anb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `analitic`
--

CREATE TABLE `analitic` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `perid_nights` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `anb_url`
--

CREATE TABLE `anb_url` (
  `id` int(11) NOT NULL,
  `url` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `own` tinyint(1) NOT NULL DEFAULT 0,
  `num_parsing` int(11) NOT NULL,
  `suspend` tinyint(4) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `last_parsing` date NOT NULL DEFAULT '2019-01-01',
  `notes` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bookable_changes`
--

CREATE TABLE `bookable_changes` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `booking` tinyint(4) NOT NULL DEFAULT 0,
  `date_cal` date NOT NULL,
  `date_parsing` datetime NOT NULL,
  `num_parsing` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `checkup`
--

CREATE TABLE `checkup` (
  `id` int(11) NOT NULL,
  `iid_anb` int(11) NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_last` datetime NOT NULL,
  `price_first_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_first_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out_first_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_second_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_second_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out_second_15` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_30` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_30` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out_30` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `date_not_first`
--

CREATE TABLE `date_not_first` (
  `id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `date_not_first_count`
--

CREATE TABLE `date_not_first_count` (
  `id` int(11) NOT NULL,
  `day_month` int(11) NOT NULL,
  `count_m` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `days`
--

CREATE TABLE `days` (
  `id` bigint(11) NOT NULL,
  `id_checkup` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `min_nights` int(11) NOT NULL,
  `available_for_checkin` int(1) NOT NULL,
  `bookable` int(1) NOT NULL,
  `date` date NOT NULL,
  `price_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `discount` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_parsing` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `intervals_count`
--

CREATE TABLE `intervals_count` (
  `id` bigint(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `id_count` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `price_changes`
--

CREATE TABLE `price_changes` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `price_was` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date_cal` date NOT NULL,
  `date_parsing` datetime NOT NULL,
  `num_parsing` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `price_cleaning`
--

CREATE TABLE `price_cleaning` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `price_cleaning` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `proxy`
--

CREATE TABLE `proxy` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `proxy_address` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proxy_port` int(11) NOT NULL,
  `proxy_user` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proxy_pass` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pass` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `user_email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_report` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_activity`
--

CREATE TABLE `users_activity` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `last_logon` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `request_page` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `analitic`
--
ALTER TABLE `analitic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_url` (`id_url`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `perid_nights` (`perid_nights`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `anb_url`
--
ALTER TABLE `anb_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`(768)),
  ADD KEY `num_parsing` (`num_parsing`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `last_parsing` (`last_parsing`);

--
-- Индексы таблицы `bookable_changes`
--
ALTER TABLE `bookable_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_url` (`id_url`),
  ADD KEY `date_cal` (`date_cal`),
  ADD KEY `date_parsing` (`date_parsing`),
  ADD KEY `num_parsing` (`num_parsing`),
  ADD KEY `seen` (`seen`);

--
-- Индексы таблицы `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iid_anb` (`iid_anb`);

--
-- Индексы таблицы `date_not_first`
--
ALTER TABLE `date_not_first`
  ADD PRIMARY KEY (`id`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `end_date` (`end_date`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `date_not_first_count`
--
ALTER TABLE `date_not_first_count`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `day_month` (`day_month`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `count_m` (`count_m`);

--
-- Индексы таблицы `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_checkup` (`id_checkup`);

--
-- Индексы таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_url` (`id_url`),
  ADD KEY `date_parsing` (`date_parsing`);

--
-- Индексы таблицы `intervals_count`
--
ALTER TABLE `intervals_count`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_count` (`id_count`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `price_changes`
--
ALTER TABLE `price_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_url` (`id_url`),
  ADD KEY `price` (`price`),
  ADD KEY `date_parsing` (`date_parsing`),
  ADD KEY `num_parsing` (`num_parsing`),
  ADD KEY `seen` (`seen`),
  ADD KEY `price_was` (`price_was`);

--
-- Индексы таблицы `price_cleaning`
--
ALTER TABLE `price_cleaning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_url` (`id_url`);

--
-- Индексы таблицы `proxy`
--
ALTER TABLE `proxy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_name` (`user_name`(768));

--
-- Индексы таблицы `users_activity`
--
ALTER TABLE `users_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `analitic`
--
ALTER TABLE `analitic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `anb_url`
--
ALTER TABLE `anb_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bookable_changes`
--
ALTER TABLE `bookable_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `checkup`
--
ALTER TABLE `checkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `date_not_first`
--
ALTER TABLE `date_not_first`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `date_not_first_count`
--
ALTER TABLE `date_not_first_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `intervals_count`
--
ALTER TABLE `intervals_count`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `price_changes`
--
ALTER TABLE `price_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `price_cleaning`
--
ALTER TABLE `price_cleaning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `proxy`
--
ALTER TABLE `proxy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_activity`
--
ALTER TABLE `users_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `analitic`
--
ALTER TABLE `analitic`
  ADD CONSTRAINT `analitic_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `anb_url`
--
ALTER TABLE `anb_url`
  ADD CONSTRAINT `anb_url_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bookable_changes`
--
ALTER TABLE `bookable_changes`
  ADD CONSTRAINT `bookable_changes_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `checkup`
--
ALTER TABLE `checkup`
  ADD CONSTRAINT `checkup_ibfk_1` FOREIGN KEY (`iid_anb`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `date_not_first`
--
ALTER TABLE `date_not_first`
  ADD CONSTRAINT `date_not_first_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `date_not_first_count`
--
ALTER TABLE `date_not_first_count`
  ADD CONSTRAINT `date_not_first_count_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_ibfk_1` FOREIGN KEY (`id_checkup`) REFERENCES `checkup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `intervals_count`
--
ALTER TABLE `intervals_count`
  ADD CONSTRAINT `intervals_count_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `price_changes`
--
ALTER TABLE `price_changes`
  ADD CONSTRAINT `price_changes_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `price_cleaning`
--
ALTER TABLE `price_cleaning`
  ADD CONSTRAINT `price_cleaning_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `proxy`
--
ALTER TABLE `proxy`
  ADD CONSTRAINT `proxy_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_activity`
--
ALTER TABLE `users_activity`
  ADD CONSTRAINT `users_activity_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

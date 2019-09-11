-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 11 2019 г., 10:02
-- Версия сервера: 10.3.17-MariaDB-1:10.3.17+maria~disco-log
-- Версия PHP: 7.2.22-1+ubuntu19.04.1+deb.sury.org+1

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
-- Структура таблицы `anb_url`
--

CREATE TABLE `anb_url` (
  `id` int(11) NOT NULL,
  `url` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changes` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `change_price` varchar(8000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `own` tinyint(1) NOT NULL DEFAULT 0,
  `num_parsing` int(11) NOT NULL
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
  `seen` tinyint(4) NOT NULL
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
-- Структура таблицы `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `id_checkup` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `min_nights` int(11) NOT NULL,
  `available_for_checkin` int(1) NOT NULL,
  `bookable` int(1) NOT NULL,
  `date` date NOT NULL,
  `price_day` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `price_changes`
--

CREATE TABLE `price_changes` (
  `id` int(11) NOT NULL,
  `id_url` int(11) NOT NULL,
  `price_was` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cal` date NOT NULL,
  `date_parsing` datetime NOT NULL,
  `num_parsing` int(11) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anb_url`
--
ALTER TABLE `anb_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`(768)),
  ADD KEY `num_parsing` (`num_parsing`);

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
-- Индексы таблицы `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_checkup` (`id_checkup`);

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
-- AUTO_INCREMENT для сохранённых таблиц
--

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
-- AUTO_INCREMENT для таблицы `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `price_changes`
--
ALTER TABLE `price_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

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
-- Ограничения внешнего ключа таблицы `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_ibfk_1` FOREIGN KEY (`id_checkup`) REFERENCES `checkup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `price_changes`
--
ALTER TABLE `price_changes`
  ADD CONSTRAINT `price_changes_ibfk_1` FOREIGN KEY (`id_url`) REFERENCES `anb_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 26 2019 г., 13:33
-- Версия сервера: 10.3.17-MariaDB-1:10.3.17+maria~disco-log
-- Версия PHP: 7.2.21-1+ubuntu19.04.1+deb.sury.org+1

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
  `change_price` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
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

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anb_url`
--
ALTER TABLE `anb_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`(768));

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anb_url`
--
ALTER TABLE `anb_url`
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
-- Ограничения внешнего ключа сохраненных таблиц
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

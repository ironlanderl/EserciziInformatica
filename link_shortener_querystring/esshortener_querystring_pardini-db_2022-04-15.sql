-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Apr 15, 2022 alle 09:25
-- Versione del server: 8.0.18
-- Versione PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esshortener_querystring_pardini`
--
CREATE DATABASE IF NOT EXISTS `esshortener_querystring_pardini` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `esshortener_querystring_pardini`;

-- --------------------------------------------------------

--
-- Struttura della tabella `urls`
--

DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls` (
  `original` varchar(512) NOT NULL,
  `shorter` varchar(32) NOT NULL,
  `visits` int(10) UNSIGNED DEFAULT '0',
  `insertedby` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `urls`
--

INSERT INTO `urls` (`original`, `shorter`, `visits`, `insertedby`) VALUES
('http://kilobytely.com/xmb0pe3sh6vk9yd2rg5uj8xmb0pee3sh6vk9ync1qfazod2rg5uj8xmb7wlazod2rg5uj80pe3sh6vk9ync1c1qf4ti7wlazod3sh6vk9ync1qf4zod2rg5uj8xmb0sh6vk9ync1qf4tc1qf4ti7wlazodi7wlazod2rg5ujzod2rg5uj8xmb0rg5uj8xmb0pe3svk9ync1qf4ti7wj8xmb0pe3sh6vkvk9ync1qf4ti7w0pe3sh6vk9ync1od2rg5uj8xmb0prg5uj8xmb0pe3srg5uj8xmb0pe3sh6vk9ync1qf4tij8xmb0pe3sh6vk9ync1qf4ti7wlati7wlazod2rg5ug5uj8xmb0pe3sh1qf4ti7wlazod22rg5uj8xmb0pe3', '4sA6Dqlhmn', 1, 'Fabrizio'),
('https://stackoverflow.com/questions/12525251/header-location-not-working-in-my-php-code', '7CeYISyV14', 0, 'Fabrizio'),
('https://google.com?&procedure=absorbed&cover=repulsive&chef=wary&ketchup=absorbed&signature=festive&inglenook=rough&eyeglasses=evasive&pyjama=condemned&amount=deeply&bathhouse=mammoth&skywalk=deafening&designer=apathetic&underwire=pumped&bee=rampant&chapel=late&chipmunk=neighborly&regret=rebellious&promotion=low&criticism=axiomatic&automaton=rebellious&ashram=graceful&shoulder=shivering&female=damaged&psychiatrist=fallacious&postage=adhesive&story=furtive&schooner=premium&doorknob=rambunctious&diploma=wet', '8PS7VYRz32', 1, 'Fabrizio'),
('https://google.com', '9TDQzJYJa0', 6, 'Fabrizio'),
('https://google.com', 'crpPG9cXzj', 0, 'Fabrizio'),
('https://www.reddit.com/r/flask/comments/b7ennc/how_do_i_prevent_post_request_on_page_refresh/', 'DhvuOILDrD', 1, 'Fabrizio'),
('https://ironlanderl.tk/test.html', 'yGIYCksxqZ', 0, 'Fabrizio2');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('Fabrizio', '$2y$10$KiTeMzrrxejOs3ICpmfr4O5hWg6YM9dIHPQbnx1g2DTMlsdv0UhXa'),
('Fabrizio2', '$2y$10$WtWFW5HW2HKClLfx1Rk9r.E6KZuCvHnPw.RC3erghu/8v9Z6kYQ4K');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`shorter`),
  ADD KEY `insertedby` (`insertedby`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `urls_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

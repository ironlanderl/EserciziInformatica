-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Apr 05, 2022 alle 08:58
-- Versione del server: 8.0.23
-- Versione PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esshortener_file_pardini`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `urls`
--

CREATE TABLE `urls` (
  `original` varchar(512) NOT NULL,
  `shorter` varchar(32) NOT NULL,
  `visits` int UNSIGNED DEFAULT '0',
  `insertedby` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `urls`
--

INSERT INTO `urls` (`original`, `shorter`, `visits`, `insertedby`) VALUES
('https://ironlanderl.tk', '6oDAIavx3p', 0, 'Fabrizio'),
('https://alula.github.io/SpaceCadetPinball/', 'abpdd2BGrh', 5, 'Fabrizio'),
('http://kilobytely.com/xmb0pe3sh6vk9yd2rg5uj8xmb0pee3sh6vk9ync1qfazod2rg5uj8xmb7wlazod2rg5uj80pe3sh6vk9ync1c1qf4ti7wlazod3sh6vk9ync1qf4zod2rg5uj8xmb0sh6vk9ync1qf4tc1qf4ti7wlazodi7wlazod2rg5ujzod2rg5uj8xmb0rg5uj8xmb0pe3svk9ync1qf4ti7wj8xmb0pe3sh6vkvk9ync1qf4ti7w0pe3sh6vk9ync1od2rg5uj8xmb0prg5uj8xmb0pe3srg5uj8xmb0pe3sh6vk9ync1qf4tij8xmb0pe3sh6vk9ync1qf4ti7wlati7wlazod2rg5ug5uj8xmb0pe3sh1qf4ti7wlazod22rg5uj8xmb0pe3', 'bipjI9i5Ri', 0, 'Fabrizio'),
('https://google.com', 'i4CKnejCsb', 0, 'Fabrizio'),
('http://kilobytely.com/mb0pe3sh6vk9yni7wlazod2rg5uj3sh6vk9ync1qf42rg5uj8xmb0pe3rg5uj8xmb0pe3suj8xmb0pe3sh6vti7wlazod2rg5ulazod2rg5uj8xmti7wlazod2rg5uync1qf4ti7wlazk9ync1qf4ti7wlmb0pe3sh6vk9ynf4ti7wlazod2rgd2rg5uj8xmb0penc1qf4ti7wlazo6vk9ync1qf4ti7e3sh6vk9ync1qfmb0pe3sh6vk9yn5uj8xmb0pe3sh6xmb0pe3sh6vk9yi7wlazod2rg5uj9ync1qf4ti7wlaazod2rg5uj8xmbb0pe3sh6vk9yncrg5uj8xmb0pe3s6vk9ync1qf4ti7xmb0pe3sh6vk9y0pe3sh6vk9ync1vk9ync1qf4ti7wzod2rg5uj8xmb09ync1qf4ti7wlavk9ync1qf4ti7wuj8xmb0pe3sh6vod2rg5uj8xmb0p9ync1qf4t', 'IvLTV9jsMN', 0, 'Fabrizio'),
('https://github.com', 'UJZgcZA1dj', 13, 'Fabrizio'),
('https://google.com?&procedure=absorbed&cover=repulsive&chef=wary&ketchup=absorbed&signature=festive&inglenook=rough&eyeglasses=evasive&pyjama=condemned&amount=deeply&bathhouse=mammoth&skywalk=deafening&designer=apathetic&underwire=pumped&bee=rampant&chapel=late&chipmunk=neighborly&regret=rebellious&promotion=low&criticism=axiomatic&automaton=rebellious&ashram=graceful&shoulder=shivering&female=damaged&psychiatrist=fallacious&postage=adhesive&story=furtive&schooner=premium&doorknob=rambunctious&diploma=wet&c', 'XrBbWwoHSa', 0, 'Fabrizio'),
('https://google.com', 'XytxgOfddi', 0, 'Fabrizio2');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

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

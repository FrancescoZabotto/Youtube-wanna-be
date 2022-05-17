-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 17, 2022 alle 19:00
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectfinale`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `canale`
--

CREATE TABLE `canale` (
  `username` varchar(255) NOT NULL,
  `total_views` int(32) NOT NULL DEFAULT 0,
  `total_likes` int(32) NOT NULL DEFAULT 0,
  `total_dislikes` int(32) NOT NULL DEFAULT 0,
  `subscibes` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `canale`
--

INSERT INTO `canale` (`username`, `total_views`, `total_likes`, `total_dislikes`, `subscibes`) VALUES
('A', 0, 0, 0, 0),
('B', 0, 0, 0, 0),
('zabo', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `categorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie_video`
--

CREATE TABLE `categorie_video` (
  `categorie` varchar(32) NOT NULL,
  `video_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `impostazioni`
--

CREATE TABLE `impostazioni` (
  `username` varchar(255) NOT NULL,
  `nomeimpostazione` varchar(32) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni_persona`
--

CREATE TABLE `iscrizioni_persona` (
  `iscrivente` varchar(255) NOT NULL,
  `canaleuser` varchar(255) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `iscrizioni_persona`
--

INSERT INTO `iscrizioni_persona` (`iscrivente`, `canaleuser`, `isactive`) VALUES
('A', 'B', 1),
('zabo', 'A', 1),
('zabo', 'B', 1),
('zabo', 'zabo', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `nome`, `cognome`, `username`, `password`) VALUES
('A', 'A', 'A', 'A', 'A'),
('a@a.com', 'Yari', 'Zbotto', 'YZ', '6e6bc4e49dd477ebc98ef4046c067b5f'),
('B', 'B', 'B', 'B', 'B'),
('francescus03@gmail.com', 'francesco', 'zabotto', 'zabo', 'd155f675a9487811096dc87597426f8e');

-- --------------------------------------------------------

--
-- Struttura della tabella `video`
--

CREATE TABLE `video` (
  `video_id` int(64) NOT NULL,
  `username` varchar(255) NOT NULL,
  `likes` int(8) NOT NULL DEFAULT 0,
  `dislikes` int(8) NOT NULL DEFAULT 0,
  `videoview` int(12) NOT NULL DEFAULT 0,
  `datains` datetime NOT NULL,
  `descrizione` text DEFAULT NULL,
  `titolo` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `video`
--

INSERT INTO `video` (`video_id`, `username`, `likes`, `dislikes`, `videoview`, `datains`, `descrizione`, `titolo`) VALUES
(81, 'zabo', 0, 0, 1, '2022-05-05 17:28:07', 'GAY', 'SESSO'),
(89, 'zabo', 0, 0, 0, '2022-05-15 20:24:34', 'CI SIAMO?', 'ALLORA');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `canale`
--
ALTER TABLE `canale`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categorie`);

--
-- Indici per le tabelle `categorie_video`
--
ALTER TABLE `categorie_video`
  ADD PRIMARY KEY (`categorie`,`video_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indici per le tabelle `impostazioni`
--
ALTER TABLE `impostazioni`
  ADD PRIMARY KEY (`username`,`nomeimpostazione`);

--
-- Indici per le tabelle `iscrizioni_persona`
--
ALTER TABLE `iscrizioni_persona`
  ADD PRIMARY KEY (`iscrivente`,`canaleuser`),
  ADD KEY `canaleuser` (`canaleuser`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `canale`
--
ALTER TABLE `canale`
  ADD CONSTRAINT `canale_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `categorie_video`
--
ALTER TABLE `categorie_video`
  ADD CONSTRAINT `categorie_video_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `video` (`video_id`),
  ADD CONSTRAINT `categorie_video_ibfk_2` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`categorie`);

--
-- Limiti per la tabella `impostazioni`
--
ALTER TABLE `impostazioni`
  ADD CONSTRAINT `impostazioni_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `iscrizioni_persona`
--
ALTER TABLE `iscrizioni_persona`
  ADD CONSTRAINT `iscrizioni_persona_ibfk_1` FOREIGN KEY (`canaleuser`) REFERENCES `canale` (`username`),
  ADD CONSTRAINT `iscrizioni_persona_ibfk_2` FOREIGN KEY (`iscrivente`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`username`) REFERENCES `canale` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

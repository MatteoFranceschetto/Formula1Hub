-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 29, 2024 alle 18:29
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbformula1hub`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `circuito`
--

CREATE TABLE `circuito` (
  `Nome` varchar(30) NOT NULL,
  `Stato` varchar(30) NOT NULL,
  `Immagine` longblob NOT NULL,
  `LTracciato` int(11) NOT NULL,
  `Record` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `contratto`
--

CREATE TABLE `contratto` (
  `CodiceS` int(11) NOT NULL,
  `CodiceP` int(11) NOT NULL,
  `Datacontratto` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `gara`
--

CREATE TABLE `gara` (
  `CodiceG` int(11) NOT NULL,
  `Giorno` date NOT NULL,
  `Orario` time NOT NULL,
  `NumGiri` int(11) NOT NULL,
  `Anno` year(4) NOT NULL,
  `Vincitore` varchar(30) DEFAULT NULL,
  `Meteo` varchar(30) DEFAULT NULL,
  `NomeC` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `gara`
--
DELIMITER $$
CREATE TRIGGER `incrementa_vittorie` AFTER UPDATE ON `gara` FOR EACH ROW BEGIN
    DECLARE vincitore_id INT;
    
    -- Trova il codice del pilota vincitore
    SET vincitore_id = SUBSTRING_INDEX(NEW.Vincitore, ' - ', 1);
    
    -- Incrementa il numero di vittorie del pilota
    UPDATE piloti
    SET NumVittorie = NumVittorie + 1
    WHERE CodiceP = vincitore_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `macchina`
--

CREATE TABLE `macchina` (
  `CodiceM` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `AnnoProduzione` year(4) NOT NULL,
  `Descrizione` longtext NOT NULL,
  `CodiceSquadra` int(11) NOT NULL,
  `Foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `CodiceN` int(11) NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `Descrizione` longtext NOT NULL,
  `DataP` date NOT NULL,
  `SitiEsterni` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `newsg`
--

CREATE TABLE `newsg` (
  `CodiceG` int(11) NOT NULL,
  `CodiceN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `newsp`
--

CREATE TABLE `newsp` (
  `CodiceP` int(11) NOT NULL,
  `CodiceN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `newss`
--

CREATE TABLE `newss` (
  `CodiceS` int(11) NOT NULL,
  `CodiceN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazione`
--

CREATE TABLE `partecipazione` (
  `CodiceG` int(11) NOT NULL,
  `CodiceP` int(11) NOT NULL,
  `Posizione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `partecipazione`
--
DELIMITER $$
CREATE TRIGGER `confronta_posizione` AFTER INSERT ON `partecipazione` FOR EACH ROW BEGIN
    DECLARE posizione_vincitore INT;
    
    -- Trova la posizione del pilota appena inserito
    SELECT Posizione INTO posizione_vincitore
    FROM partecipazione
    WHERE CodiceG = NEW.CodiceG AND CodiceP = NEW.CodiceP;
    
    -- Controlla se il pilota inserito ha una posizione migliore del vincitore attuale
    IF posizione_vincitore = 1 THEN
        -- Aggiorna il vincitore della gara
        UPDATE gara
        SET Vincitore = CONCAT(NEW.CodiceP, ' - ', (SELECT Nome FROM piloti WHERE CodiceP = NEW.CodiceP))
        WHERE CodiceG = NEW.CodiceG;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `piloti`
--

CREATE TABLE `piloti` (
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `CodiceP` int(11) NOT NULL,
  `NumVittorie` int(11) DEFAULT NULL,
  `DataNacita` date NOT NULL,
  `Foto` longblob NOT NULL,
  `Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `piloti`
--
DELIMITER $$
CREATE TRIGGER `before_insert_update_pilots` BEFORE INSERT ON `piloti` FOR EACH ROW BEGIN     
DECLARE num_pilots INT;     
-- Conta il numero di piloti attualmente nella squadra per l'anno corrente     
SELECT COUNT(*)
INTO num_pilots     
FROM contratto c     
WHERE c.codiceS IN (SELECT codiceS FROM contratto c1 WHERE c1.codiceP = NEW.codiceP AND c.Datacontratto = c1.Datacontratto);      
-- Controlla se il numero di piloti supera 3     
IF num_pilots >= 3 THEN         
SIGNAL SQLSTATE '45000'         
SET MESSAGE_TEXT = 'Numero massimo di piloti per squadra raggiunto per questo anno.';     
END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `CodiceS` int(11) NOT NULL,
  `CodiceU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `CodiceS` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Logo` longblob NOT NULL,
  `Descrizione` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `staff`
--

CREATE TABLE `staff` (
  `CodiceS` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Ruolo` varchar(30) NOT NULL,
  `CodiceSquadra` int(11) NOT NULL,
  `Foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `CodiceU` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `circuito`
--
ALTER TABLE `circuito`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `contratto`
--
ALTER TABLE `contratto`
  ADD PRIMARY KEY (`CodiceS`,`CodiceP`,`Datacontratto`),
  ADD KEY `contratto_ibfk_2` (`CodiceP`);

--
-- Indici per le tabelle `gara`
--
ALTER TABLE `gara`
  ADD PRIMARY KEY (`CodiceG`),
  ADD KEY `NomeC` (`NomeC`);

--
-- Indici per le tabelle `macchina`
--
ALTER TABLE `macchina`
  ADD PRIMARY KEY (`CodiceM`),
  ADD KEY `CodiceSquadra` (`CodiceSquadra`);

--
-- Indici per le tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`CodiceN`);

--
-- Indici per le tabelle `newsg`
--
ALTER TABLE `newsg`
  ADD PRIMARY KEY (`CodiceG`,`CodiceN`),
  ADD KEY `newsg_ibfk_2` (`CodiceN`);

--
-- Indici per le tabelle `newsp`
--
ALTER TABLE `newsp`
  ADD PRIMARY KEY (`CodiceP`,`CodiceN`),
  ADD KEY `newsp_ibfk_2` (`CodiceN`);

--
-- Indici per le tabelle `newss`
--
ALTER TABLE `newss`
  ADD PRIMARY KEY (`CodiceS`,`CodiceN`),
  ADD KEY `newss_ibfk_2` (`CodiceN`);

--
-- Indici per le tabelle `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`CodiceG`,`CodiceP`,`Posizione`),
  ADD KEY `partecipazione_ibfk_2` (`CodiceP`);

--
-- Indici per le tabelle `piloti`
--
ALTER TABLE `piloti`
  ADD PRIMARY KEY (`CodiceP`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`CodiceS`,`CodiceU`),
  ADD KEY `CodiceU` (`CodiceU`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`CodiceS`);

--
-- Indici per le tabelle `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`CodiceS`),
  ADD KEY `CodiceSquadra` (`CodiceSquadra`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`CodiceU`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `news`
--
ALTER TABLE `news`
  MODIFY `CodiceN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `piloti`
--
ALTER TABLE `piloti`
  MODIFY `CodiceP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `CodiceS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `CodiceU` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `contratto`
--
ALTER TABLE `contratto`
  ADD CONSTRAINT `contratto_ibfk_1` FOREIGN KEY (`CodiceS`) REFERENCES `squadra` (`CodiceS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contratto_ibfk_2` FOREIGN KEY (`CodiceP`) REFERENCES `piloti` (`CodiceP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `gara`
--
ALTER TABLE `gara`
  ADD CONSTRAINT `gara_ibfk_1` FOREIGN KEY (`NomeC`) REFERENCES `circuito` (`Nome`);

--
-- Limiti per la tabella `macchina`
--
ALTER TABLE `macchina`
  ADD CONSTRAINT `macchina_ibfk_1` FOREIGN KEY (`CodiceSquadra`) REFERENCES `squadra` (`CodiceS`);

--
-- Limiti per la tabella `newsg`
--
ALTER TABLE `newsg`
  ADD CONSTRAINT `newsg_ibfk_1` FOREIGN KEY (`CodiceG`) REFERENCES `gara` (`CodiceG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newsg_ibfk_2` FOREIGN KEY (`CodiceN`) REFERENCES `news` (`CodiceN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `newsp`
--
ALTER TABLE `newsp`
  ADD CONSTRAINT `newsp_ibfk_1` FOREIGN KEY (`CodiceP`) REFERENCES `piloti` (`CodiceP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newsp_ibfk_2` FOREIGN KEY (`CodiceN`) REFERENCES `news` (`CodiceN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `newss`
--
ALTER TABLE `newss`
  ADD CONSTRAINT `newss_ibfk_1` FOREIGN KEY (`CodiceS`) REFERENCES `squadra` (`CodiceS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `newss_ibfk_2` FOREIGN KEY (`CodiceN`) REFERENCES `news` (`CodiceN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD CONSTRAINT `partecipazione_ibfk_1` FOREIGN KEY (`CodiceG`) REFERENCES `gara` (`CodiceG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazione_ibfk_2` FOREIGN KEY (`CodiceP`) REFERENCES `piloti` (`CodiceP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`CodiceS`) REFERENCES `squadra` (`CodiceS`),
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`CodiceU`) REFERENCES `utenti` (`CodiceU`);

--
-- Limiti per la tabella `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`CodiceSquadra`) REFERENCES `squadra` (`CodiceS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

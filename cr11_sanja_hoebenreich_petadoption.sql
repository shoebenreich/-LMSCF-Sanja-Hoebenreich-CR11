-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Jul 2020 um 12:50
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_sanja_hoebenreich_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_sanja_hoebenreich_petadoption` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cr11_sanja_hoebenreich_petadoption`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `house_number` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`location_id`, `city`, `zip_code`, `address`, `house_number`) VALUES
(1, '100 Mile House', 8107, '263-9801 Duis Street', '72'),
(2, 'Balvano', 58983, '139-9776 Egestas. Road', '12'),
(3, 'Spiere', 1556, 'P.O. Box 277, 369 Blandit Ave', '4'),
(4, 'Bevel', 84656, 'P.O. Box 644, 8475 Nec St.', '151');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `age` smallint(6) NOT NULL,
  `fk_location_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('small','large') NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `senior` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pets`
--

INSERT INTO `pets` (`pet_id`, `name`, `age`, `fk_location_id`, `description`, `image`, `type`, `hobbies`, `senior`) VALUES
(2, 'Sheri', 7, 1, 'Sheri ist unser Opa mit ganz viel Charme.\r\nEr versteht es, die Menschen um den Finger zu wickeln.\r\n\r\nSheri ist ein ruhiger Hundemann, der es gerne gemütlich mag, aber auch nichts gegen weitere Gassirunden einzuwenden hätte.\r\n\r\nSheri mag Katzen, aber keine Hunde.\r\nSheri wird nicht gern am Po berührt!\r\n\r\nWer schenkt ihm ein neues Zuhause?', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Pinscher+Aktiver+Tierschutz+Arche-1920w.jpg', 'small', 'Schlafen, Katzen killen', 'yes'),
(3, 'Luxy', 3, 3, 'Luxy ist eine aufgeweckte Chihuahua Hündin. \r\nSie liebt Menschen und ist leicht vom Kuscheln zu begeistern.\r\n\r\nLuxy kennt andere Hunde und mag sie je nach Sympathie sehr gern!\r\nSie zeigt sich bei uns auch mit Katzen verträglich.\r\n\r\nKinder findet sie auch toll!\r\n\r\nWer schenkt Luxy ein liebevolles Zuhause?', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Luxy+Aktiver+Tierschutz+Arche+Noah-1920w.jpg', 'small', 'Laufen, Schlafen', 'no'),
(4, 'Sammy', 12, 3, 'Der kleine, selbstbewusste Rüde ist sehr lebhaft und geht dementsprechend gerne spazieren/ laufen. \r\n\r\nBei anderen Hunden entscheidet die Sympathie, wobei gemeinsame Spaziergänge meist kein Problem sind.\r\n\r\nSamy jagt für sein Leben gerne und sollte deshalb nicht in einen Haushalt mit Katzen kommen.\r\n\r\nIhm vertrauten Menschen zeigt er sich sehr freundlich, verspielt & schmusebedürftig.\r\n\r\nEr bringt uns sehr oft zum Lachen, wenn er seine kleinen Kunststücke (wie z.b. Männchen machen) vollführt.\r\n\r\nWenn er die Streicheleinheiten sehr genießt, fängt er zu \"reden\" an und grummelt vor sich hin.\r\n\r\nSamy würde sich über ein ruhiges Zuhause in einer ländlichen Gegend, bei hundeerfahrenen Menschen freuen, die viel mit ihm unternehmen.\r\n\r\nSamy hat schon mal gebissen!', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Samy-1920w.jpg', 'small', 'Bellen, Beissen', 'yes'),
(5, 'Fuzzy', 25, 4, 'Fuzzy (ca. 83 cm) verlor gemeinsam mit Welshponystute Sunny sein Zuhause, nachdem seine Weide verkauft wurde. Der selbstbewusste, freche Ponywallach büxst gerne mal aus, ist aber total verschmust - ein Teddybär auf Hufen. Laut Vorbesitzer wurde er früher auch geritten und gefahren.\r\n\r\nFuzzy hat schwere Hufrehe!', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Fuzzy_Pony_Aktiver+Tierschutz_Tierheim+Arche+Noah_Pferdehilfe-1920w.jpg', 'large', 'Essen, Laufen', 'yes'),
(6, 'Max', 28, 3, 'Der kleine Shetlandponywallach Max (100 cm) ist zwar schon sehr grau, aber noch lange nicht vom alten Eisen! Er kam zu uns, da seine Vorbesitzer bei der Haltung nachgelassen hatte. Seit er bei uns ist fühlt sich der kleine Rappschecke in seiner Ponyherde sehr wohl und genießt das Rentnerdasein in vollen Zügen. Er ist ein überaus freundliches Pony und fast gar nicht neugierig ;)\r\n\r\nOft kämpft er mit Verdauungsproblemen und starkem Durchfall!', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Max_Pony_Aktiver+Tierschutz_Tierheim+Arche+Noah_Pferdehilfe-1920w.jpg', 'large', 'Neugierig sein, Galoppieren', 'yes'),
(7, 'Ikarus', 26, 1, 'Ikarus ist Menschen gegenüber sehr brav und genießt seine Streicheleinheiten. Im Herdenverband fällt es dem hübschen Traber allerdings eher schwer sich zu integrieren. Der Wallach stellt sich meist abseits hin und bleibt lieber für sich. Ikarus war früher genauso wie Baby und Lassie auf der Trabrennbahn und genießt nun sein ruhiges Leben auf der Weide.\r\n', 'https://le-cdn.website-editor.net/118799c32fc04ceaa47db937f8c3ed99/dms3rep/multi/opt/Ikarus_Gro-C3-9Fpferd_Aktiver%2BTierschutz_Tierheim%2BArche%2BNoah_Pferdehilfe-1920w.JPG', 'large', 'Schön sein, Wiehern', 'yes'),
(11, 'Pferdinand', 17, 3, 'Hello i bims, 1 nices Pferd', 'Kein Foto, zu hässlich', 'large', 'nix', 'yes'),
(12, 'Test', 57, 2, 'Hello i bims eins Patrick', 'kein foto weil zu hübsch', 'large', 'schlafen', 'no'),
(13, 'Pikachu', 6, 3, 'Pika pika!', 'No Photo', 'small', 'Messing with electricity', 'no');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `permissions` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `email`, `pwd`, `permissions`) VALUES
(3, 'Sanja', '   Hoebenreich', 'shoebenreich', 'sanja@gmx.at', '6fda75ff9f5d77b2fd30b953c7958c681e939aae42d77fbfa55e9af7a7d04a63', 'superadmin'),
(4, 'test', ' test', 'Test', 'test@a.at', '54de7f606f2523cba8efac173fab42fb7f59d56ceff974c8fdb7342cf2cfe345', 'user'),
(5, 'Super', ' Admin', 'superadmin', 'sadmin@b.at', '0fadf52a4580cfebb99e61162139af3d3a6403c1d36b83e4962b721d1c8cbd0b', 'user'),
(6, 'milos', '   Hrcak', 'HELOOOOO', 'm@a.at', '54de7f606f2523cba8efac173fab42fb7f59d56ceff974c8fdb7342cf2cfe345', 'user'),
(23, 'Patrick', 'M', 'PatrickM', 'patrick@m.at', '0fadf52a4580cfebb99e61162139af3d3a6403c1d36b83e4962b721d1c8cbd0b', 'admin');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indizes für die Tabelle `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `fk_location_id` (`fk_location_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`fk_location_id`) REFERENCES `locations` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

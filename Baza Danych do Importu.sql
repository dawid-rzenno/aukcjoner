-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Gru 2018, 23:17
-- Wersja serwera: 10.1.35-MariaDB
-- Wersja PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aukcjoner`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auctiondata`
--

CREATE TABLE `auctiondata` (
  `Identyfikator` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `price` decimal(19,4) DEFAULT '0.0000',
  `seller` varchar(255) DEFAULT NULL,
  `buyer` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL,
  `auctionState` text CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `category` text CHARACTER SET cp1250 COLLATE cp1250_polish_ci NOT NULL
) ENGINE=Aria DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `auctiondata`
--

INSERT INTO `auctiondata` (`Identyfikator`, `title`, `description`, `price`, `seller`, `buyer`, `auctionState`, `category`) VALUES
(114, 'SamochÃ³d ', 'BMW E46 330 Ci lift 3.0 Coupe Individual m pakiet LPG Harman Xenon', '22000.0000', 'user_5', '', '', 'motoryzacja'),
(115, 'BMW ', 'Dane techniczne BMW Seria 5 E60. Moc silnikÃ³w 163â€“507 KM. PojemnoÅ›Ä‡ silnikÃ³w 2,0â€“5,0 l. PrÄ™dkoÅ›Ä‡ maksymalna 218â€“313 km/h. Przyspieszenie 0-100 4s', '30000.0000', 'user_5', '', '', 'moda'),
(116, 'KsiÄ…Å¼ka o podÅ›wiadomoÅ›ci', 'Dan Ariely\r\nPotÄ™ga irracjonalnoÅ›ci. Ukryte siÅ‚y, ktÃ³re wpÅ‚ywajÄ… na nasze Å¼ycie', '20.0000', 'user_5', '', '', 'moda'),
(117, 'Kilka ksiÄ…Å¼ek', 'Daniel Kahneman\r\nPuÅ‚apki myÅ›lenia. O myÅ›leniu szybkim i wolnym\r\n\r\nDaniel Kahneman\r\nPuÅ‚apki myÅ›lenia. O myÅ›leniu szybkim i wolnym', '40.0000', 'user_3', '', '', 'kultura');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logindata`
--

CREATE TABLE `logindata` (
  `Identyfikator` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=Aria DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logindata`
--

INSERT INTO `logindata` (`Identyfikator`, `login`, `password`) VALUES
(124, 'user_1', 'password'),
(125, 'user_2', 'password'),
(126, 'user_3', 'password'),
(127, 'user_4', 'password'),
(128, 'user_5', 'password');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userdata`
--

CREATE TABLE `userdata` (
  `Identyfikator` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `saldo` decimal(19,4) DEFAULT '0.0000',
  `email` varchar(255) DEFAULT NULL,
  `name` text NOT NULL,
  `auctionsCount` int(11) NOT NULL
) ENGINE=Aria DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `userdata`
--

INSERT INTO `userdata` (`Identyfikator`, `login`, `saldo`, `email`, `name`, `auctionsCount`) VALUES
(124, 'user_1', '0.0000', 'jankowalski@gmail.com', 'Jan Kowalski', 0),
(125, 'user_2', '0.0000', 'janwisniewski@gmail.com', 'Jan WiÅ›niewski', 0),
(126, 'user_3', '0.0000', 'tomaszwisniewski@gmail.com', 'Tomasz WiÅ›niewski', 1),
(127, 'user_4', '0.0000', 'franekdolor@gmail.com', 'Franek Dolor', 0),
(128, 'user_5', '0.0000', 'dorotaDG@gmail.com', 'Dorota Dolor-Grzyb', 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auctiondata`
--
ALTER TABLE `auctiondata`
  ADD PRIMARY KEY (`Identyfikator`);

--
-- Indeksy dla tabeli `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`Identyfikator`);

--
-- Indeksy dla tabeli `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`Identyfikator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `auctiondata`
--
ALTER TABLE `auctiondata`
  MODIFY `Identyfikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT dla tabeli `logindata`
--
ALTER TABLE `logindata`
  MODIFY `Identyfikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT dla tabeli `userdata`
--
ALTER TABLE `userdata`
  MODIFY `Identyfikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2021, 14:20
-- Wersja serwera: 10.1.34-MariaDB
-- Wersja PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `debuttrainer`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `debuts`
--

CREATE TABLE `debuts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `author` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `sequence` varchar(300) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `debuts`
--

INSERT INTO `debuts` (`id`, `name`, `author`, `sequence`) VALUES
(1, 'lozko', NULL, '51,35,11,27,50,34,10,26,'),
(2, 'Mój nowy debiut', NULL, '51,35,11,19,50,34,10,26,57,42,26,26,14,22,62,45,5,14,58,37,2,11,42,27,9,25,52,44,'),
(3, 'łóżko', NULL, '51,35,11,27,'),
(4, '\'TRUNCATE TABLE debiuts; --', NULL, '51,35,11,27,'),
(5, '\'exit();', NULL, '52,36,11,27,'),
(6, 'uuu', NULL, '52,44,11,19,'),
(7, 'aaa', NULL, '51,43,11,19,'),
(8, 'a', NULL, '51,43,11,19,'),
(9, 'noga', NULL, '52,36,11,27,36,27,3,27,'),
(10, 'rrr', NULL, '51,35,12,28,35,28,1,18,'),
(11, 'aaa', NULL, '52,36,11,27,36,27,3,27,'),
(12, 'Jas', NULL, '52,44,11,19,'),
(13, 'aaa', 'DUPA', '51,43,12,20,'),
(14, 'gtgfgfgfg', 'Pawel', '51,43,12,20,'),
(15, 'nmnmnv', 'Pawel', '51,43,12,20,');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `pasword` varchar(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `mail`, `pasword`, `score`) VALUES
(1, 'Pawel', 'p.a.krzyzanowski@gmail.com', '123', 0),
(2, 'Piotr', 'piotruspan2@gmail.com', '123', 0),
(3, 'Pablo1', 'pablo@gmail.com', 'haslo1', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `debuts`
--
ALTER TABLE `debuts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `debuts`
--
ALTER TABLE `debuts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

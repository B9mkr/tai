-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 23 Sty 2020, 23:42
-- Wersja serwera: 10.4.10-MariaDB
-- Wersja PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Post`
--

CREATE TABLE `Post` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `tag` varchar(40) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `post_full_image` varchar(50) NOT NULL,
  `access` varchar(2) NOT NULL,
  `content` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Post`
--

INSERT INTO `Post` (`id_post`, `id_user`, `title`, `datetime`, `tag`, `opis`, `post_full_image`, `access`, `content`) VALUES
(5, 1, 'Baza Danych', '2020-01-18', 'bd', 'Bazy Dannych laboratorium numer 10 access: 61', 'img/standard/f', '61', 'md/BD/Lab10.md'),
(11, 1, 'RAID', '2020-01-21', 'bsi', 'Notatki z wykładu dnia 21 access: 64', 'img/standard/f', '64', 'md/BSI/wyk/21,01.md'),
(15, 1, 'Baza danych kolos', '2020-01-21', 'bd', 'Przygotowania do kolosu access: 66', 'img/standard/f', '66', 'md/BD/K2.md');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Session`
--

CREATE TABLE `Session` (
  `id_session` varchar(100) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE `User` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `img` varchar(50) NOT NULL DEFAULT 'img/anon.jpg',
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `passwd` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `img`, `status`, `passwd`) VALUES
(1, 'Borys', 'mushkaborys@gmail.com', '2020-01-23', 'img/mf.jpg', 1, 'c4ca4238a0b923820dcc509a6f75849b'),
(8, 'Test 4', 't4@mail.com', '2020-01-18', 'img/map.jpg', 1, 'd41d8cd98f00b204e9800998ecf8427e'),
(15, 'admin', 'admin@admin.com', '2020-01-20', 'img/admin.png', 0, '21232f297a57a5a743894a0e4a801fc3');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `Session_ibfk_2` (`id_user`);

--
-- Indeksy dla tabeli `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `Post`
--
ALTER TABLE `Post`
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `User`
--
ALTER TABLE `User`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Session`
--
ALTER TABLE `Session`
  ADD CONSTRAINT `Session_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

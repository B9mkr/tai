# ts

1. tworzenie stron z plików .md
2. strona logowania userów
   1. datetime
   2. tag
   3. post-full-title
   4. post-fuul-image
      1. 300
      2. 1000
      3. 2000
   5. content
3. user
   1. id
   2. username
   3. email
   4. date
   5. status
   6. passwd
4. strona ustawień dla usera
   1. ciemna tema
   2. zmiana dannych
5. generowanie stron
6. lista zadań

```sql
CREATE TABLE IF NOT EXISTS `User` (
    `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` varchar(40) NOT NULL,
    `email` varchar(11) NOT NULL,
    `date` date NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 2,
    `passwd` varchar(60) NOT NULL,
    PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

```sql
CREATE TABLE IF NOT EXISTS `Posts` (
    `id_posts` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_user` int(10) UNSIGNED NOT NULL,
    `datetime` date NOT NULL,
    `tag` varchar(40) NOT NULL,
    `post-full-title` varchar(20) NOT NULL,
    `post-full-image` varchar(50) NOT NULL,
    `content` varchar(60) NOT NULL,
    PRIMARY KEY (`id_posts`),
    KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
```

```sql
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Baza danych: `politechnika`
-- 

-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `egzaminy`
-- 

DROP TABLE IF EXISTS `egzaminy`;
CREATE TABLE IF NOT EXISTS `egzaminy` (
  `nr-egz` smallint(5) unsigned NOT NULL auto_increment,
  `id-student` varchar(7) NOT NULL,
  `id-przedmiot` tinyint(3) unsigned NOT NULL,
  `id-wykladowca` varchar(4) NOT NULL,
  `data` date NOT NULL,
  `id-osrodek` tinyint(3) unsigned NOT NULL,
  `zdal` tinyint(1) NOT NULL,
  PRIMARY KEY  (`nr-egz`),
  KEY `id-student` (`id-student`),
  KEY `id-przedmiot` (`id-przedmiot`),
  KEY `id-wykladowca` (`id-wykladowca`),
  KEY `id-osrodek` (`id-osrodek`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- 
-- Zrzut danych tabeli `egzaminy`
-- 

INSERT INTO `egzaminy` (`nr-egz`, `id-student`, `id-przedmiot`, `id-wykladowca`, `data`, `id-osrodek`, `zdal`) VALUES 
(1, '0011048', 1, '0004', '1997-12-09', 1, 1),
(78, '0800700', 9, '0012', '2002-03-20', 11, 1);

-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `osrodki`
-- 

DROP TABLE IF EXISTS `osrodki`;
CREATE TABLE IF NOT EXISTS `osrodki` (
  `id-osrodek` tinyint(3) unsigned NOT NULL auto_increment,
  `nazwa-o` varchar(255) NOT NULL,
  `kod-poczta` varchar(5) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `ulica` varchar(50) NOT NULL,
  `numer` varchar(8) NOT NULL,
  PRIMARY KEY  (`id-osrodek`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Zrzut danych tabeli `osrodki`
-- 

INSERT INTO `osrodki` (`id-osrodek`, `nazwa-o`, `kod-poczta`, `miasto`, `ulica`, `numer`) VALUES 
(1, 'Instytut Informatyki PL', '20618', 'Lublin', 'Nadbystrzycka', '36B'),
(15, 'Biblioteka im. prof. Wiktora Wektora', '37420', 'Józefów', 'Gwoździowa', '9');

-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `przedmioty`
-- 

DROP TABLE IF EXISTS `przedmioty`;
CREATE TABLE IF NOT EXISTS `przedmioty` (
  `id-przedmiot` tinyint(3) unsigned NOT NULL auto_increment,
  `nazwa-p` varchar(40) NOT NULL,
  `opis` varchar(200) NOT NULL,
  PRIMARY KEY  (`id-przedmiot`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Zrzut danych tabeli `przedmioty`
-- 

INSERT INTO `przedmioty` (`id-przedmiot`, `nazwa-p`, `opis`) VALUES 
(1, 'Podstawy technik informatycznych', 'Moduł ten sprawdza znajomość kluczowych pojęć dotyczących użytkowania komputerów i wykorzystania ich w społeczeństwie.'),
(11, 'Języki czwartej generacji', '');

-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `studenci`
-- 

DROP TABLE IF EXISTS `studenci`;
CREATE TABLE IF NOT EXISTS `studenci` (
  `id-student` varchar(7) NOT NULL,
  `nazwisko` varchar(25) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `data-ur` date NOT NULL,
  `miejsce` varchar(15) NOT NULL,
  `PESEL` varchar(11) NOT NULL,
  `kod-poczta` varchar(5) NOT NULL,
  `miasto` varchar(15) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `numer` varchar(8) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `e-mail` varchar(30) NOT NULL,
  `nr-dyplomu` varchar(9) NOT NULL,
  `data-dyplomu` date NOT NULL,
  PRIMARY KEY  (`id-student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Zrzut danych tabeli `studenci`
-- 

INSERT INTO `studenci` (`id-student`, `nazwisko`, `imie`, `data-ur`, `miejsce`, `PESEL`, `kod-poczta`, `miasto`, `ulica`, `numer`, `tel`, `fax`, `e-mail`, `nr-dyplomu`, `data-dyplomu`) VALUES 
('0000050', 'Sobich', 'Katarzyna', '1976-05-20', 'Lubartów', '20053694185', '21850', 'Lubartów', 'Długa', '5', '', '', '', '', '0000-00-00'),
('1002001', 'Mędrzak', 'Tomasz', '1970-05-03', 'Tarnów', '70050316987', '39210', 'Pilzno', 'Krakowska', '22', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

-- 
-- Struktura tabeli dla  `wykladowcy`
-- 

DROP TABLE IF EXISTS `wykladowcy`;
CREATE TABLE IF NOT EXISTS `wykladowcy` (
  `id-wykladowcy` varchar(4) NOT NULL,
  `nazwisko` varchar(25) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `kod-poczta` varchar(5) NOT NULL,
  `miasto` varchar(15) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `numer` varchar(8) NOT NULL,
  `telefon` varchar(12) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `e-mail` varchar(30) NOT NULL,
  PRIMARY KEY  (`id-wykladowcy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Zrzut danych tabeli `wykladowcy`
-- 

INSERT INTO `wykladowcy` (`id-wykladowcy`, `nazwisko`, `imie`, `kod-poczta`, `miasto`, `ulica`, `numer`, `telefon`, `fax`, `e-mail`) VALUES 
('0001', 'Miłosz', 'Marek', '20610', 'Lublin', 'Piękna', '10', '815252046', '815252046', 'marekm@pluton.pol.lublin.pl'),
('0014', 'Wektor', 'Wiktor', '35850', 'Krosno', 'Ogrodnicza', '19', '555155666', '', '');

-- 
-- Ograniczenia dla zrzutów tabel
-- 

-- 
-- Ograniczenia dla tabeli `egzaminy`
-- 
ALTER TABLE `egzaminy`
  ADD CONSTRAINT `egzaminy_ibfk_4` FOREIGN KEY (`id-osrodek`) REFERENCES `osrodki` (`id-osrodek`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egzaminy_ibfk_1` FOREIGN KEY (`id-student`) REFERENCES `studenci` (`id-student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egzaminy_ibfk_2` FOREIGN KEY (`id-przedmiot`) REFERENCES `przedmioty` (`id-przedmiot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egzaminy_ibfk_3` FOREIGN KEY (`id-wykladowca`) REFERENCES `wykladowcy` (`id-wykladowcy`) ON DELETE CASCADE ON UPDATE CASCADE;
```
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
  `post_full_title` varchar(50) NOT NULL,
  `post_full_image` varchar(50) NOT NULL,
  `access` varchar(2) NOT NULL,
  `content` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Post`
--

INSERT INTO `Post` (`id_post`, `id_user`, `title`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES
(1, 1, 'inf', '2020-01-10', 'information', 'ts', 'img/standard/f', '66', 'inf.md'),
(2, 2, 'Text', '2020-01-12', 'test', 'Text', 'img/generator/intGen', '66', 'md/text.md'),
(3, 3, 'inf', '2020-01-10', 'information', 'Karken info', 'img/standard/f', '66', 'inf.md'),
(4, 8, 'Sieci rozproszone', '2020-01-12', 'sieci', 'Sieci gotowiec', 'img/standard/f', '66', 'md/sieci_gotowiec.md');

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
(1, 'borys', 'mushkaborys@gmail.com', '2020-01-11', 'img/mf.jpg', 1, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, '', '', '2020-01-11', 'img/anon.jpg', 2, 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'Test', 'test@gmail.com', '2020-01-16', 'img/anon.jpg', 1, '098f6bcd4621d373cade4e832627b4f6'),
(4, 'nijak', 'nijak228@gmail.som', '2020-01-16', 'img/anon.jpg', 1, 'd70eefe1dd6b25d4f34ebf38ba048f7e'),
(6, 'Test2', 't2@g.c', '2020-01-17', 'img/anon.jpg', 1, 'c454552d52d55d3ef56408742887362b'),
(8, 'Test4', 't4@g.c', '2020-01-17', 'img/anon.jpg', 1, 'd41d8cd98f00b204e9800998ecf8427e'),
(9, 'Test5', 't5@g.c', '2020-01-17', 'img/anon.jpg', 1, '78ef53e38c997c445f2fe1cc63c13139'),
(10, 'Test6', 't6@g.c', '2020-01-17', 'img/anon.jpg', 1, 'e1f75a2453752a17e6ede4e274804987'),
(11, 'Test7', 't7@g.c', '2020-01-17', 'img/anon.jpg', 1, 'f178860b5109214d9f3debe19a7800d3');

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
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT dla tabeli `User`
--
ALTER TABLE `User`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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
```

-- access:
-- 4-r, 2-w, 1-NULL, 6-rw
-- user, all:

44
42
41
46

24
22
21
26

14
12
11
16

64
62
61
66

# ts

1. tworzenie stron z plików .md
2. strona logowania userów
   1. datetime
   2. tag
   3. opis
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

# Baza

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
  `post` varchar(255) NOT NULL,
  `post_full_image` varchar(50) NOT NULL,
  `access` varchar(2) NOT NULL,
  `content` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ALTER TABLE Post MODIFY post_full_title varchar(255) NOT NULL;

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

---

# co zostało do robić:

##### 1.

-- access:
-- 4-r, 2-w, 1-NULL, 6-rw
-- user, all:

> 44, 42, 41, 46
>
> 24, 22, 21, 26
>
> 14, 12, 11, 16
>
> 64, 62, 61, 66

posts:

> 66 -> get_access_for(1) = 6
> 64 -> get_access_for(1) = 4
> 62 -> get_access_for(1) = 2
> 61 -> get_access_for(1) = 1

> 66 -> get_access_for(0) = 6
> 64 -> get_access_for(0) = 6
> 62 -> get_access_for(0) = 6
> 61 -> get_access_for(0) = 6

```
object(stdClass)#12 (9) 
{
  ["id_post"]=> string(1) "2" 
  ["id_user"]=> string(1) "2" 
  ["title"]=> string(4) "Text" 
  ["datetime"]=> string(10) "2020-01-12" 
  ["tag"]=> string(4) "test" 
  ["opis"]=> string(4) "Text" 
  ["post_full_image"]=> string(20) "img/generator/intGen" 
  ["access"]=> string(2) "66" 
  ["content"]=> string(10) "md/text.md" 
} 
object(stdClass)#11 (9) 
{ 
  ["id_post"]=> string(1) "3" 
  ["id_user"]=> string(1) "3" 
  ["title"]=> string(3) "inf" 
  ["datetime"]=> string(10) "2020-01-10" 
  ["tag"]=> string(11) "information" 
  ["opis"]=> string(11) "Karken info" 
  ["post_full_image"]=> string(14) "img/standard/f" 
  ["access"]=> string(2) "66" 
  ["content"]=> string(6) "inf.md" 
} 
...
```

##### 2.

Walidacja dla posta **email**.

```php
<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>

// plytki
<svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
<path d="M7.228,11.464H1.996c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
    c0.723,0,1.308-0.586,1.308-1.308v-5.232C8.536,12.051,7.95,11.464,7.228,11.464z M7.228,17.351c0,0.361-0.293,0.654-0.654,0.654
    H2.649c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
        M17.692,11.464H12.46c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
    c0.722,0,1.308-0.586,1.308-1.308v-5.232C19,12.051,18.414,11.464,17.692,11.464z M17.692,17.351c0,0.361-0.293,0.654-0.654,0.654
    h-3.924c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.293-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
        M7.228,1H1.996C1.273,1,0.688,1.585,0.688,2.308V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232c0.723,0,1.308-0.585,1.308-1.308
    V2.308C8.536,1.585,7.95,1,7.228,1z M7.228,6.886c0,0.361-0.293,0.654-0.654,0.654H2.649c-0.361,0-0.654-0.292-0.654-0.654V2.962
    c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.292,0.654,0.654V6.886z M17.692,1H12.46c-0.723,0-1.308,0.585-1.308,1.308
    V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232C18.414,8.848,19,8.263,19,7.54V2.308C19,1.585,18.414,1,17.692,1z M17.692,6.886
    c0,0.361-0.293,0.654-0.654,0.654h-3.924c-0.361,0-0.654-0.292-0.654-0.654V2.962c0-0.361,0.293-0.654,0.654-0.654h3.924
    c0.361,0,0.654,0.292,0.654,0.654V6.886z"></path></svg>

// plus
<svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
    <path d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
        c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
        v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
        c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
        c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
        z"></path>
</svg>

// edycja
<svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
    <path d="M15.808,14.066H6.516v-1.162H5.354v1.162H4.193c-0.321,0-0.581,0.26-0.581,0.58s0.26,0.58,0.581,0.58h1.162
        v1.162h1.162v-1.162h9.292c0.32,0,0.58-0.26,0.58-0.58S16.128,14.066,15.808,14.066z M15.808,9.419h-1.742V8.258h-1.162v1.161
        h-8.71c-0.321,0-0.581,0.26-0.581,0.581c0,0.321,0.26,0.581,0.581,0.581h8.71v1.161h1.162v-1.161h1.742
        c0.32,0,0.58-0.26,0.58-0.581C16.388,9.679,16.128,9.419,15.808,9.419z M17.55,0.708H2.451c-0.962,0-1.742,0.78-1.742,1.742v15.1
        c0,0.961,0.78,1.74,1.742,1.74H17.55c0.962,0,1.742-0.779,1.742-1.74v-15.1C19.292,1.488,18.512,0.708,17.55,0.708z M18.13,17.551
        c0,0.32-0.26,0.58-0.58,0.58H2.451c-0.321,0-0.581-0.26-0.581-0.58v-15.1c0-0.321,0.26-0.581,0.581-0.581H17.55
        c0.32,0,0.58,0.26,0.58,0.581V17.551z M15.808,4.774H9.419V3.612H8.258v1.162H4.193c-0.321,0-0.581,0.26-0.581,0.581
        s0.26,0.581,0.581,0.581h4.065v1.162h1.161V5.935h6.388c0.32,0,0.58-0.26,0.58-0.581S16.128,4.774,15.808,4.774z"></path>
</svg>

// smiecie
<svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
    <path d="M7.083,8.25H5.917v7h1.167V8.25z M18.75,3h-5.834V1.25c0-0.323-0.262-0.583-0.582-0.583H7.667
        c-0.322,0-0.583,0.261-0.583,0.583V3H1.25C0.928,3,0.667,3.261,0.667,3.583c0,0.323,0.261,0.583,0.583,0.583h1.167v14
        c0,0.644,0.522,1.166,1.167,1.166h12.833c0.645,0,1.168-0.522,1.168-1.166v-14h1.166c0.322,0,0.584-0.261,0.584-0.583
        C19.334,3.261,19.072,3,18.75,3z M8.25,1.833h3.5V3h-3.5V1.833z M16.416,17.584c0,0.322-0.262,0.583-0.582,0.583H4.167
        c-0.322,0-0.583-0.261-0.583-0.583V4.167h12.833V17.584z M14.084,8.25h-1.168v7h1.168V8.25z M10.583,7.083H9.417v8.167h1.167V7.083
        z"></path>
</svg>

// sun // <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece"><path d="M5.114,5.726c0.169,0.168,0.442,0.168,0.611,0c0.168-0.169,0.168-0.442,0-0.61L3.893,3.282c-0.168-0.168-0.442-0.168-0.61,0c-0.169,0.169-0.169,0.442,0,0.611L5.114,5.726z M3.955,10c0-0.239-0.193-0.432-0.432-0.432H0.932C0.693,9.568,0.5,9.761,0.5,10s0.193,0.432,0.432,0.432h2.591C3.761,10.432,3.955,10.239,3.955,10 M10,3.955c0.238,0,0.432-0.193,0.432-0.432v-2.59C10.432,0.693,10.238,0.5,10,0.5S9.568,0.693,9.568,0.932v2.59C9.568,3.762,9.762,3.955,10,3.955 M14.886,5.726l1.832-1.833c0.169-0.168,0.169-0.442,0-0.611c-0.169-0.168-0.442-0.168-0.61,0l-1.833,1.833c-0.169,0.168-0.169,0.441,0,0.61C14.443,5.894,14.717,5.894,14.886,5.726 M5.114,14.274l-1.832,1.833c-0.169,0.168-0.169,0.441,0,0.61c0.168,0.169,0.442,0.169,0.61,0l1.833-1.832c0.168-0.169,0.168-0.442,0-0.611C5.557,14.106,5.283,14.106,5.114,14.274 M19.068,9.568h-2.591c-0.238,0-0.433,0.193-0.433,0.432s0.194,0.432,0.433,0.432h2.591c0.238,0,0.432-0.193,0.432-0.432S19.307,9.568,19.068,9.568 M14.886,14.274c-0.169-0.168-0.442-0.168-0.611,0c-0.169,0.169-0.169,0.442,0,0.611l1.833,1.832c0.168,0.169,0.441,0.169,0.61,0s0.169-0.442,0-0.61L14.886,14.274z M10,4.818c-2.861,0-5.182,2.32-5.182,5.182c0,2.862,2.321,5.182,5.182,5.182s5.182-2.319,5.182-5.182C15.182,7.139,12.861,4.818,10,4.818M10,14.318c-2.385,0-4.318-1.934-4.318-4.318c0-2.385,1.933-4.318,4.318-4.318c2.386,0,4.318,1.933,4.318,4.318C14.318,12.385,12.386,14.318,10,14.318 M10,16.045c-0.238,0-0.432,0.193-0.432,0.433v2.591c0,0.238,0.194,0.432,0.432,0.432s0.432-0.193,0.432-0.432v-2.591C10.432,16.238,10.238,16.045,10,16.045"></path></svg>

// moon// <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece"><path d="M10.544,8.717l1.166-0.855l1.166,0.855l-0.467-1.399l1.012-0.778h-1.244L11.71,5.297l-0.466,1.244H10l1.011,0.778L10.544,8.717z M15.986,9.572l-0.467,1.244h-1.244l1.011,0.777l-0.467,1.4l1.167-0.855l1.165,0.855l-0.466-1.4l1.011-0.777h-1.244L15.986,9.572z M7.007,6.552c0-2.259,0.795-4.33,2.117-5.955C4.34,1.042,0.594,5.07,0.594,9.98c0,5.207,4.211,9.426,9.406,9.426c2.94,0,5.972-1.354,7.696-3.472c-0.289,0.026-0.987,0.044-1.283,0.044C11.219,15.979,7.007,11.759,7.007,6.552 M10,18.55c-4.715,0-8.551-3.845-8.551-8.57c0-3.783,2.407-6.999,5.842-8.131C6.549,3.295,6.152,4.911,6.152,6.552c0,5.368,4.125,9.788,9.365,10.245C13.972,17.893,11.973,18.55,10,18.55 M19.406,2.304h-1.71l-0.642-1.71l-0.642,1.71h-1.71l1.39,1.069l-0.642,1.924l1.604-1.176l1.604,1.176l-0.642-1.924L19.406,2.304z"></path></svg>
```

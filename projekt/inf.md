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
    `email` varchar(50) NOT NULL,
    `date` date NOT NULL,
    `img` varchar(50) NOT NULL DEFAULT "img/anon.jpg",
    `status` tinyint(1) NOT NULL DEFAULT 2,
    `passwd` varchar(60) NOT NULL,
    PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `img`, `status`, `passwd`) VALUES 
(1, 'borys', 'mushkaborys@gmail.com', '2020-01-15', 'img/mf.jpg', '1', 'c4ca4238a0b923820dcc509a6f75849b')
(2, 'test', 'test@gmail.com', '2020-01-11', 'img/anon.jpg', '1', '098F6BCD4621D373CADE4E832627B4F6');

CREATE TABLE IF NOT EXISTS `Post` (
    `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_user` int(10) UNSIGNED NOT NULL,
    `title` varchar(50) NOT NULL,
    `datetime` date NOT NULL,
    `tag` varchar(40) NOT NULL,
    `post_full_title` varchar(50) NOT NULL,
    `post_full_image` varchar(50) NOT NULL,
    `access` varchar(2) NOT NULL,
    `content` varchar(60) NOT NULL,
    PRIMARY KEY (`id_post`),
    KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Post` (`id_post`, `id_user`, `title`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES 
(1, '1', 'Test', '2020-01-06', 'information', 'Test info', 'img/standard/f', '66', 'md/text.md'),
(2, '1', 'inf', '2020-01-10', 'information', 'inf', 'img/standard/f', '66', 'inf.md'),
(3, '1', 'Text', '2020-01-09', 'text', 'text', 'img/generator/intGen', '66', 'md/text.md');

ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;


```
-- INSERT INTO `Post` (`id_post`, `id_user`, `title`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES 
-- (NULL, '', '', '', '', '', '', '', '');

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

---

strona:

$s_head_title 65
$s_head_css 68
$s_header_title 90
143
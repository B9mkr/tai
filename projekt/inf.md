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

-- INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `status`, `paswd`) VALUES 
-- (NULL, '', '', '', 2, '');

CREATE TABLE IF NOT EXISTS `Post` (
    `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_user` int(10) UNSIGNED NOT NULL,
    `datetime` date NOT NULL,
    `tag` varchar(40) NOT NULL,
    `post_full_title` varchar(20) NOT NULL,
    `post_full_image` varchar(50) NOT NULL,
    `access` int(2) NOT NULL,
    `content` varchar(60) NOT NULL,
    PRIMARY KEY (`id_post`),
    KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- INSERT INTO `Post` (`id_post`, `id_user`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES 
-- (NULL, '', '', '', '', '', '', '');

-- access:
-- 4-r, 2-w, 0, 6-rw
-- user, all:

ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;


```
44
22
0 00
42
40
24
20
4 04
2 02
46
64
26
62
60
6 06
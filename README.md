# tai

## lab2

## lab3

---

## lab4

### funkcje.php

1. [drukuj_form()](####drukuj_form())
2. [dodaj()](####dodaj())
3. [walidajca($nazwa_pliku)](####walidajca($nazwa_pliku))
4. [dopliku($nazwa_plikku, $tablicaDanych)](####dopliku($nazwa_plikku,\ $tablicaDanych))
5. [pokaz()](####pokaz())
6. [pokazm($liniao)](####pokazm($liniao))
7. [generowanieTablicy($liniao)](####generowanieTablicy($liniao))
8. create_dane()
9. create_line($dane)
10. create_line_filtr($dane)

#### drukuj_form()

Drukuje formularz którzy składa się z takich pól:

* Nazwisko
* Wiek
* Państwo
  * Polska
  * Niemcy
  * Wielka Brytania
  * Czechy
  * Moldawia
* Adres e-mail
* Zamawiam tutorial z jęsyka:
  * PHP  
  * C/C++  
  * Java
* Sposób zapłaty:
  * eurocard
  * visa  
  * przelew bankowy

\+ przyciski:

* reset
* Dodaj
* Pokaz
* Statystyki

#### dodaj()

Dodaje do pliku z nazwą "dane.txt" dane z formularza.

#### walidajca($nazwa_pliku)

Filtruje dane podane z formularza.

#### dopliku($nazwa_plikku, $tablicaDanych)

Zaposuje do pliku($nazwa_pliku) dane z tablicy($tablicaDanych).

#### pokaz()

Pokazuje dane z pliku "dane.txt" w formacie:

> ...

#### pokazm($liniao)

#### generowanieTablicy($liniao)

#### create_dane()

#### create_line($dane)

#### create_line_filtr($dane)

Tworzy z tablicy dannych($dane) po formatowaniu ciąg znaków w formacie:

> ('Nazwisko', 'wiek', 'Wielka Brytania', 'nazwisko@gmail.com', 'C,Java', 'Visa');

```php
$ar = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
echo implode($ar); // abcdefg
```

---

napisać apolikację do obslugi wypożyczalni samochodów. 

Stona główna aplikcaji udostępnia trzy przyciski: pokaż, Wybierz, dodaj

Y - Przycisk Pokaz wyświetla informacje o wszystkich dostępnych w bazie samochodach.
Każda pozycja zawiera pola: ...

N - Przycisk dodaj wyświetla formularz do wprowadzenia nowego auto do bazy.

Y - Przycisk wybierz usostępnia pole formularza do wprowadzenia marki
Y - a następnie wyświelta wszystkie samochody dane marki z bazy. 

przyciski: 
* pokaż
* Wybierz,
* dodaj

pola:
* nr_reg, 
* marka, 
* rocznik,
* przebieg. 

Pierwsze uruchomienie aplikacji działanie przycisku Pokaz.
Konieczna jest walidcja danych przed zapisem (przeferowane filtry).
Wskazanie jest wykorzystanie klas pomocniczych.
```sql
CREATE TABLE IF NOT EXISTS `samochody` (
    `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nr_reg` varchar(40) NOT NULL ,
    `marka` varchar(40) NOT NULL ,
    `rocznik` varchar(40) NOT NULL ,
    `przebieg` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

---

Napisać aplikację do obsługi kont bankowych. Strona główna aplikacji udostępnia trzy przyciski Pokaż, Wybiera, Dodaj. Przycisk Pokaz wyświetla informacje o wszystkich klientah banku z pliku(lub bazy danych). Każda pozycja zawiera pola: nazwisko, PESEL, stan konta, posiadane karty. Przycisk dodaj wyświetla formularz do wprowadzenia peselu a następnie wyświetla dane o wskazanym kliencie. Pierwsze uruchomienie aplikacji dzałanie prycisku Pokaz.
konieczna jest walidacja danych przed zapisem. Wskazane jest wykorzystanie klas pomocniczych.

```php
 $Bar = "a";
$Foo = "Bar";
$World = "Foo";
$Hello = "World";
$a = "Hello";

$a; //Returns Hello
$$a; //Returns World
$$$a; //Returns Foo
$$$$a; //Returns Bar
$$$$$a; //Returns a

$$$$$$a; //Returns Hello
$$$$$$$a; //Returns World

//... and so on ...//
```

```sql
CREATE TABLE IF NOT EXISTS `klienci` (
    `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Nazwisko` varchar(40) NOT NULL ,
    `Wiek` tinyint(3) UNSIGNED NOT NULL,
    `Panstwo` enum('Polska','Niemcy','Wielka Brytania','Czechy') NOT NULL DEFAULT 'Polska',
    `Email` varchar(50) NOT NULL,
    `Zamowienie` set('Java','PHP','CPP') NOT NULL DEFAULT 'PHP',
    `Platnosc` enum('Visa','Master Card','Przelew') NOT NULL DEFAULT 'Visa',
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

```sql
CREATE TABLE IF NOT EXISTS `samochody` (
    `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nr_reg` varchar(40) NOT NULL ,
    `marka` varchar(40) NOT NULL ,
    `rocznik` varchar(40) NOT NULL ,
    `przebieg` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
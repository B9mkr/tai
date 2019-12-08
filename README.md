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

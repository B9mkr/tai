# zadanie

Napisać aplikację do obsługi kont bankowych. 
Strona główna aplikacji udostępnia trzy przyciski Pokaż, Wybiera, Dodaj. 

* Przycisk Pokaz wyświetla informacje o wszystkich klientah banku z pliku(lub bazy danych). 
 Każda pozycja zawiera pola: nazwisko, PESEL, stan konta, posiadane karty. 
* Przycisk dodaj wyświetla formularz do wprowadzenia peselu a następnie wyświetla dane o wskazanym kliencie. 

Pierwsze uruchomienie aplikacji dzałanie prycisku Pokaz.
konieczna jest walidacja danych przed zapisem. Wskazane jest wykorzystanie klas pomocniczych.

## kol

* css
  * style.css
* funkcje
  * Formularz.php
* klasy
  * Baza.php
  * Dane.php
<!-- * szablony -->
* index.php
* information.md

### css
### Formularz.php
### Baza.php
### Dane.php

Klasa w której są taki przywatne pola:

```php
private $nazwa_tabeli;
private $pola_t;//Techniczne
private $pola_d;//Dekoracyjne
private $type;
private $baza;
private $poszuk;
private $action;
private $method;
private $args;
```

Konstruktor nadaje wartości dla wszystnich zmiennych.

Funkcje zwracające wartości prywatnych zmienych:

```php
function get_nazwa_tabeli(){
    return $this->nazwa_tabeli;
}
function get_baza(){
    return $this->baza;
}
function get_poszuk(){
    return $this->poszuk;
}
function get_pola_t(){
    return $this->pola_t;
}
function get_pola_d(){
    return $this->pola_d;
}
function get_action(){
    return $this->action;
}
function get_method(){
    return $this->method;
}
function get_args(){
    return $this->args;
}
function get_type(){
    return $this->type;
}
```

Funkcje jaki przepisują w przywatne zmienne:

```php
function set_nazwa_tabeli($nazwa_tabeli){
    $this->nazwa_tabeli=$nazwa_tabeli;
}
function set_baza($baza){
    $this->baza=$baza;
}
function set_poszuk($poszuk){
    $this->poszuk=$poszuk;
}
function set_pola_t($pola){
    $this->pola_t=$pola;
}
function set_pola_d($pola){
    $this->pola_d=$pola;
}
function set_action($action){
    $this->action=$action;
}
function set_method($method){
    $this->method=$method;
}
function set_args($args){
    $this->args=$args;
}
function set_type($type){
    $this->typ=$type;
}
```

---

### get_pole_t

get_pole_t - Pobiera wartość typu `int` (indexu).

### Opis

```php
get_pole_t ( $i = 0 ) : string
```

Zwraca wartość tablicy w zmienej `$pola_t` o podanym indexie.

### Zwracane dane

Zwraca wartość `$pole_t`. Jeśli niczego nie podawać domyślnie zwraca wartość o zerowym indexie tz. `$pole_t[0]`.

### Przykłady

```php
<?php

//$pola_t=["id","nazwisko","pesel","stan_konta","posiadanie_karty"];

$key = 2;

$tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";

echo $tresc;

$key = -4;

$tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";

echo $tresc;

$key = 30;

$tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";

echo $tresc;
?>
```

Wynikiem wykonywania danego przykładu będzie:

```html
Otrzymasz dla klucza 2 pesel

Otrzymasz dla klucza -4 id

Otrzymasz dla klucza 30 id
```

---

function get_pole_d($i=0)
function get_typ($i=0)
private function create_url()

### index.php

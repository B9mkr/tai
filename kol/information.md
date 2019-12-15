# zadanie

Napisać aplikację do obsługi kont bankowych. 
Strona główna aplikacji udostępnia trzy przyciski Pokaż, Wybiera, Dodaj. 

* Przycisk Pokaz wyświetla informacje o wszystkich klientah banku z pliku(lub bazy danych). 
 Każda pozycja zawiera pola: nazwisko, PESEL, stan konta, posiadane karty. 
* Przycisk dodaj wyświetla formularz do wprowadzenia peselu a następnie wyświetla dane o wskazanym kliencie. 

Pierwsze uruchomienie aplikacji dzałanie prycisku Pokaz.
konieczna jest walidacja danych przed zapisem. Wskazane jest wykorzystanie klas pomocniczych.

# Struktura projektu

* kol
  * css
    * style.css
  * funkcje
    * Formularz.php
  * klasy
    * Baza.php
    * Dane.php
  * index.php
  * information.md

### css
### Formularz.php
### Baza.php

---

# Dane.php

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

## Konstruktor 

Nadaje wartości dla wszystnich zmiennych.

---

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

# get_pole_t

get_pole_t - Zwraca wartość zmiennej z tablicy o podanym indexie.

## Opis

```php
get_pole_t ( int $index ) : string
```

Zwraca wartość tablicy w zmiennej `$pola_t` o podanym indexie.

## Lista parametrów

* **index**
  * liczba całkowita

## Zwracane dane

Zwraca wartość zapisaną w tablice `$pola_t` pod indexem `$index`. Jeśli niczego nie podawać domyślnie zwraca wartość o zerowym indexie tz. `$pola_t[0]`. Jeżeli liczba `$index` są mniejsza(`<`) od `0` lub większa(`>`) od liczby zmienych w tablice(`count($pola_t)`) to funkcja zwruci wartość zmiennej o zerowym indexie.

## Przykłady

### Przykład #1 przykład wykorzystania funkcji get_pole_t()

```php
<?php

//$pola_t=["id","nazwisko","pesel","stan_konta","posiadanie_karty"];

$tresc = "<p>Bez klucza otrzymasz \"" . $dane -> get_pole_t( ) . "\".</p>";

echo $tresc;

$key = -4;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_t( $key ) . "\".</p>";

echo $tresc;

$key = 30;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_t( $key ) . "\".</p>";

echo $tresc;

$key = 2;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_t( $key ) . "\".</p>";

echo $tresc;

?>
```

Wynikiem wykonywania danego przykładu będzie:

```html
Bez klucza otrzymasz "id".

Otrzymasz dla klucza "-4" => "id".

Otrzymasz dla klucza "30" => "id".

Otrzymasz dla klucza "2" => "pesel".
```

---

# get_pole_d

get_pole_d - Pobiera jedną wartość typu calkowitego.

## Opis

```php
get_pole_d ( int $index ) : string
```

Zwraca wartość zapisaną w tablice `$pole_d` pod indexem `$index`.

## Lista parametrów

* **index**
  * liczba całkowita

## Zwracane dane

Zwraca wartość zapisaną w tablice `$pola_d` pod indexem `$index`. Jeśli niczego nie podawać domyślnie zwraca wartość o zerowym indexie tz. `$pola_d[0]`. Jeżeli liczba `$index` są mniejsza(`<`) od `0` lub większa(`>`) od liczby zmienych w tablice(`count($pola_d)`) to funkcja zwruci wartość zmiennej o zerowym indexie.

## Przykłady

### Przykład #1 przykład wykorzystania funkcji get_pole_d()

```php
<?php

//$pola_d = ["id", "Nazwisko", "PESEL", "Stan konta", "Posiadanie karty"];

$tresc = "<p>Bez klucza otrzymasz \"" . $dane -> get_pole_d( ) . "\".</p>";

echo $tresc;

$key = -4;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_d( $key ) . "\".</p>";

echo $tresc;

$key = 30;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_d( $key ) . "\".</p>";

echo $tresc;

$key = 2;

$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_pole_d( $key ) . "\".</p>";

echo $tresc;

?>
```

Wynikiem wykonywania danego przykładu będzie:

```html
Bez klucza otrzymasz "id".

Otrzymasz dla klucza "-4" => "id".

Otrzymasz dla klucza "30" => "id".

Otrzymasz dla klucza "2" => "PESEL".
```

---

# get_typ

get_typ - Pobiera jedną liczbę typu calkowitego.

## Opis

```php
get_typ ( int $index ) : string
```

Zwraca wartość zapisaną w tablice `$type` pod indexem `$index`.

## Lista parametrów

* **index**
  * liczba całkowita

## Zwracane dane

Zwraca wartość zapisaną w tablice `$type` pod indexem `$index`. Jeśli niczego nie podawać domyślnie zwraca wartość o zerowym indexie tz. `$type[0]`. Jeżeli liczba `$index` są mniejsza od `0` lub większa od liczby zmienych w tablice(`count($type)`) to funkcja zwruci wartość o zerowym indexie.

## Przykłady

### Przykład #1 przykład wykorzystania funkcji get_typ()

```php
<?php

// $type = ["int", "text", "text", "text", "text"];

// generujemy ciąg z funkcjej bez argumentowej
$tresc = "<p>Bez klucza otrzymasz \"" . $dane -> get_typ( ) . "\".</p>";

echo $tresc;

$key = -4;

// generujemy ciąg z kluczem ujemnym dla badanej funkcji
$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_typ( $key ) . "\".</p>";

echo $tresc;

$key = 30;

// generujemy ciąg z kluczem większym za zakres tablicy dla badanej funkcji
$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_typ( $key ) . "\".</p>";

echo $tresc;

$key = 2;

// generujemy ciąg z kluczem z zakresu tablicy dla badanej funkcji
$tresc = "<p>Otrzymasz dla klucza \"$key\" => \"" . $dane -> get_typ( $key ) . "\".</p>";

echo $tresc;

?>
```

Wynikiem wykonywania danego przykładu będzie:

```html
Bez klucza otrzymasz "int".

Otrzymasz dla klucza "-4" => "int".

Otrzymasz dla klucza "30" => "int".

Otrzymasz dla klucza "2" => "text".
```

---
# create_url

create_url - zwróca łańcuch od podanego katalogu do potocznego.

## Opis

```php
create_url( string $od ) : string
```

Modyfikuje cały łańcuch do potocznego katalogu.

## Lista parametrów

* **od**
  * ciąg typu `string` znaczy od którego katalogu trzeba tworzyć url.

## Zwracane dane

Jeżeli niczego nie podawać to domyślna wartość będzie równa "`htdocs`". Jeśli podana nie poprawna wartość to zwrócony następny ciąg: "`ERROR`".

## Przykłady

Przykład #1 przykład wykorzystania funkcji create_url

```php
<?PHP

echo getcwd() . "</br>"; // oryginalne dane które będziemy modyfikować

echo $dane -> create_url( "htdocs" ); // poprawno wpisano

echo "</br>";

echo $dane -> create_url( ); // niczego nie wpisano

echo "</br>";

echo $dane -> create_url( "ktdocs" ); // nie poprawno wpisano

?>
```

Wynikiem wykonywania danego przykładu będzie:

```html
/opt/lampp/htdocs/www/tai/kol
/www/tai/kol/
/www/tai/kol/
ERROR
```

---

function get_pole_d($i=0)
function get_typ($i=0)
private function create_url()

### index.php

<!-- ---

## 

### Opis

```php
```


### Zwracane dane

### Przykłady

Przykład #1 przykład wykorzystania funkcji 

```php
```

Wynikiem wykonywania danego przykładu będzie:

```html
```

--- -->

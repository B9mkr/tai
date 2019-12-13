<!-- 
napisać apolikację do obslugi wypożyczalni samochodów. 
Stona główna aplikcaji udostępnia trzy przyciski: 
* pokaż
* Wybierz,
* dodaj
Przycisk Pokaz wyświetla informacje o wszystkich dostępnych w bazie samochodach.
Każda pozycja zawiera pola:
* nr_reg, 
* marka, 
* rocznik,
* przebieg. 
Przycisk dodaj wyświetla formularz do wprowadzenia nowego auto do bazy.

Przycisk wybierz usostępnia pole formularza do wprowadzenia marki
a następnie wyświelta wszystkie samochody dane marki z bazy. 

Pierwsze uruchomienie aplikacji działanie przycisku Pokaz.
Konieczna jest walidcja danych przed zapisem (przeferowane filtry).
Wskazanie jest wykorzystanie klas pomocniczych.
```sql
CREATE TABLE IF NOT EXISTS `samochody` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nr_reg` varchar(40) NOT NULL ,
    `marka` varchar(40) NOT NULL ,
    `rocznik` varchar(40) NOT NULL ,
    `przebieg` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
http://localhost/www/tai/zk/index.php
 -->
 <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> zk </title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
	</head>
	<body >
	<div>
        <?php
        //dołącz funkcje z pliku zewnętrznego:
        // include_once ("funkcje.php");
        include_once ("klasy/Formularz.php");
        include_once ("klasy/Baza.php");
        
        $nazwa_tabeli = "samochody";
        
        $baza = new Baza("localhost", "root", "", $nazwa_tabeli);
        $form = new Formularz($nazwa_tabeli, $baza);

        if (filter_input(INPUT_GET, "submit"))
        {
            $akcja = filter_input(INPUT_GET, "submit");
            switch ($akcja) 
            {
                case "Pokaz":   $form->pokaz();     break;
                case "Wybierz": $form->wybierz();   break;
                case "Dodaj":   $form->dodaj();     break;
                case "Podaj":   $form->pokaz_m();   break;
                default: break;
            }
        }			
        ?>
	</div>

	</body>
</html>
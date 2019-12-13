<!-- 
Napisać aplikację do obsługi kont bankowych. 
Strona główna aplikacji udostępnia trzy przyciski Pokaż, Wybiera, Dodaj. 

* Przycisk Pokaz wyświetla informacje o wszystkich klientah banku z pliku(lub bazy danych). 
 Każda pozycja zawiera pola: nazwisko, PESEL, stan konta, posiadane karty. 
* Przycisk dodaj wyświetla formularz do wprowadzenia peselu a następnie wyświetla dane o wskazanym kliencie. 

Pierwsze uruchomienie aplikacji dzałanie prycisku Pokaz.
konieczna jest walidacja danych przed zapisem. Wskazane jest wykorzystanie klas pomocniczych.
```sql
CREATE TABLE IF NOT EXISTS `klienciBanku` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nazwisko` varchar(40) NOT NULL ,
    `pesel` varchar(11) NOT NULL,
    `stan_konta` varchar(40) NOT NULL,
    `posiadanie_karty` BOOLEAN NOT NULL DEFAULT false,
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
        include_once ("Formularz.php");
        include_once ("klasy/Baza.php");
        include_once ("klasy/Dane.php");
        
        $nazwa_tabeli = "klienciBanku";
        $polat=["id","nazwisko","pesel","stan_konta","posiadanie_karty"];
        $polad=["id","Nazwisko","PESEL","Stan konta","Posiadanie karty"];
        
        $baza = new Baza("localhost", "root", "", $nazwa_tabeli);
        
        $dane = new Dane($baza, $nazwa_tabeli, $polat, $polad, 2);

        drukuj_form($dane);
        
        if (filter_input(INPUT_GET, "submit"))
        {
            $akcja = filter_input(INPUT_GET, "submit");
            switch ($akcja) 
            {
                case "Pokaz":   pokaz($dane);     break;
                case "Wybierz": wybierz($dane);   break;
                case "Dodaj":   dodaj($dane);     break;
                case "Podaj":   pokaz_m($dane);   break;
                default: break;
            }
        }			
        ?>
	</div>

	</body>
</html>
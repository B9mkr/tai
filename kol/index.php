<!-- 

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
http://localhost/www/tai/kol/index.php
 -->
 <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> kol </title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
	</head>
	<body >
    <div class="tresc">
        Napisać aplikację do obsługi kont bankowych. 
        Strona główna aplikacji udostępnia trzy przyciski Pokaż, Wybiera, Dodaj. 

        Przycisk Pokaz wyświetla informacje o wszystkich klientah banku z pliku(lub bazy danych). 
        Każda pozycja zawiera pola: nazwisko, PESEL, stan konta, posiadane karty. 
        Przycisk dodaj wyświetla formularz do wprowadzenia peselu a następnie wyświetla dane o wskazanym kliencie. 

        Pierwsze uruchomienie aplikacji dzałanie prycisku Pokaz.
        konieczna jest walidacja danych przed zapisem. Wskazane jest wykorzystanie klas pomocniczych.
    </div>
	<div>
        <?php
        //dołącz funkcje z pliku zewnętrznego:
        include_once ("funkcje/Formularz.php");
        include_once ("klasy/Baza.php");
        include_once ("klasy/Dane.php");
        
        $nazwa_tabeli = "klienciBanku";
        
        // $method = "GET";
        $polat=["id","nazwisko","pesel","stan_konta","posiadanie_karty"];
        $polad=["id","Nazwisko","PESEL","Stan konta","Posiadanie karty"];
        $type=["int","text","text","text","text"];
        
        $args = array(
            'nazwisko' => FILTER_DEFAULT,
            'pesel' => FILTER_DEFAULT,
            'stan_konta' => FILTER_DEFAULT,
            'posiadanie_karty' => FILTER_DEFAULT,
        );

        $baza = new Baza("localhost", "root", "", $nazwa_tabeli);
        $dane = new Dane($baza, $nazwa_tabeli, $polat, $polad, $type, 2, $args, "GET");

        test($dane);
        drukuj_form($dane);
        
        if($dane->get_method()=="GET")
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
        elseif($dane->get_method()=="POST")
        if (filter_input(INPUT_POST, "submit"))
        {
            $akcja = filter_input(INPUT_POST, "submit");
            switch ($akcja) 
            {
                case "Pokaz":   pokaz($dane);     break;
                case "Wybierz": wybierz($dane);   break;
                case "Dodaj":   dodaj($dane);     break;
                case "Podaj":   pokaz_m($dane);   break;
                default: break;
            }
        }
        
function test($dane){
    $key = 2;

    $tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";
    
    echo $tresc;
    
    $key = -4;
    
    $tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";
    
    echo $tresc;
    
    $key = 30;
    
    $tresc = "<p>Otrzymasz dla klucza $key " . $dane -> get_pole_t( $key ) . "</p>";
    
    echo $tresc;
}
        ?>
	</div>

	</body>
</html>
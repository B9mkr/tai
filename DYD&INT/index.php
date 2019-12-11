<?php
require_once("klasy/Strona.php");
$strona_glowna = new Strona();
$strona_glowna->ustaw_style("css/style.css");
if (isset($_GET['strona'])) //zażądano strony statycznej
    {
    $strona = $_GET['strona'];
    switch ($strona) {
        case 'glowna':
            $strona = 'glowna';
            break;
        case 'kontakt':
            $strona = 'kontakt';
            break;
        default:
            $strona = 'glowna';
    }
} else
    $strona = "glowna";
$plik  = "szablony/" . $strona . ".html";
$tresc = "";
$pl    = fopen($plik, "r");
if ($pl) { // Wczytanie treści strony statycznej z pliku
    while (!feof($pl)) {
        $tresc .= fgets($pl);
    }
    $tytul = "Firma Dyd&Int - " . $strona;
    $strona_glowna->ustaw_tytul($tytul);
}
fclose($pl);
$strona_glowna->ustaw_zawartosc($tresc);
$strona_glowna->wyswietl();
?> 
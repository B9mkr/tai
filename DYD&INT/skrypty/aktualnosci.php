<?php
require_once("../klasy/Strona.php");
require_once("../klasy/Baza.php");
$strona_glowna = new Strona();
$strona_glowna->ustaw_style("../css/style.css");
$strona_glowna->ustaw_tytul("Dyd&Int - Aktualności");
$tresc = "";
$ob    = new baza("localhost", "root", "", "dane");
$sql   = "select * from newsy";
$pola  = array(
    "Nagłówek",
    "Treść"
);
//wyswietl dane z bazy:
$tresc .= $ob->select($sql, $pola);
$strona_glowna->ustaw_zawartosc($tresc);
$strona_glowna->wyswietl();
?>
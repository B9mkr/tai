<?php
require_once("../klasy/Strona.php");
$strona_glowna = new Strona();
$strona_glowna->ustaw_style("../css/style.css");
$strona_glowna->ustaw_tytul("Dyd&Int - Galeria");
$tresc   = "";
$katalog = "../grafika";
$kat     = @opendir($katalog);
while ($plik = readdir($kat))
    $tresc .= "<img src='../grafika/" . $plik . "' alt='" . $plik . "' />
&nbsp;&nbsp; ";
closedir($kat);
$strona_glowna->ustaw_zawartosc($tresc);
$strona_glowna->wyswietl();
?> 
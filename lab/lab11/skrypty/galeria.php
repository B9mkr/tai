<?php
$tytul = "Galeria";
$zawartosc = galeria(10);

function galeria($ilosc)
{
    $i=1;
    $nazwa = "obraz";
    $wyn="";
    while($i <= $ilosc){
        $wyn.="<img src='miniaturki/$nazwa".$i.".JPG' alt='$nazwa' />";
        $i++;
    }
    return $wyn;
}
?>

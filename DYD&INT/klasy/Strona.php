<?php
class Strona //początek definicji klasy
{
    //własności klasy:
    protected $zawartosc;
    protected $tytul = "FIRMA DYD&INT - strona główna";
    // protected $slowa_kluczowe = "Szkolenia, kursy, internet";
    protected $przyciski = array(
        "Strona główna" => "../index.php?strona=glowna", 
        "Aktualności" => "../skrypty/aktualnosci.php", 
        "Galeria" => "../skrypty/galeria.php", 
        "Kontakt" => "../index.php?strona=kontakt");
    protected $style_url;
    //interfejs klasy – funkcje modyfikujące fragmenty strony
    function ustaw_zawartosc($nowa_zawartosc)
    {
        $this->zawartosc = $nowa_zawartosc;
    }
    function ustaw_tytul($nowy_tytul)
    {
        $this->tytul = $nowy_tytul;
    }
    // function ustaw_slowa_kluczowe($nowe_slowa){$this->slowa_kluczowe = $nowe_slowa;}
    function ustaw_przyciski($nowe_przyciski)
    {
        $this->przyciski = $nowe_przyciski;
    }
    function ustaw_style($url)
    {
        $this->style_url = $url;
    }
    //interfejs klasy – funkcje wyświetlające stronę
    function wyswietl()
    {
        $this->wyswietl_naglowek();
        $this->wyswietl_zawartosc();
        $this->wyswietl_stopke();
    }
    function wyswietl_tytul()
    {
        echo "<title>$this->tytul</title>";
    }
    // function wyswietl_slowa_kluczowe(){echo "<meta name=\"keywords\" contents=\"$this->slowa_kluczowe\">";}
    function wyswietl_menu()
    {
        echo "<div id='nav'>";
        while (list($nazwa, $url) = each($this->przyciski))
            echo ' <a href="' . $url . '">' . $nazwa . '</a>';
        echo "</div>";
    }
    function wyswietl_naglowek()
    {
?> 
<!DOCTYPE html>
<html> 
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
        echo '<link rel="stylesheet" href=' . $this->style_url . ' type="text/css" />';
        echo "<title>" . $this->tytul . "</title></head><body> ";
        echo "<div id='nag'><h1>" . $this->tytul . "</h1></div>";
    }
    function wyswietl_zawartosc()
    {
        echo "<div id='tresc'>";
        $this->wyswietl_menu();
        echo $this->zawartosc . "</div>";
    }
    function wyswietl_stopke()
    {
        echo '<div id="stopka"> &copy; BM</div>';
        echo '</body></html>';
    }
} //koniec definicji klasy Strona
?>
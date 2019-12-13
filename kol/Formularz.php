<?php
// include_once("Baza.php");

function drukuj_form($dane){
?>
    <h3>Drukuj form</h3>
    <p>
        <form action="index.php" method="GET">

<?php
    echo gen_tresc_form($dane, 0);
?>
            <!-- Nazwisko: <br/><input type="text" name="nazwisko" /><br/>
            PESEL: <br/><input type="text" name="pesel" /><br/>
            Stan konta: <br/><input type="text" name="stan_konta" /><br/>
            Posiadanie karty: <br/><input type="text" name="posiadanie_karty" /><br/> -->

            <input type="submit" name="submit" value="Pokaz" />
            <input type="submit" name="submit" value="Wybierz" />
            <input type="submit" name="submit" value="Dodaj" />
        </form>
    </p>
<?php    
}
function gen_tresc_form($dane, $skip=0){
    $tresc="";
    $poled=$dane->get_pola_d();
    foreach($dane->get_pola_t() as $key => $polet){
        if($key==$skip)
            continue;
        
        $tresc.=$poled[$key].": <br/><input type=\""."text"."\" name=\"".$polet."\" /><br/>";
    }
    return $tresc;
}
// array(4) { 
//     ["nazwisko"]=> bool(false) 
//     ["pesel"]=> int(234) 
//     ["stan_konta"]=> string(7) "aktywny" 
//     ["posiadane_karty"]=> NULL 
// }

// -----pokaz----------------------

function pokaz($dane){
    $sql="select * from ".$dane->get_nazwa_tabeli();

    $tresc = $dane->get_baza()->select($sql, $dane->get_pola_t());
    echo $tresc;
}

// -----dodaj----------------------

function dodaj($dane){
    walidacja($dane);
}
function walidacja($daneG)
{
    $args = array(
        'nazwisko' => FILTER_DEFAULT,
        'pesel' => FILTER_DEFAULT,
        'stan_konta' => FILTER_DEFAULT,
        'posiadanie_karty' => FILTER_DEFAULT,
    );
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_GET, $args);

    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
    // var_dump($dane);
    
    //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
    $errors = "";
    foreach ($dane as $key => $val)
    {
        if ($val === false or $val === NULL)
        {
            $errors .= $key . "; ";
        }
    }
    if ($errors === "")
    {
        //Dane poprawne - zapisz do pliku
        //wykorzystaj pomocniczą funkcję:
        // print("</br><p>GOOD walidation!</p>");
        dobazy($daneG, $dane);
        // var_dump($dane);
    }
    else
    {
        echo "<br>Niepoprawne dane: " . $errors;
    }
}
function dobazy($dane, $tablicaDanych)
{
    // $linia = "";
    
    // $linia = create_line_filtr($tablicaDanych, $dane);
    // echo $linia;
    // $daneArray = create_dane($dane);
    $sql=create_dodaj_sql($tablicaDanych, $dane);
    // echo $sql;
    
    $dane->get_baza()->answer($sql);
    
}

function create_dodaj_sql($tablicaDanych, $dane){
    $sql = "INSERT INTO `".$dane->get_nazwa_tabeli()."` (";
    $i=count($dane->get_pola_t());
    foreach($dane->get_pola_t() as $key => $pole){
        $sql.="`$pole`";
        if($key<count($dane->get_pola_t())-1)
            $sql.=",";
    }
    $sql.=") VALUES ".create_line_filtr($tablicaDanych, $dane);
    return $sql;
}

//IN
// array(4) { 
//     ["nazwisko"]=> string(6) "Mushka" 
//     ["pesel"]=> string(11) "47072843544" 
//     ["stan_konta"]=> string(7) "aktywny" 
//     ["posiadanie_karty"]=> string(1) "1" 
//} 

//OUT
//    (NULL,'Mushka','47072843544','aktywny','1');

function create_line_filtr($dane, $daneG)
{
    // var_dump($dane);
    $linia="(NULL,";

    $i=count($daneG->get_pola_t());

    foreach($dane as $key => $dan){
        $linia.="'".$dan."'";
        $i--;
        if(($i-1) != 0)
            $linia.=",";
    }

    $linia .= ");";

    return $linia;
}

// -----wybierz--------------------

function wybierz($dane){
    echo drukuj_find($dane);
}

function drukuj_find($dane){
    $key=$dane->get_poszuk();
    $tresc="<h3>Podaj ".$dane->get_pole_t($key)."</h3>";
    $tresc.="<p><form action=\"index.php\" method=\"GET\">";
    
    $tresc.=$dane->get_pole_d($key).": <br/><input type=\""."text"."\" name=\"".$dane->get_pole_t($key)."\" /><br/>";

    $tresc.="<input type=\"submit\" name=\"submit\" value=\"Podaj\" />";
    $tresc.="</form></p>";
    echo $tresc;
}

function pokaz_m($dane){
    $sql="select * from ".$dane->get_nazwa_tabeli()." nazwa ";
    $sql.="where nazwa.".$dane->get_pole_t($dane->get_poszuk())."=".pomoc($dane);
    $tresc = $dane->get_baza()->select($sql, $dane->get_pola_t());
    echo $tresc;
}

function pomoc($dane){
    $zm=$dane->get_pole_t($dane->get_poszuk());
    if (isset($_REQUEST[$zm])&&($_REQUEST[$zm]!="")){
        $wyn = htmlspecialchars(trim($_REQUEST[$zm]));
    }
    else $wyn = "";
    return $wyn;
}
// --------------------------------
?>

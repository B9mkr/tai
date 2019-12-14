<?php
function drukuj_form($dane){
    $formularz = "<h3>Drukuj form</h3>"."<form action=\"".$dane->get_action()."\" method=\"".$dane->get_method()."\">";
    $formularz .= gen_tresc_form($dane, 0);

            // <!-- Nazwisko: <br/><input type="text" name="nazwisko" /><br/>
            // PESEL: <br/><input type="text" name="pesel" /><br/>
            // Stan konta: <br/><input type="text" name="stan_konta" /><br/>
            // Posiadanie karty: <br/><input type="text" name="posiadanie_karty" /><br/> -->
    $formularz .= "<input type=\"submit\" name=\"submit\" value=\"Pokaz\" />
                <input type=\"submit\" name=\"submit\" value=\"Wybierz\" /> 
                <input type=\"submit\" name=\"submit\" value=\"Dodaj\" /></form>";
    echo $formularz;
}
function gen_tresc_form($dane, $skip=0){
    $tresc="";
    
    for($key=0; $key < count($dane->get_pola_t()); $key++)
    {
        if($key==$skip)
            continue;
        
        $tresc .= gen_in_form($dane, $key);
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
function walidacja($dane)
{
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    if($dane->get_method()=="GET")
        $danel = filter_input_array(INPUT_GET, $dane->get_args());
    elseif($dane->get_method()=="POST")
        $danel = filter_input_array(INPUT_POST, $dane->get_args());

    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
    // var_dump($dane);
    
    //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
    $errors = "";
    foreach ($danel as $key => $val)
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
        dobazy($dane, $danel);
        // var_dump($dane);
    }
    else
    {
        echo "<br>Niepoprawne dane: " . $errors;
    }
}
function dobazy($dane, $tablicaDanych)
{
    $sql=create_dodaj_sql($tablicaDanych, $dane);
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
//OUT
//    (NULL,'Mushka','47072843544','aktywny','1');

// -----wybierz--------------------

function wybierz($dane){
    echo drukuj_find($dane);
}

function drukuj_find($dane){
    $key=$dane->get_poszuk();
    $tresc="<h3>Podaj ".$dane->get_pole_t($key)."</h3>";
    
    $tresc.="<p><form action=\"".$dane->get_action()."\" method=\"".$dane->get_method()."\">";
    
    $tresc.=gen_in_form($dane, $key);

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

function gen_in_form($dane, $key){
    // $key=$dane->get_poszuk();
    $wyn = "".$dane->get_pole_d($key).": <br/><input type=\"".$dane->get_typ($key)."\" name=\"".$dane->get_pole_t($key)."\" /><br/>";
    // echo $wyn;
    return $wyn;
}

?>

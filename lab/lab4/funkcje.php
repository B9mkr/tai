<?php

function drukuj_form() {
?>
<form action = "formularze.php" method = "GET">
    <table>
        <tr>
            <td><label for = "nazwisk">Nazwisko:</label></td>
            <td><input type="text" name="nazwisko"/></td>
        </tr>
        <tr>
            <td><label for = "wie">Wiek:</label></td>
            <td><input type="text" name="wiek"/></td>
        </tr>
        <tr>
            <td><label for = "Panstw">Państwo:</label></td>
            <td>
                <select name="panstwo">
                    <option value="p">Polska</option>
                    <option value="n">Niemcy</option>
                    <option value="w">Wielka Brytania</option>
                    <option value="c">Czechy</option>
                    <option value="m">Moldawia</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for = "adresmail">Adres e-mail:</label></td>
            <td><input type="text" name="email"/></td>
        </tr>
    </table>

    <div id="baner"> <h4>Zamawiam tutorial z jęsyka:</h4> </div>
    
    <label for="php">   <input type="checkbox" name="checkboxes[]" value="1" id="php" /> PHP </label>
    <label for="c/c++"> <input type="checkbox" name="checkboxes[]" value="2" id="c/c++" /> C/C++ </label>
    <label for="java">  <input type="checkbox" name="checkboxes[]" value="3" id="java" /> Java </label> <br />

    <div id="baner"> <h4> Sposób  zapłaty:</h4> </div> 
    <label for="ecard"> <input type="radio" name="oplata" value="Euro card" id="ecard" /> eurocard </label>
    <label for="visa"> <input type="radio" name="oplata" value="Visa" id="visa" /> visa </label>
    <label for="prbank"> <input type="radio" name="oplata" value="Przelew bankowy" id="prbank" /> przelew bankowy </label> <br />
    
    <!-- <input type="submit" name="wyslij" value="Wyślij" /> -->
    <input type="reset" name="reset" value="Wyczyść formularz" />
    
    <input type="submit" value="Dodaj" name="submit"/>
    <input type="submit" value="Pokaz" name="submit"/>

    <input type="submit" value="Statystyki" name="submit"/>
    
    <!-- <input type="submit" value="PHP" name="submit"/>
    <input type="submit" value="CPP" name="submit"/> -->
    <br />
</form>

<?php }

function dodaj($nazwa_pliku) {
    echo "<h3>Dodawanie do pliku:</h3>";
    walidacja($nazwa_pliku);
}

function walidacja($nazwa_pliku)
{
    $args = array(
        'nazwisko' => [ 
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                'regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/'
            ]
        ],
        'wiek' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' =>[
                "min_range" => 1,
                "max_range" => 120
            ]
        ],
        'panstwo' => FILTER_DEFAULT,
        'email' => FILTER_VALIDATE_EMAIL,
        'checkboxes' => [
            'filter' => FILTER_VALIDATE_INT,
            'flags' => FILTER_REQUIRE_ARRAY
        ],
        'oplata' => FILTER_DEFAULT
    );
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_GET, $args);

    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
    var_dump($dane);
    
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
        print("</br><p>GOOD walidation!</p>");
        dopliku($nazwa_pliku, $dane);
        // var_dump($dane);
    }
    else
    {
        echo "<br>Niepoprawne dane: " . $errors;
    }
}

function dopliku($nazwa_pliku, $tablicaDanych)
{
    $linia = "";
    
    $linia = create_line_filtr($tablicaDanych);
    
    $wp = fopen($nazwa_pliku, "r");
    if (!$wp){ 
        echo "<p>nie udało się odtworzyć</p></body></html>";    exit;
    }
    echo "<p>Do zapisu: </br> $linia </p>";
    $linia = fread($wp, filesize($nazwa_pliku))."\r\n".$linia;//.PHP_EOL;

    fclose($wp);

    $wp = fopen($nazwa_pliku, "w");
    if (!$wp){ 
        echo "<p>nie udało się odtworzyć</p></body></html>";    exit;
    }

    fputs($wp, $linia);
    fclose($wp);
}

function pokaz($nazwa_pliku) 
{
    $plik = fopen($nazwa_pliku,'r');
    if (!$plik){ 
        echo "<p>nie udało się odtworzyć</p></body></html>";
        exit;
    }

    $linia="";
    print("<ol>");
    while(!feof($plik))
    {
        print("<li>");

        $linia = fgets($plik);
        $dane = generowanieTablicy($linia);
        pokazm($dane);

        print("</li>");
    }
    print("</ol>");
    fclose($plik);
}

//function pokaz_zamowienie($lang) {
    // odczytaj dane z pliku i wyświetl tylko te wiersze,
    //w których zamówiono $lang (np. $lang="Java"
//}

function pokazm($dane){
    // print("<ul>");
    foreach ($dane as $d){
        // print("<li>");
        echo("$d; ");
        // print("</li>");
    }
    // print("</ul>");
    // echo("</br>");

    //------------------------------------------------
    // $dane ==
    //
    // array(6) {
    //     ["nazwisko"]=> string(6) "Mushka" 
    //     ["wiek"]=> int(20) 
    //     ["panstwo"]=> string(1) "p" 
    //     ["email"]=> string(21) "mushkaborys@gmail.com" 
    //     ["checkboxes"]=> array(3) 
    //     { 
    //         [0]=> int(1) 
    //         [1]=> int(2) 
    //         [2]=> int(3) } 
    //     ["oplata"]=> string(4) "Visa" 
    // }

    //    function create_line_filtr($dane)


    // $linia="('";
    

    // $linia .= $dane["nazwisko"];
    // $linia .= "', '";
    // $linia .= $dane["wiek"];
    // $linia .= "', '";
    // switch($dane["panstwo"])
    // {
    //     case "p":	$linia .= "Polska";         break;
    //     case "n":	$linia .= "Niemcy";         break;
    //     case "w":	$linia .= "Wielka Brytania";break;
    //     case "c":	$linia .= "Czechy";         break;
    //     case "m":	$linia .= "Moldawia";       break;
    //     default:    $linia .= "NULL";
    // }
    // $linia .= "', '";
    // $linia .= $dane["email"];
    // $linia .= "', '";

    // $kurs = ["PHP", "C", "Java"];

    // for ($i = 0; $i < count($dane["checkboxes"]); $i++) 
    // { 
    //     switch($dane["checkboxes"][$i])
    //     {
    //         case 1: $linia .= $kurs[0]; break;
    //         case 2: $linia .= $kurs[1]; break;
    //         case 3: $linia .= $kurs[2]; break;
    //         default: $linia .= "NULL";
    //     }
        
    //     if($i < (count($dane["checkboxes"])-1))
    //         $linia .= ",";
    //     // if(($i+1) < )
            
    // }
}

function generowanieTablicy($liniao){

    // $index=["nazwisko", "wiek", "panstwo", "email", "checkboxes", "oplata"];
    $linia=str_split($liniao);
    $k=0;
    $s=0;
    $k=0;
    $m=0;

    foreach ($linia as $lin)
    {
        if($lin!="(" && $lin!=")"&& $lin!=";"){
            if($lin=="'" && $k==0){
                // echo("<1>");
                $k=1;
                $m=0;
                continue;
            }
            else
            if($lin == "'" && $k==1){
                // echo("<2>|($m)");
                $k=0;
                // echo($lin);
                // $dane[$index[$s++]]=fun($slowo, $m);
                $dane[$s++]=fun($slowo, $m);
                // fun2($slowo);
                // echo($dane[$s-1]);
                // echo("|");
                
                continue;
            }

            if($k==1){
                // echo($lin);
                $slowo[$m]=$lin;
                $m++;
            }
        }
    }
// Mushka
// 23
// Wielka Brytania
// mushkaborys@gmail.com
// C,Java
// Visa

    return $dane;
}

function fun2($linia){
    $k=0;
    $s=0;
    $k=0;
    $m=0;
    foreach ($linia as $lin)
    {
        if($lin=="," && $k==0){
            // echo("<1>");
            $k=1;
            $m=0;
            continue;
        }
        else
        if($lin == "'" && $k==1){
            // echo("<2>|($m)");
            $k=0;
            // echo($lin);
            $dane[$s++]=fun($slowo, $m);
            // echo($dane[$s-1]);
            // echo("|");
            
            continue;
        }

        if($k==1){
            // echo($lin);
            $slowo[$m]=$lin;
            $m++;
        }
    }

}

function fun($slowo, $m)
{
    for($i=0; $i<$m; $i++){
        $wynik[$i] = $slowo[$i];
    }
    return implode($wynik);
}

function create_dane(){
    if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) 
    {
        $dane[0] = htmlspecialchars(trim($_REQUEST['nazwisko']));
    }
    else $dane[0] = "NULL";

    if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) 
    {
        $dane[1] = htmlspecialchars(trim($_REQUEST['wiek']));
    }
    else $dane[1] = "NULL";

    if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) 
    {
        $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
        switch($panstwo)
        {
            case "p":	$dane[2] = "Polska"; break;
            case "n":	$dane[2] = "Niemcy"; break;
            case "w":	$dane[2] = "Wielka Brytania"; break;
            case "c":	$dane[2] = "Czechy"; break;
            case "m":	$dane[2] = "Moldawia"; break;
            default:    $dane[2] = "NULL";
        }
    }

    if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) 
    {
        $dane[3] = htmlspecialchars(trim($_REQUEST['email']));
    }
    else $dane[3] = "NULL";

    $kurs = ["PHP", "C", "Java"];
    $dane[4]='';
    for ($i = 0; $i < count($kurs); $i++) 
    { 
        if(isset($_REQUEST[$kurs[$i]])){
            $dane[4] .= $kurs[$i];
            if($i < count($kurs)-1)
                $dane[4].=",";
        }
    }

    if (isset($_REQUEST['oplata'])&&($_REQUEST['oplata'] != "")) 
    {
        $dane[5] = htmlspecialchars(trim($_REQUEST['oplata']));
    }
    else $dane[5] = "NULL";

    return $dane;
}

function create_line($dane)
{
    $linia="(";
    for($i=0; $i<count($dane); $i++){
        $linia .= "'".$dane[$i];
        if($i<count($dane)-1)
            $linia .= "', ";
    }
    $linia .= "');";

    return $linia;
}
function create_line_filtr($dane)
{
    $linia="('";
    
    // $dane ==
    //
    // array(6) {
    //     ["nazwisko"]=> string(6) "Mushka" 
    //     ["wiek"]=> int(20) 
    //     ["panstwo"]=> string(1) "p" 
    //     ["email"]=> string(21) "mushkaborys@gmail.com" 
    //     ["checkboxes"]=> array(3) 
    //     { 
    //         [0]=> int(1) 
    //         [1]=> int(2) 
    //         [2]=> int(3) } 
    //     ["oplata"]=> string(4) "Visa" 
    // }

    $linia .= $dane["nazwisko"];
    $linia .= "', '";
    $linia .= $dane["wiek"];
    $linia .= "', '";
    switch($dane["panstwo"])
    {
        case "p":	$linia .= "Polska";         break;
        case "n":	$linia .= "Niemcy";         break;
        case "w":	$linia .= "Wielka Brytania";break;
        case "c":	$linia .= "Czechy";         break;
        case "m":	$linia .= "Moldawia";       break;
        default:    $linia .= "NULL";
    }
    $linia .= "', '";
    $linia .= $dane["email"];
    $linia .= "', '";

    $kurs = ["PHP", "C", "Java"];

    for ($i = 0; $i < count($dane["checkboxes"]); $i++) 
    { 
        switch($dane["checkboxes"][$i])
        {
            case 1: $linia .= $kurs[0]; break;
            case 2: $linia .= $kurs[1]; break;
            case 3: $linia .= $kurs[2]; break;
            default: $linia .= "NULL";
        }
        
        if($i < (count($dane["checkboxes"])-1))
            $linia .= ",";
        // if(($i+1) < )
            
    }
    $linia .= "', '";
    $linia .= $dane["oplata"];
    $linia .= "');";

    return $linia;
}
?>
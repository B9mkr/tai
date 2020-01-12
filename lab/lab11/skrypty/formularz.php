<?php
//pomocnicza funkcja generująca formularz:
function drukuj_form()
{
    $form = '<h3> Formularz zamówienia:</h3>' . '<form method="post" action="?strona=formularz" >';
    $form .= '
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
    
    <input type="reset" name="reset" value="Wyczyść formularz" />
    
    <input type="submit" value="Dodaj" name="dodaj"/>
    <input type="submit" value="Pokaz" name="pokaz"/>

    <input type="submit" value="Java" name="java"/>
    <br />
</form>';
    return $form; //wynik typu String – gotowy formularz
}
//uchwyt do bazy testowa:
include_once "klasy/Baza.php";
$ob        = new Baza("localhost", "root", "", "klienci");
$tytul     = "Formularz";
$zawartosc = drukuj_form();

if (isset($_POST['pokaz'])) {
    $zawartosc .= $ob->select("select Nazwisko,Zamowienie from klienci", array(
        "Nazwisko",
        "Zamowienie"
    ));
} else if (isset($_POST['java'])) {
    $zawartosc .= $ob->select("select Nazwisko,Zamowienie from klienci
where Zamowienie regexp 'Java'", array(
        "Nazwisko",
        "Zamowienie"
    ));
} else if (isset($_POST['dodaj'])) {
    walidacja();
}

function walidacja()
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
    $dane = filter_input_array(INPUT_POST, $args);

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
        dobazy($dane);
        // var_dump($dane);
    }
    else
    {
        echo "<br>Niepoprawne dane: " . $errors;
    }
}
function dobazy($dane)
{
    $wynik.="INSERT INTO `klienci` (`Id`, `Nazwisko`, `Wiek`, `Panstwo`, `Email`, `Zamowienie`, `Platnosc`) VALUES";
    $wynik.=create_line_filtr($dane);
    $ob->answer($wynik);
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
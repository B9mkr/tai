<?php
    //uchwyt do bazy testowa:
    include_once "class/Baza.php";
    include_once "class/User.php";

$user      = $user_main->get_user();
$ob        = new Baza("localhost", "root", "", "projekt");
$tytul     = "Registration";
$zawartosc = drukuj_form($user);
$datetime  = $user->get_date();
$dateshow  = $user->get_date_format("d F Y");

//pomocnicza funkcja generująca formularz:
    
    function drukuj_form($user)
    {
        $form = '<h3> Formularz registracji:</h3>' . '<form method="post" action="?strona=registration" >';
        $form .= '
        <table>
            <tr>
                <td><label for = "username">User name:</label></td>
                <td><input type="text" name="username"/></td>
            </tr>
            <tr>
                <td><label for = "adresmail">Adres e-mail:</label></td>
                <td><input type="text" name="email"/></td>
            </tr>
            <tr>
                <td><label for = "img">Img:</label></td>
                <td><input type="text" name="img"/></td>
            </tr>
            <tr>
                <td><label for = "paswd">Password:</label></td>
                <td><input type="password" name="paswd"/></td>
            </tr>
        </table> </br>
        
        <input type="reset" name="reset" value="Wyczyść formularz" />
        
        <input type="submit" value="Registration" name="dodaj"/> </br>
        <a href="?strona=log_in">Log in</a>
        </br>
    </form>';
    // $form.=$user->show();
        return $form; //wynik typu String – gotowy formularz
    }

if (isset($_POST['pokaz'])) {
    $zawartosc .= $ob->select("select * from User", array(
        "username",
        "email",
        "date",
        "img",
        "status"
    ));
// } 
// else if (isset($_POST['java'])) {
//     $zawartosc .= $ob->select("select username, email from User
// where Zamowienie regexp 'Java'", array(
//         "username",
//         "Zamowienie"
//     ));
} else if (isset($_POST['dodaj'])) {
    walidacja($user, $ob);
}

function walidacja($user, $ob)
{
    $args = array(
        'username' => FILTER_DEFAULT,
        'email' => FILTER_VALIDATE_EMAIL,
        'img' => FILTER_DEFAULT,
        'paswd' => FILTER_DEFAULT
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
        // print("</br><p>GOOD walidation!</p>");
        dobazy($dane, $user, $ob);
        // var_dump($dane);
    }
    else
    {
        echo "</br>Niepoprawne dane: " . $errors;
    }
}
function dobazy($dane, $user, $ob)
{
    $user->set_username($dane["username"]);
    $user->set_email($dane["email"]);
    $user->set_passwd($dane["paswd"]);
    $user->set_status(1);
    $user->set_date();
    $user->set_img("img/anon.jpg");

    $ob->answer($user->add_do_bazy());
}


?>
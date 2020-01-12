<?php
//uchwyt do bazy testowa:
include_once "class/Baza.php";
include_once "class/User.php";

$user      = new User("", "", "");
$ob        = new Baza("localhost", "root", "", "projekt");
$tytul     = "Log in";
$zawartosc = drukuj_form();
$datetime  = $user->get_date();
$dateshow  = $user->get_date_format("d F Y");

function drukuj_form()
{
    $form = '<h3> Log in:</h3>' . '<form method="post" action="?strona=log_in" >';
    $form .= '
    <table>
        <tr>
            <td><label for = "adresmail">Adres e-mail:</label></td>
            <td><input type="text" name="email"/></td>
        </tr>
        <tr>
            <td><label for = "password">Password:</label></td>
            <td><input type="password" name="passwd"/></td>
        </tr>
    </table>
    </br>
    <input type="submit" value="Log in" name="log_in"/>
    <a href="?strona=registration">Registration</a>
</form>';
    return $form; //wynik typu String – gotowy formularz
}

if (isset($_POST['log_in'])) {
    walidacja($user, $ob);
}

function walidacja($user, $ob)
{
    $args = array(
        'email' => FILTER_VALIDATE_EMAIL,
        'passwd' => FILTER_DEFAULT
    );
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_POST, $args);

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
        print("</br><p>GOOD walidation!</p>");
        zbazy($dane, $user, $ob);
        // var_dump($dane);
    }
    else
    {
        echo "</br>Niepoprawne dane: " . $errors;
    }
}
function zbazy($dane, $user, $ob)
{
    $user->set_email($dane["email"]);
    $user->set_passwd($dane["passwd"]);

    // echo $ob->select('SELECT * FROM `User` u WHERE u.email="'.$user->get_email().'" AND u.passwd="'.$user->get_passwd().'"', array(
    //     "username",
    //     "email",
    //     "date",
    //     "img",
    //     "status"
    // ));
    $sql='SELECT * FROM `User` u WHERE u.email="'.$user->get_email().'" AND u.passwd="'.$user->get_passwd().'"';
    $dane=$ob->dane_z_bazy($sql);
    if($dane == NULL)
        echo "Nie poprawne zapytania </br>";
    else{
        $user->set_z_bazy($dane, 0);
        // var_dump($user);

        
    }
}

?>
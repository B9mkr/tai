<?php
$user      = $user_main->get_user();
$tytul     = "Log in";
$komunikat = '';
$zawartosc = drukuj_form();
//$komunikat;

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
    walidacja($user, $ob, $komunikat);
}

function walidacja($user, $ob, $komunikat)
{
    $args = array(
        'email' => FILTER_VALIDATE_EMAIL,
        'passwd' => FILTER_DEFAULT
    );

    $dane = filter_input_array(INPUT_POST, $args);

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
        // $komunikat .= "</br><p>GOOD walidation!</p>";
        zbazy($dane, $user, $ob, $komunikat);
        // var_dump($dane);
    }
    else
    {
        $komunikat .= "</br>Niepoprawne dane: " . $errors;
    }
}
function zbazy($dane, $user, $ob, $komunikat)
{
    $sql='SELECT * FROM `User` u WHERE u.email="'.$dane["email"].'" AND u.passwd="'.$dane["passwd"].'"';
    $dane=$ob->dane_z_bazy($sql);
    if($dane == NULL)
        $komunikat .= "Nie poprawne zapytania </br>";
    else{
        $user->set_z_bazy($dane, 0);
        // var_dump($user);        
    }
}

?>
<!-- 

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

 -->
 <!-- Listing 3. Schemat skryptu processLogin.php -->
<?php
include_once('class/UserManager.php');

$user      = $user_main->get_user();
$tytul     = "Log in";
// $komunikat = '';
$zawartosc = '';

$um = new UserManager();
//parametr z GET – akcja = wyloguj
if (filter_input(INPUT_GET, "akcja")=="wyloguj")
{
    $um->logout($ob);
}
//kliknięto przycisk submit z name = zaloguj
if (filter_input(INPUT_POST, "zaloguj")) 
{
    $userId=$um->login($ob); //sprawdź parametry logowania
    if ($userId > 0) {
        echo "<p>Poprawne logowanie.<br />";
        echo "Zalogowany użytkownik o id=$userId <br />";
        //pokaż link wyloguj
        //lub przekieruj użytkownika na inną stronę dla zalogowanych
        echo "<a href='processLogin.php?akcja=wyloguj' >Wyloguj</a> </p>";
    } else {
        echo "<p>Błędna nazwa użytkownika lub hasło</p>";
        $um->loginForm(); //Pokaż formularz logowania
    }
} else {
    //pierwsze uruchomienie skryptu processLogin
    $zawartosc = $um->loginForm();
}
?>
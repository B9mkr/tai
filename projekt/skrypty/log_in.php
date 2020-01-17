<?php

// $user_main = new User("", "", ""); // index.php
$user      = $user_main->get_user();
$tytul     = "Log in";
$zawartosc = '';

// $User_M = new UserManager(); // index.php
$um = $User_M;

//kliknięto przycisk submit z name = zaloguj
if (filter_input(INPUT_POST, "log_in")) 
{
    $userId=$um->login($ob); //sprawdź parametry logowania
    if ($userId > 0) {
        header("Location: ?strona=user&user=".$userId); /* Redirect browser */

        exit;
        // $zawartosc .= "<a href='?akcja=wyloguj' >Wyloguj</a> </p>";
    } else {
        $zawartosc = "<p>Błędna nazwa użytkownika lub hasło</p>";
        $zawartosc .= $um->loginForm(); //Pokaż formularz logowania
    }
} else {
    //pierwsze uruchomienie skryptu processLogin
    $zawartosc = $um->loginForm();
}
?>
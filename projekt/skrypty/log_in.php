<?php

// $user_main = new User("", "", ""); // index.php
$user      = $user_main->get_user();
$tytul     = "Log in";
$zawartosc = '';

//kliknięto przycisk submit z name = zaloguj
if (filter_input(INPUT_POST, "log_in")) 
{
    $userId=$user->login_walidation($ob); //sprawdź parametry logowania
    if ($userId > 0) {
        header("Location: ?strona=user&user=".$userId); /* Redirect browser */

        exit;
        // $zawartosc .= "<a href='?akcja=wyloguj' >Wyloguj</a> </p>";
    } else {
        $zawartosc = "<p>Błędna nazwa użytkownika lub hasło</p>";
        $zawartosc .= $user->get_format_Form($user->login_Form()); //Pokaż formularz logowania
    }
} else {
    //pierwsze uruchomienie skryptu processLogin
    $zawartosc = $user->get_format_Form($user->login_Form());
}
?>
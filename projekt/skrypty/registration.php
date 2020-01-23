<?php

// $user_main = new User("", "", ""); // index.php
$user      = $user_main->get_user();
$tytul     = "Registration";
$zawartosc = '';

//kliknięto przycisk submit z name = registration
if (filter_input(INPUT_POST, "registration")) 
{
    $userId = $user->registration_walidation($ob, $user); //sprawdź parametry logowania
    if ($userId > 0)
    {
        header("Location: ?strona=user&user=".$userId); 
        exit;
    } else 
    {
        $zawartosc = "<p>Błędna walidacja</p>";
        $zawartosc .= $user->get_format_Form($user->registration_Form()); //Pokaż formularz logowania
    }
} else {
    //pierwsze uruchomienie skryptu processLogin
    $zawartosc = $user->get_format_Form($user->registration_Form());
}

?>
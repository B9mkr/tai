<?php

// $user_main = new User("", "", ""); // index.php
$user      = $user_main->get_user();
$tytul     = "Registration";
$zawartosc = '';

// $User_M = new UserManager(); // index.php
$um = $User_M;

//kliknięto przycisk submit z name = registration
if (filter_input(INPUT_POST, "registration")) 
{
    $userId = $um->registration($ob, $user); //sprawdź parametry logowania
    if ($userId > 0)
    {
        header("Location: ?strona=user&user=".$userId); 
        exit;
    } else 
    {
        $zawartosc = "<p>Błędna nazwa użytkownika lub hasło</p>";
        $zawartosc .= $um->registrationForm(); //Pokaż formularz logowania
    }
} else {
    //pierwsze uruchomienie skryptu processLogin
    $zawartosc = $um->registrationForm();
}

// if (isset($_POST['pokaz'])) {
//     $zawartosc .= $ob->select("select * from User", array(
//         "username",
//         "email",
//         "date",
//         "img",
//         "status"
//     ));
// } 

// else if (isset($_POST['java'])) {
//     $zawartosc .= $ob->select("select username, email from User
// where Zamowienie regexp 'Java'", array(
//         "username",
//         "Zamowienie"
//     ));

?>
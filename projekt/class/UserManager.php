<?php
class UserManager {
    function loginForm() {
    ?>
    <h3>Formularz logowania</h3><p>
    <form action="processLogin.php" method="post">
    ...
    <input type="submit" value="Zaloguj" name="zaloguj" />
    </form></p> <?php
    }
    function login($db) {
    //funkcja sprawdza poprawność logowania
    //wynik - id użytkownika zalogowanego lub -1
    $args = [
    'login' => FILTER_SANITIZE_MAGIC_QUOTES,
    'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
    ];
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_POST, $args);
    //sprawdź czy użytkownik o loginie istnieje w tabeli users
    //i czy podane hasło jest poprawne
    $login = $dane["login"];
    $passwd = $dane["passwd"];
    $userId = $db->selectUser($login, $passwd, "users");
    if ($userId >= 0) { //Poprawne dane
    //rozpocznij sesję zalogowanego użytkownika
    //usuń wszystkie wpisy historyczne dla użytkownika o $userId
    //ustaw datę - format("Y-m-d H:i:s");
    //pobierz id sesji i dodaj wpis do tabeli logged_in_users
    }
    return $userId;
}
function logout($db) {
//pobierz id bieżącej sesji (pamiętaj o session_start()
//usuń sesję (łącznie z ciasteczkiem sesyjnym)
//usuń wpis z id bieżącej sesji z tabeli logged_in_users
}
function getLoggedInUser($db, $sessionId) {
//wynik $userId - znaleziono wpis z id sesji w tabeli logged_in_users
//wynik -1 - nie ma wpisu dla tego id sesji w tabeli logged_in_users
}
}

// Listing 3. Schemat skryptu processLogin.php
// <?php
//  include_once 'klasy/Baza.php';
//  include_once 'klasy/User.php';
//  include_once 'klasy/UserManager.php';
//  $db = new Baza("localhost", "root", "", "klienci");
//  $um = new UserManager();
//  //parametr z GET – akcja = wyloguj
//  if (filter_input(INPUT_GET, "akcja")=="wyloguj") {
//  $um->logout($db);
//  }
//  //kliknięto przycisk submit z name = zaloguj
//  if (filter_input(INPUT_POST, "zaloguj")) {
//  $userId=$um->login($db); //sprawdź parametry logowania
//  if ($userId > 0) {
//  echo "<p>Poprawne logowanie.<br />";
//  echo "Zalogowany użytkownik o id=$userId <br />";
//  //pokaż link wyloguj
//  //lub przekieruj użytkownika na inną stronę dla zalogowanych
//  echo "<a href='processLogin.php?akcja=wyloguj' >Wyloguj</a> </p>";
//  } else {
//  echo "<p>Błędna nazwa użytkownika lub hasło</p>";
//  $um->loginForm(); //Pokaż formularz logowania
//  }
//  } else {
//  //pierwsze uruchomienie skryptu processLogin
//  $um->loginForm();
//  }
//  ?>

?>
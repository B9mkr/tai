<?php
class UserManager
{
    function loginForm() 
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
    function login($db)
    {
        //funkcja sprawdza poprawność logowania
        //wynik - id użytkownika zalogowanego lub -1
        $args = [
            'email' => FILTER_SANITIZE_MAGIC_QUOTES,
            'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
        ];
        
        $dane = filter_input_array(INPUT_POST, $args);
        
        $email = $dane["email"];
        $passwd = $dane["passwd"];
        
        $userId = $db->selectUser($email, $passwd, "User");
        
        if ($userId >= 0) //Poprawne dane
        { 
                //rozpocznij sesję zalogowanego użytkownika
            $user = new User('','','');

            $sql  = 'SELECT * FROM `User` u where u.id_user='.$userId;
            $dane_usera = $db->dane_z_bazy($sql);
            $user -> set_z_bazy($dane);
            
            $dane_usera[0]->id_user;
            $dane_usera[0]->username;
            $dane_usera[0]->email;
            $dane_usera[0]->date;;
            $dane_usera[0]->status;
            $dane_usera[0]->passwd;

            $sql  = 'SELECT * FROM `logged_in_users` l where l.id_user='.$userId.' limit 1';
            $dane_logowania = $db->dane_z_bazy($sql);
            
            $dane_logowania[0]->id_session;
            $dane_logowania[0]->id_user;
            $dane_logowania[0]->lastUpdate;

            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
                //ustaw datę - format("Y-m-d H:i:s");
            $this->date = (new DateTime()) -> format("Y-m-d")
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
?>
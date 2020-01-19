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
        $passwd = ''.md5(''.$dane["passwd"]);
        
        $userId = $db->selectUser($email, $passwd);
        
        if ($userId >= 0) //Poprawne dane
        { 
            $db->answer("DELETE FROM `Session` WHERE `Session`.`id_user` = ".$userId);

            $time = ''.(new DateTime()) -> format("Y-m-d H:i:s");
            
            $db->answer('INSERT INTO `Session` (`id_session`, `id_user`, `lastUpdate`) VALUES ("'.$userId.' '.$time.'", '.$userId.', "'.$time.'");');
            return $userId;
        }else{
            return -1;
        }
    }
    function logout($db) {
        $db->answer("DELETE FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1");

        //pobierz id bieżącej sesji (pamiętaj o session_start()
        //usuń sesję (łącznie z ciasteczkiem sesyjnym)
        //usuń wpis z id bieżącej sesji z tabeli Session
    }
    function getLoggedInUser($db, $sessionId) {
        $userId = -1;
        //wynik $userId - znaleziono wpis z id sesji w tabeli Session
        //wynik -1 - nie ma wpisu dla tego id sesji w tabeli Session
        $sql = "SELECT * FROM Session WHERE `Session`.`id_session`='$sessionId'";
        if ($result = $db->mysqli->query($sql))
        {
            $ile = $result->num_rows;
            if ($ile == 1)
            {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                $userId = $row->id_user;
            }
        }
        return $userId; //id zalogowanego użytkownika(>0) lub -1
    }


    function registrationForm() 
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
                    <td><label for = "passwd">Password:</label></td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
            </table> </br>
            
            <input type="reset" name="reset" value="Wyczyść formularz" />
            
            <input type="submit" value="Registration" name="registration"/> </br>
            <a href="?strona=log_in">Log in</a>
            </br>
        </form>';
    // $form.=$user->show();
        return $form; //wynik typu String – gotowy formularz
    }
    function registration($db, $user)
    {
        //funkcja sprawdza poprawność logowania
        //wynik - id użytkownika zalogowanego lub -1
        $args = array(
            'username' => FILTER_SANITIZE_MAGIC_QUOTES,
            'email' => FILTER_VALIDATE_EMAIL,
            'img' => FILTER_SANITIZE_MAGIC_QUOTES,
            'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
        );
        //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
        
        $this->dobazy($dane, $user, $db);

        $userId = $db->selectUser($dane["email"], ''.md5(''.$dane["passwd"]));
        
        if ($userId > 0) //Poprawne dane
        { 
            // $db->answer("DELETE FROM `Session` WHERE `Session`.`id_user` = ".$userId);

            $time = ''.(new DateTime()) -> format("Y-m-d H:i:s");
            
            $db->answer('INSERT INTO `Session` (`id_session`, `id_user`, `lastUpdate`) VALUES ("'.$userId.' '.$time.'", '.$userId.', "'.$time.'");');
            
            return $userId;
        } else {
            return -1;
        }   
    }

    function dobazy($dane, $user, $ob)
    {
        $user->set_username($dane["username"]);
        $user->set_email($dane["email"]);
        $user->set_passwd($dane["passwd"]);
        $user->set_status(1);
        $user->set_date();
        $user->set_img($dane["img"]);

        $ob->answer($user->add_do_bazy());
    }
}
?>
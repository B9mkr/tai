<?php
class User {
    const STATUS_ADMIN = 0;
    const STATUS_USER = 1;
    const STATUS_USER_PUBLIC = 2;

    protected $id_user;
    protected $username;
    protected $passwd;
    protected $email;
    protected $date;
    protected $img;
    protected $status;
    // protected $baza;

    // konstruktor ----------------------------------------------------
    function __construct($username, $email, $passwd)
    {
        $this->username = $username;
        $this->email = $email;
        $this->status=User::STATUS_USER_PUBLIC;
        $this->img="img/anon.jpg";
        $this->date = (new DateTime()) -> format("Y-m-d");
        $this->id_user = NULL;
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }

    // baza -----------------------------------------------------------
    public function add_do_bazy($id='')
    {
        $answer = "INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `img`, `status`, `passwd`) VALUES ";
        if($id == '')
            $answer .= "(NULL, '$this->username', '$this->email', '$this->date', '$this->img', $this->status, '$this->passwd');";
        else
            $answer .= "(".$this->id_user.", '$this->username', '$this->email', '$this->date', '$this->img', $this->status, '$this->passwd');";
        return $answer;
    }
    public function change_baze($baza)
    {
        // UPDATE `User` SET `username` = 'Test 4', `email` = 't4@gmail.c', `date` = '2019-12-18', `img` = 'img/map.jpg', `passwd` = 'd41d8cd98f00b204e9800998ecf8427e' WHERE `User`.`id_user` = 8;
        $baza->answer('UPDATE `User` SET `username` = "'.$this->username.'", `email` = "'.$this->email.'", `date` = "'.$this->date.'", `img` = "'.$this->img.'", `passwd` = "'.$this->get_passwd().'" WHERE `User`.`id_user` = '.$this->id_user);

        //$baza->answer($this->add_do_bazy($this->id_user));
    }
    public function delete_z_bazy($baza)
    {
        $baza->answer('DELETE FROM `User` WHERE `User`.`id_user` = '.$this->id_user);
    }
    public function set_z_bazy($dane, $index=0)
    {
        $this->id_user = $dane[$index]->id_user;
        $this->username = $dane[$index]->username;
        $this->email = $dane[$index]->email;
        $this->date = $dane[$index]->date;
        $this->img = $dane[$index]->img;
        $this->status=$dane[$index]->status;
        $this->passwd=$dane[$index]->passwd;
    }

    // Login ----------------------------------------------------------
    function login_Form() 
    {
        $form = '<form method="post" action="?strona=log_in" >';
        $form .= '
            <table>
                <tr>
                    <td><label for = "adresmail">Adres e-mail:</label></td>
                    <td><input type="text" name="email" placeholder="anon@gmail.com"/></td>
                </tr>
                <tr>
                    <td><label for = "password">Password:</label></td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
                <tr>
                    <td><a href="?strona=registration">Registration</a></td>
                    <td><input type="submit" value="Log in" name="log_in"/></td>
                </tr>
            </table>
        </form>';
        return $form; //wynik typu String – gotowy formularz
    }
    function login_walidation($db)
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
        }
        else
        {
            return -1;
        }
    }
    function logout($db)
    {
        $db->answer("DELETE FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1");
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

    // Registraion ----------------------------------------------------
    function registration_Form() 
    {
        $form = '<form method="post" action="?strona=registration" >
            <table>
                <tr>
                    <td><label for = "username">Nazwa nowego użytkownika:</label></td>
                    <td><input type="text" name="username" placeholder="anon"/></td>
                </tr>
                <tr>
                    <td><label for = "adresmail">Adres e-mail:</label></td>
                    <td><input type="text" name="email" placeholder="anon@gmail.com"/></td>
                </tr>
                <tr>
                    <td><label for = "img">Url do zdjęcia użytkownika:</label></td>
                    <td><input type="text" name="img" value="img/anon.jpg" placeholder="img/anon.jpg"/></td>
                </tr>
                <tr>
                    <td><label for = "passwd">Password:</label></td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
                <tr>
                    <td><a href="?strona=log_in">Log in</a></td>
                    <td><input type="submit" value="Registration" name="registration"/></td>
                </tr>
            </table>
        </form>';
        return $form; //wynik typu String – gotowy formularz
    }
    function registration_walidation($db, $user)
    {
        //wynik - id użytkownika zalogowanego lub -1
        $args = array(
            'username' => FILTER_SANITIZE_MAGIC_QUOTES,
            'email' => FILTER_VALIDATE_EMAIL,
            'img' => FILTER_SANITIZE_MAGIC_QUOTES,
            'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
        );
        //przefiltruj dane z POST zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
        
        $this->dobazy_registration($dane, $user, $db);

        $userId = $db->selectUser($dane["email"], ''.md5(''.$dane["passwd"]));
        
        if ($userId > 0) //Poprawne dane
        {
            $time = ''.(new DateTime()) -> format("Y-m-d H:i:s");
            $db->answer('INSERT INTO `Session` (`id_session`, `id_user`, `lastUpdate`) VALUES ("'.$userId.' '.$time.'", '.$userId.', "'.$time.'");');
            
            return $userId;
        }
        else
        {
            return -1;
        }   
    }

    function dobazy_registration($dane, $user, $ob)
    {
        $user->set_username($dane["username"]);
        $user->set_email($dane["email"]);
        $user->set_passwd($dane["passwd"]);
        $user->set_status(1);
        $user->set_date();
        $user->set_img($dane["img"]);

        $ob->answer($user->add_do_bazy());
    }

    // ----------------------------------------------------------------
    function standardForm($ob) 
    {
        
        $sql='SELECT COUNT(*) AS co FROM `Post` WHERE Post.id_user='.$this->id_user.' GROUP BY `Post`.`id_user`';
        $dane = $ob->dane_z_bazy($sql);
        
        $form=
        '<table>
            <tr>
                <td rowspan="2"><div class=author-card"><img class="author-profile-image" src="'.$this->img.'" alt="'.$this->username.'"/></div></td>
                <td><label>Adres e-mail:</label></td>
                <td><label>'.$this->email.'</label></td>
            </tr>';

        if($dane != NULL)
        {
            $form.='<tr>
                <td><label>Liczba postów:</label></td>
                <td><label>'.$dane[0]->co.'</label></td>
            </tr>';
        }

        $form.='</table>';

        return $form; //wynik typu String – gotowy formularz
    }

    function changeForm() 
    {
        $form='<form method="post" action="">
            <table>
                <tr>
                    <td><label for = "username">Nazwa użytkownika:</label></td>
                    <td><input type="text" value="'.$this->username.'" placeholder="'.$this->username.'" name="username"/></td>
                </tr>
                <tr>
                    <td><label for = "adresmail">Adres e-mail:</label></td>
                    <td><input type="text" value="'.$this->email.'" placeholder="'.$this->email.'" name="email"/></td>
                </tr>
                <tr>
                    <td rowspan=2><label for = "img">Zdjęcie użytkownika:</label></td>
                    <td class="site-header-content"><img class="author-profile-image" src="'.$this->img.'" width="200" height="200" alt="'.$this->username.'"/></td>
                </tr>
                <tr>
                    <td><input type="text" value="'.$this->img.'" placeholder="'.$this->img.'" name="img"/></td>
                </tr>
                <tr>
                    <td><label for = "passwd">Nowy password:</label></td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Wyłoguj" name="wyloguj"/></td>
                    <td><input type="submit" value="Zmień" name="zmien"/></td>
                </tr>
            </table> </br>
            <input type="submit" value="Usuń konto" name="usun_user"/>
        </form>';

        return $form; //wynik typu String – gotowy formularz
    }

    function get_format_Form($form)
    {
        $tresc='<article class="post-full">
            <header class="post-full-header">
                <section class="post-full-meta">';

        $now = (new DateTime()) -> format("Y-m-d");
        $tresc.='<time class="post-full-meta-date" datetime="'.$now.'">'.$this->get_date_format("d F Y", ''.$now).'</time>';

        $tresc.='</section>';

        if($this->username != '')
            $tresc.='<h1 class="post-full-title">'.$this->username.'</h1>';
        
        $tresc.='</header>';
        // <figure class="post-full-image">';
        // $tresc.=create_img($post->get_post_full_image(), "png");
        // $tresc.='</figure>
        $tresc.='<section class="post-full-content"><div class="post-content">';
        $tresc .= $form;
        $tresc.='</div></section></article>';
        return $tresc;
    }

    // ----------------------------------------------------------------
    function zmien($db)
    {
        $args = array(
            'username' => FILTER_SANITIZE_MAGIC_QUOTES,
            'email' => FILTER_VALIDATE_EMAIL,
            'img' => FILTER_SANITIZE_MAGIC_QUOTES,
            'passwd' => FILTER_SANITIZE_MAGIC_QUOTES
        );
        $dane = filter_input_array(INPUT_POST, $args);
        
        $this->dobazy($dane, $db);
    }

    function dobazy($dane, $ob)
    {
        $this->set_username($dane["username"]);
        $this->set_email($dane["email"]);
        $this->set_passwd($dane["passwd"]);
        $this->set_status(1);
        $this->set_date();
        $this->set_img($dane["img"]);

        $dzb = $ob->dane_z_bazy("SELECT lastUpdate FROM `Session`  ORDER BY `Session`.`lastUpdate` DESC LIMIT 1");
        $time = $dzb[0]->lastUpdate;

        $ob->answer($this->change_baze($ob));
        
        $ob->answer("DELETE FROM `Session` WHERE `Session`.`id_user` = ".$this->id_user);

        $ob->answer('INSERT INTO `Session` (`id_session`, `id_user`, `lastUpdate`) VALUES ("'.$this->id_user.' '.$time.'", '.$this->id_user.', "'.$time.'");');
    }

    // ----------------------------------------------------------------
    function walid($dane_this_user, $this_user)
    {
        $wyn = false;
        switch($dane_this_user[0]->status)
        {
            case 0: $wyn = true; break; // admin
            case 1:

                // echo $this->this_user;
                if (''.$this_user == ''.$dane_this_user[0]->id_user)
                {
                    $wyn = true;
                }
                else 
                {
                    $wyn = false;
                }
                break;
            default: 
                $wyn = false;
                break;
        }
        return $wyn;
    }
    
    // ----------------------------------------------------------------
    function usun_user($ob, $dane)
    {
        $ob->answer("DELETE FROM `Session` WHERE `Session`.`id_user` = ".$dane[0]->id_user);
        $ob->answer('DELETE FROM `User` WHERE `User`.`id_user` = '.$dane[0]->id_user);
    }

    // interfejsy klasy------------------------------------------------

    // $user
    public function set_user($user)
    {
        $this->User = $user;
    }
    public function get_user()
    {
        return $this;
    }

    // $id_user
    public function set_id_user($id_user)
    {
        $this->id_user = $id_user;
    }
    public function get_id_user()
    {
        return $this->id_user;
    }

    // $username
    public function set_username($username)
    {
        $this->username = $username;
    }
    public function get_username()
    {
        return $this->username;
    }

    // $passwd;
    public function set_passwd($passwd)
    {
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }
    public function get_passwd()
    {
        return $this->passwd;
    }

    // $email;
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function get_email()
    {
        return $this->email;
    }

    // $date;
    public function set_date($date='')
    {
        if($date=='')
            $this->date = (new DateTime()) -> format("Y-m-d");
            // $this->date = (new DateTime()) -> format("d F Y");
        else
            $this->date = $date;
    }

    public function get_date()
    {
        return $this->date;
    }

    public function get_date_format($format="Y-m-d", $time='')
    {
        if($time == '')
            $time.=$this->date;
        return ((new DateTime("".$time))->format($format));
    }

    // $img
    public function set_img($img)
    {
        $this->img = ''.$img;
    }
    public function get_img()
    {
        return $this->img;
    }

    // $status;
    public function set_status($status)
    {
        // $this->status = $status;
        switch($status)
        {
            case 0: $this->status=User::STATUS_ADMIN; break;
            case 1: $this->status=User::STATUS_USER; break;
            default: $this->status=User::STATUS_USER_PUBLIC;
        }
    }
    public function get_status()
    {
        return $this->status;
    }
}
?> 
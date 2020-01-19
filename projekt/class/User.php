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

    // ----------------------------------------------------------------
    function standardForm() 
    {
        $form=
        '<form method="post" action=""><table>
            <tr>
                <td><img src="'.$this->img.'" width="100" height="100" alt="'.$this->username.'"/></td>
                <td><label>'.$this->username.'</label></td>
            </tr>    
            <tr>
                <td><label>Adres e-mail:</label></td>
                <td><label>'.$this->email.'</label></td>
            </tr></table></form>';

        return $form; //wynik typu String – gotowy formularz
    }

    function changeForm() 
    {
        $form='<form method="post" action="">
            <table>
                <tr>
                    <td><label for = "username">User name:</label></td>
                    <td><input type="text" value="'.$this->username.'" placeholder="'.$this->username.'" name="username"/></td>
                </tr>
                <tr>
                    <td><label for = "adresmail">Adres e-mail:</label></td>
                    <td><input type="text" value="'.$this->email.'" placeholder="'.$this->email.'" name="email"/></td>
                </tr>
                <tr>
                    <td rowspan=2><label for = "img">Img:</label></td>
                    <td><img src="'.$this->img.'" width="200" height="200" alt="'.$this->username.'"/></td>
                </tr>
                <tr>
                    <td><input type="text" value="'.$this->img.'" placeholder="'.$this->img.'" name="img"/></td>
                </tr>
                <tr>
                    <td><label for = "passwd">Password:</label></td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
            </table> </br>
             
            <input type="submit" value="Wyłoguj" name="wyloguj"/>
            <input type="submit" value="Zmień" name="zmien"/>
        </form>';

        return $form; //wynik typu String – gotowy formularz
    }

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

    public function get_date_format($format="Y-m-d")
    {
        return ((new DateTime("".$this->date))->format($format));
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
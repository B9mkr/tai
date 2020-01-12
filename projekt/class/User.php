<?php
class User {
    const STATUS_ADMIN = 0;
    const STATUS_USER = 1;
    const STATUS_USER_PUBLIC = 2;

    protected $id_user=2;
    protected $username;
    protected $passwd;
    protected $email;
    protected $date;
    protected $img;
    protected $status;
    // protected $baza;

    // function __construct($username, $fullName, $email, $passwd ){
    function __construct($username, $email, $passwd){
        $this->username = $username;
        $this->email = $email;
        $this->status=User::STATUS_USER_PUBLIC;
        $this->img="img/anon.jpg";
        $this->date = (new DateTime()) -> format("Y-m-d");
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }
    public function answer_b_add(){
        $answer = "INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `img`, `status`, `passwd`) VALUES ";
        $answer .= "(NULL, '$this->username', '$this->email', '$this->date', '$this->img', $this->status, '$this->passwd');";
        return $answer;
    }

    public function show() {
        // echo "User:".$this->username.", ".$this->fullName.", ".$this->email.
        return "User:".$this->username.", ".$this->email.", ".$this->date.", ".$this->img.", ".$this->status.", ".$this->passwd; 
    }
    
    //--------------------------------------

    // $id_user
    public function set_id_user($id_user){
        $this->id_user = $id_user;
    }
    public function get_id_user(){
        return $this->id_user;
    }

    // $username
    public function set_username($username){
        $this->username = $username;
    }
    public function get_username(){
        return $this->username;
    }

    // $passwd;
    public function set_passwd($passwd){
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }
    public function get_passwd(){
        return $this->passwd;
    }

    // $email;
    public function set_email($email){
        $this->email = $email;
    }
    public function get_email(){
        return $this->email;
    }

    // $date;
    public function set_date($date=''){
        if($date=='')
            $this->date = (new DateTime()) -> format("Y-m-d");
            // $this->date = (new DateTime()) -> format("d F Y");
        else
            $this->date = $date;
    }

    public function get_date(){
        return $this->date;
    }

    public function get_date_format($format="Y-m-d")
    {
        return ((new DateTime("".$this->date))->format($format));
    }

    // $img
    public function set_img($img){
        $this->img = $img;
    }
    public function get_img(){
        return $this->img;
    }

    // $status;
    public function set_status($status){
        // $this->status = $status;
        switch($status)
        {
            case 0: $this->status=User::STATUS_ADMIN; break;
            case 1: $this->status=User::STATUS_USER; break;
            default: $this->status=User::STATUS_USER_PUBLIC;
        }
    }
    public function get_status(){
        return $this->status;
    }

    public function set_z_bazy($dane, $index=0){
        // var_dump($dane);
        $this->id_user = $dane[$index]->id_user;
        $this->username = $dane[$index]->username;
        $this->email = $dane[$index]->email;
        $this->date = $dane[$index]->date;
        $this->img = $dane[$index]->img;
        $this->status=$dane[$index]->status;
        $this->passwd=$dane[$index]->passwd;
    }
}
?> 
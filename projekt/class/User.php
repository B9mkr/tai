<?php
// include_once("Baza.php");

// CREATE TABLE IF NOT EXISTS `User` (
//     `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
//     `username` varchar(40) NOT NULL,
//     `email` varchar(11) NOT NULL,
//     `date` date NOT NULL,
//     `status` tinyint(1) NOT NULL DEFAULT 2,
//     `passwd` varchar(60) NOT NULL,
//     PRIMARY KEY (`id_user`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class User {
    const STATUS_ADMIN = 0;
    const STATUS_USER = 1;
    const STATUS_USER_PUBLIC = 2;

    protected $userName;
    protected $passwd;
    protected $email;
    protected $date;
    protected $status;
    // protected $baza;

    // function __construct($userName, $fullName, $email, $passwd ){
    function __construct($userName, $email, $passwd){
        $this->userName = $userName;
        // $this->fullName = $fullName;
        $this->email = $email;
        $this->status=User::STATUS_USER_PUBLIC;
        $this->date = (new DateTime()) -> format("Y-m-d");
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
        
    }
    public function answer_b_add(){
        $answer = "INSERT INTO `User` (`id_user`, `username`, `email`, `date`, `status`, `paswd`) VALUES ";
        $answer .= "(NULL, '$this->userName', '$this->email', '$this->date', $this->status, '$this->passwd');";
        return $answer;
    }

    public function show() {
        // echo "User:".$this->userName.", ".$this->fullName.", ".$this->email.
        return "User:".$this->userName.", ".$this->email.", ".$this->date.", ".$this->status.", ".$this->passwd; 
    }
    
    public function set_userName($userName){
        $this->userName = $userName;
    }
    public function get_userName(){
        return $this->userName;
    }

    // $passwd;
    public function set_passwd($passwd){
        $this->passwd=md5($passwd);
        // $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }
    public function get_passwd(){
        return $this->passwd;
    }
    // $fullName;
    // public function set_fullName($fullName){
    //     $this->fullName = $fullName;
    // }
    // public function get_fullName(){
    //     return $this->fullName;
    // }
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
}
?> 
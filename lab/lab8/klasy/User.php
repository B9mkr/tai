<?php
class User {
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    protected $userName;
    protected $passwd;
    protected $fullName;//imie i nazwisko
    protected $email;
    protected $date;
    protected $status;

    function __construct($userName, $fullName, $email, $passwd ){
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->status=User::STATUS_USER;
        $this->date = (new DateTime()) -> format("Y-m-d");
        $this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
    }

    public function show() {
        echo "User:".$this->userName.", ".$this->fullName.", ".$this->email.
        ", ".$this->email.", ".$this->date.", ".$this->status.", ".$this->passwd; 
    }
    
    function setUserName($userName){
        $this->$userName = $userName;
    }
    function getUserName(){
        return $this->$userName;
    }
    //...
}
?>
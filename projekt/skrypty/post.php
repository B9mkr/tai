<?php
    //uchwyt do bazy testowa:
    include_once "class/Baza.php";
    include_once "class/User.php";
    include_once "class/Post.php";
    include_once "parsedown/Parsedown.php";

$user       = new User("", "", "");
$post       = new Post();
$ob        = new Baza("localhost", "root", "", "projekt");
$tytul     = "inf";
$zawartosc = "".$post->get_id_post();//." ".file_get_tresc("".$post->get_content());//."<img src=\"img/anon.jpg\" alt=\"anon\"/>";

$datetime  = $user->get_date();
$dateshow  = $user->get_date_format("d F Y");

// $dane=$ob->dane_z_bazy('SELECT * FROM `User` u WHERE u.email="'.$user->get_email().'" AND u.passwd="'.$user->get_passwd().'"');
// if($dane == NULL)
//     echo "Nie poprawne zapytania </br>";
// else{    $user->set_z_bazy($dane);}

function file_get_tresc($url="inf.md"){
	$contents = file_get_contents($url);
	$Parsedown = new Parsedown();
	return "".$Parsedown->text($contents);
}

$sql='SELECT * FROM `User`';
    $dane=$ob->dane_z_bazy($sql);
    if($dane == NULL)
        echo "Nie poprawne zapytania </br>";
    else{
        // $user->set_z_bazy($dane);
        // var_dump($dane);
    }

// object(stdClass)#7 (9) { 
//     ["id_post"]=> string(1) "1" 
//     ["id_user"]=> string(1) "1" 
//     ["title"]=> string(3) "inf" 
//     ["datetime"]=> string(10) "2020-01-10" 
//     ["tag"]=> string(11) "information" 
//     ["post_full_title"]=> string(2) "ts" 
//     ["post_full_image"]=> string(14) "img/text/lovew" 
//     ["access"]=> string(2) "66" 
//     ["content"]=> string(6) "inf.md" }

// object(stdClass)#7 (7) { 
//     ["id_user"]=> string(1) "1" 
//     ["username"]=> string(5) "borys" 
//     ["email"]=> string(21) "mushkaborys@gmail.com" 
//     ["date"]=> string(10) "2020-01-11" 
//     ["img"]=> string(12) "img/anon.jpg" 
//     ["status"]=> string(1) "1" 
//     ["passwd"]=> string(32) "c4ca4238a0b923820dcc509a6f75849b" }

?>
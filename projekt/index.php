<?php
include_once('class/Strona.php');
include_once('class/User.php');
include_once('class/Post.php');
include_once('class/Baza.php');
include_once('class/UserManager.php');

$ob         = new Baza("localhost", "root", "", "projekt");
$User_M     = new UserManager();

    // $dane = $ob->dane_z_bazy("SELECT * FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1");

$user_main = new User("", "", "");

    $sql = "SELECT * FROM `User` WHERE `User`.`id_user`=(SELECT id_user FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1)";
    if(($dane = $ob->dane_z_bazy($sql)) != NULL)
        $user_main->set_z_bazy($dane, 0);

$strona_akt = new Strona($ob);

$this_post=-1;
$this_user=-1;

if(($dane = $ob->dane_z_bazy('SELECT id_post FROM `Post`')) != NULL)
{
    if (filter_input(INPUT_GET, 'this_post')) {
        $tp = filter_input(INPUT_GET, 'this_post');
        foreach($dane as $id)
        {
            // echo ''.$id->id_post.'</br>';
            if($id->id_post == $tp)
                $this_post = $tp;
        }
    } else {
        $this_post = -1;
    }
}

if(($dane = $ob->dane_z_bazy('SELECT id_user FROM `User`')) != NULL)
{
    if (filter_input(INPUT_GET, 'user')) {
        $us = filter_input(INPUT_GET, 'user');
        foreach($dane as $id)
        {
            // echo ''.$id->id_user.'</br>';
            if($id->id_user == $us)
                $this_user = $us;
        }
    } else {
        $this_user = -1;
    }
}

if (filter_input(INPUT_GET, 'strona')) {
    $strona = filter_input(INPUT_GET, 'strona');
    switch ($strona) {
        case 'registration':
            $strona = 'registration';
            break;
        case 'log_in':
            $strona = 'log_in';
            break;
            case 'post':
                $strona = 'post';
                break;
            case 'gen_postow':
                $strona = 'gen_postow';
                break;
            case 'user':
                $strona = 'user';
                break;
            case 'zmien_post':
                $strona = 'zmien_post';
                break;
        default:
            $strona = 'glowna';
    }
} else {
    $strona = "glowna";
}

// $strona="post";

// echo $this_post.'</br>';
// echo $this_user.'</br>';

//dołącz wybrany plik z ustawioną zmienną $tytul i $zawartosc
$plik = "skrypty/" . $strona . ".php";
if (file_exists($plik)) {
    require_once($plik);

    $strona_akt->set_title($tytul);
    $strona_akt->set_zawartosc($zawartosc);
    
    $strona_akt->set_this_user($this_user);
    $strona_akt->set_this_post($this_post);

    $user_main->set_user($user);
    
    $strona_akt->show();
}
?>

<?php
include_once('class/Strona.php');
include_once('class/User.php');
include_once('class/Post.php');
include_once('class/Baza.php');

$ob         = new Baza("localhost", "root", "", "projekt");
$user_main  = new User("", "", "");
$strona_akt = new Strona();

$this_post;
$this_user;

if (filter_input(INPUT_GET, 'this_post')) {
    $tp = filter_input(INPUT_GET, 'this_post');
    switch ($tp) {
        case 1:
            $this_post = 1;
            break;
        case 2:
            $this_post = 2;
            break;
        default:
            $this_post = 1;
    }
} else {
    $this_post = 1;
}

if (filter_input(INPUT_GET, 'user')) {
    $us = filter_input(INPUT_GET, 'user');
    switch ($us) {
        case 1:
            $this_user = 1;
            break;
        case 2:
            $this_user = 2;
            break;
        case 3:
            $this_user = 3;
            break;
        case 4:
            $this_user = 4;
            break;
        default:
        $this_user = 1;
    }
} else {
    $this_user = 1;
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
        default:
            $strona = 'glowna';
    }
} else {
    $strona = "glowna";
}

// $strona="post";

//dołącz wybrany plik z ustawioną zmienną $tytul i $zawartosc
$plik = "skrypty/" . $strona . ".php";
if (file_exists($plik)) {
    require_once($plik);

    $strona_akt->set_title($tytul);
    $strona_akt->set_zawartosc($zawartosc);
    // $strona_akt->set_header($header);
    // $strona_akt->set_datetime($datetime);
    // $strona_akt->set_dateshow($dateshow);
    // $strona_akt->set_img();

    $user_main->set_user($user);
    
    $strona_akt->show();
}
?>

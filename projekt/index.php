<?php
include_once('class/Strona.php');
include_once('class/User.php');
include_once('class/Post.php');

$strona_akt = new Strona();

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
        default:
            $strona = 'glowna';
    }
} else {
    $strona = "glowna";
}

// $strona="glowna";

// if (filter_input(INPUT_GET, 'tag')) {
//     $tag = filter_input(INPUT_GET, 'tag');
//     switch ($tag) {
//         case 's':
//             $tag = 's';
//             break;
//         default:
//             $tag = 's';
//     }
// } else {
//     $tag = "s";
// }


//dołącz wybrany plik z ustawioną zmienną $tytul i $zawartosc
$plik = "skrypty/" . $strona . ".php";
if (file_exists($plik)) {
    require_once($plik);

    $strona_akt->set_title($tytul);
    $strona_akt->set_zawartosc($zawartosc);

    $strona_akt->set_datetime($datetime);
    $strona_akt->set_dateshow($dateshow);
    $strona_akt->set_img();

    

    $strona_akt->show();
}
?>
